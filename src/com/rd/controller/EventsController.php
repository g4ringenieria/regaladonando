<?php

namespace com\rd\controller;

use com\rd\connection\MainConnection;
use com\rd\model\Event;
use com\rd\model\Foundation;
use com\rd\model\User;
use com\rd\view\EventFormView;
use com\rd\view\EventImagesView;
use com\rd\view\EventsView;
use com\rd\view\EventView;
use Exception;
use NeoPHP\io\File;
use stdClass;

class EventsController extends SiteController 
{
    public function indexAction()
    {
        return $this->showEventsAction();
    }
    
    public function showEventsAction()
    {
        $eventTable = MainConnection::getInstance()->getTable("event");
        $eventTable->addWhere("userid","=",$this->getSession()->userId);
        $eventTable->addField("event.*");
        $eventTable->addFields(["foundationid", "businessname"], "foundation_%s", "foundation");
        $eventTable->addInnerJoin("foundation", "event.foundationid", "foundation.foundationid");
        $events = $eventTable->get(Event::getClass());
        return new EventsView($events);
    }
    
    public function showEventFormAction($id=null)
    {
        $event = null;
        if ($id != null) 
            $event = MainConnection::getInstance()->getEntity (Event::getClass(), $id);
        return new EventFormView($event);
    }
    
    public function showEventAction ($id)
    {
        $conn = MainConnection::getInstance();
        $event = $conn->getEntity ( Event::getClass (), $id );
        if ($event) 
        {
            $event->setUser($conn->completeEntity($event->getUser()));
            $event->setFoundation($conn->completeEntity($event->getFoundation()));
        }
        $eventView = new EventView($event);
        return $eventView;
    }
    
    public function showEventImagesAction ($id)
    {
        $event = MainConnection::getInstance()->getEntity (Event::getClass(), $id);
        return new EventImagesView($event);
    }
    
    public function addEventAction ($name, $description, $foundationid, $date)
    {
        $event = new Event();
        $event->setUser(new User($this->getSession()->userId));
        $event->setName($name);
        $event->setDescription($description);
        $event->setFoundation(new Foundation($foundationid));
        $event->setDate($date);
        $event->setCreationDate(date('Y-m-d'));
        MainConnection::getInstance()->insertEntity($event);
        return $this->showEventImagesAction(MainConnection::getInstance()->getLastInsertedId("event_eventid_seq"));
    }
    
    public function modifyEventAction ($id, $name, $description, $foundationid, $date)
    {
        $event = new Event();
        $event->setId($id);
        $event->setName($name);
        $event->setDescription($description);
        $event->setFoundation(new Foundation($foundationid));
        $event->setDate($date);
        MainConnection::getInstance()->updateEntity($event);
        return $this->showEventsAction();
    }
    
    public function deleteEventAction ($id)
    {
        $event = new Event();
        $event->setId($id);
        MainConnection::getInstance()->deleteEntity($event);
        return $this->showEventsAction();
    }
    
    public function uploadImageAction ($id)
    {
        $response = new stdClass();
        try
        {
            $eventDirectory = $this->getEventImagesDir($id);
            if (!$eventDirectory->exists())
                $eventDirectory->mkdir();    
            if (!move_uploaded_file($_FILES["images"]["tmp_name"], $eventDirectory->getFileName() . DIRECTORY_SEPARATOR . basename($_FILES["images"]["tmp_name"]))) 
                throw new Exception ("Error uploading image");
        }
        catch (Exception $ex)
        {
            $response->error = $ex->getMessage();
        }
        return $response;
    }
    
    public function deleteImageAction ($id, $imageName)
    {
        $response = new stdClass();
        try
        {
            $eventImageFile = new File ($this->getEventImagesDir($id)->getFileName() . DIRECTORY_SEPARATOR . $imageName);
            $eventImageFile->delete();
        }
        catch (Exception $ex)
        {
            $response->error = $ex->getMessage();
        }
        return $response;
    }
    
    public function getEventImages ($id)
    {
        $images = [];
        $eventDir = $this->getEventImagesDir($id);
        if ($eventDir->exists())
        {
            $fileImages = $eventDir->listDir();
            foreach ($fileImages as $fileImage)
                $images[] = $this->getBaseUrl() . "res/images/events/$id/" . basename($fileImage);
        }
        return $images;
    }
    
    private function getEventImagesDir ($id)
    {
        return new File (realpath("") . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "events" . DIRECTORY_SEPARATOR . $id);
    }
}