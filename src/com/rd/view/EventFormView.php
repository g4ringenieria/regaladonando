<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\form\BSDateTimeField;
use com\bootstrap\component\form\BSFileInput;
use com\bootstrap\component\form\BSForm;
use com\bootstrap\component\form\BSSelectField;
use com\bootstrap\component\form\BSTextAreaField;
use com\bootstrap\component\form\BSTextField;
use com\rd\connection\MainConnection;
use com\rd\model\Event;
use com\rd\model\Foundation;
use NeoPHP\web\html\HTMLTag;

class EventFormView extends SiteView
{
    private $event;
    
    public function __construct(Event $event = null)
    {
        parent::__construct();
        $this->event = $event;
    }
    
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", $this->event != null? "Modificar Evento" : "Nuevo Evento")));
        $container->addElement($this->createEventForm());
        return $container;
    }
    
    protected function createEventForm ()
    {
        $form = new BSForm();
        $form->setMethod("POST");
        $form->setAction($this->getUrl("events/addEvent"));
        $form->setEnctype("multipart/form-data");
        $form->addField(new BSTextField(["name"=>"name", "label"=>"Nombre", "required"=>true, "autoFocus"=>true]));
        $form->addField(new BSTextAreaField(["name"=>"description", "label"=>"Descripción", "required"=>true, "rows"=>4]));
        $form->addField(new BSSelectField(["name"=>"foundationid", "label"=>"Fundación", "options"=>$this->getFoundations()]));
        $form->addField(new BSDateTimeField(["name"=>"date", "label"=>"Fecha de evento", "required"=>true]));
        if ($this->event != null)
            $form->addField(new BSFileInput(["name"=>"images", "label"=>"Imagenes", "multiple"=>true, "uploadUrl"=>$this->getUrl("events/uploadImage"), "uploadExtraData"=>["id"=>$event->getId()], "dropZoneTitle"=>"Arrastrar imagenes aquí", "allowedFileExtensions"=>["jpg", "png", "gif"]]));
        $form->addButton(new BSButton("Agregar evento", ["type"=>"submit", "style"=>BSButton::STYLE_PRIMARY]));
        return $form;
    }
    
    private function getFoundations()
    {
        $foundations = array();
        foreach (MainConnection::getInstance()->getEntities (Foundation::getClass()) as $foundation)
        {
            $foundations[$foundation->getId()] = $foundation->getName();
        }
        return $foundations;
    }
}