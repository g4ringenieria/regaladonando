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
        $table->addEntityColumn("Acción", function ($event) 
        { 
            $html = '
                <div class="btn-toolbar" role="toolbar" aria-label="...">
                    <a class="btn btn-group btn-primary" role="group" href="' . $this->getUrl("events/showEventForm", ["id"=>$event->getId()]) . '">Modificar</a>
                    <a class="btn btn-group btn-primary" role="group" href="' . $this->getUrl("events/deleteEvent", ["id"=>$event->getId()]) . '">Borrar</a>
                </div>
            ';
            return $html;
        });
        $table->setEntities($this->events);
        return $table;
    }
}