<?php

namespace com\rd\view;

use com\bootstrap\component\form\BSFileInput;
use com\bootstrap\component\form\BSForm;
use com\rd\model\Event;
use NeoPHP\web\html\HTMLTag;

class EventImagesView extends SiteView
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
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", "Carga de imágenes de Evento")));
        $container->addElement($this->createEventForm());
        return $container;
    }
    
    protected function createEventForm ()
    {
        $form = new BSForm();
        $form->setMethod("POST");
        $form->setAction($this->getUrl("events/addEvent"));
        $form->setEnctype("multipart/form-data");
        $form->addField(new BSFileInput(["name"=>"images", "label"=>"Imagenes", "multiple"=>true, "uploadUrl"=>$this->getUrl("events/uploadImage"), "uploadExtraData"=>["id"=>$this->event->getId()], "dropZoneTitle"=>"Arrastrar imágenes aquí", "allowedFileExtensions"=>["jpg", "png", "gif"]]));
        return $form;
    }
}