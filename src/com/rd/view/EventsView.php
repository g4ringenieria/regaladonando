<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSEntityTable;
use NeoPHP\web\html\HTMLTag;

class EventsView extends SiteView
{
    private $events = [];
    
    public function __construct (array $events = [])
    {
        parent::__construct();
        $this->events = $events;
    }
    
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement(new HTMLTag("div", ["class"=>"page-header"], new HTMLTag("h1", "Mis Eventos"))); 
        $container->addElement($this->createEventsTable());
        $container->addElement(new BSButton("Agregar Nuevo Evento", ["href"=>$this->getUrl("events/showEventForm"), "style"=>  BSButton::STYLE_PRIMARY]));
        return $container;
    }
    
    protected function createEventsTable()
    {
        $table = new BSEntityTable();
        $table->addEntityColumn("Nombre", "name");
        $table->addEntityColumn("Fecha", "date");
        $table->addEntityColumn("Fundación", "foundation_name");
        $table->addEntityColumn("Acción", function ($bankaccount) 
        { 
            return '<a class="btn btn-primary" href="' . $this->getUrl("user/deleteBankAccount", ["id"=>$bankaccount->getId()]) . '" role="button" type="button">Borrar</a>';
        });
        $table->setEntities($this->events);
        return $table;
    }
}