<?php

namespace com\rd\controller;

use com\rd\connection\MainConnection;
use com\rd\model\Event;
use com\rd\model\Foundation;
use com\rd\model\User;
use com\rd\view\EventFormView;
use com\rd\view\EventsView;
use com\rd\view\EventView;

class EventsController extends SiteController 
{
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
    
    public function showEventFormAction()
    {
        return new EventFormView();
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
        return $this->showEventsAction();
    }
    
    public function showEventAction ($id)
    {
        $event = MainConnection::getInstance()->getEntity ( Event::getClass (), $id );
        if ($event) {
            $event->setUser(MainConnection::getInstance()->getEntity(User::getClass(), $event->getUser()->getId()));
            $event->setFoundation(MainConnection::getInstance()->getEntity(Foundation::getClass(), $event->getFoundation()->getId()));
        }
        $eventView = new EventView($event);
        return $eventView;
    }
}