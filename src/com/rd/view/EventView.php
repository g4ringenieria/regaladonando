<?php

namespace com\rd\view;

use com\bootstrap\component\BSButton;
use com\rd\model\Event;

class EventView extends SiteView
{
    private $event;
    
    public function __construct(Event $event = null)
    {
        parent::__construct();
        $this->event = $event;
    }
    
    private function getEvent()
    {
        return $this->event;
    }
    
    protected function createContent()
    {
        $this->addStyleFile("res/css/event.css");
        $this->addScriptFile("res/js/plugins.js");
        
        $container = parent::createContent();
        $container->addElement("
        <div id='page-content'>
            <div class='content-header content-header-media'>
                <div class='header-section'>
                    <img src='res/images/avatars/user_" . $this->getEvent()->getUser()->getId() . ".jpg' alt='Avatar' class='pull-right img-circle'>
                    <h1>" . $this->getEvent()->getUser()->getFirstname() . " " . $this->getEvent()->getUser ()->getLastName() . "<br><small>" . $this->getEvent()->getName () . "</small></h1>
                </div>
                <img src='res/images/events/event_" . $this->getEvent()->getId() . "_header.jpg' alt='header image' class='animation-pulseSlow'>
            </div>
        </div>");
        $container->addElement("
        <div class='block'>
                <div class='block-title'>
                    <h2>" . $this->getEvent()->getName() . "</h2>
                </div>
                <table class='table table-borderless table-striped'>
                    <tbody>
                        <tr>
                            <td style='width: 20%;'><strong>Descripción</strong></td>
                            <td>" . $this->getEvent()->getDescription() . "</td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de creación</strong></td>
                            <td>" . $this->getEvent()->getCreationDate() . "</td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de finalización</strong></td>
                            <td>" . $this->getEvent()->getDate() . "</td>
                        </tr>
                        <tr>
                            <td><strong>Fundación apadrinada</strong></td>
                            <td>
                                <a href='javascript:void(0)' class='label label-info'>" . $this->getEvent()->getFoundation()->getName() . "</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>");
        $container->addElement ("
            <div class='block'>
                <div class='media-body animation-pullDown'>
                    <div class='row push'>
                        <div class='col-sm-6 col-md-4'>
                            <a href='res/images/events/event_" . $this->getEvent()->getId() . "_image_1.jpg' data-toggle='lightbox-image'>
                                <img src='res/images/events/event_" . $this->getEvent()->getId() . "_image_1.jpg' alt='image'>
                            </a>
                        </div>
                        <div class='col-sm-6 col-md-4'>
                            <a href='res/images/events/event_" . $this->getEvent()->getId() . "_image_2.jpg' data-toggle='lightbox-image'>
                                <img src='res/images/events/event_" . $this->getEvent()->getId() . "_image_2.jpg' alt='image'>
                            </a>
                        </div>
                    </div>
                    <p>
                        <a href='javascript:void(0)' class='btn btn-xs btn-default'><i class='fa fa-thumbs-o-up'></i> Like</a>
                        <a href='javascript:void(0)' class='btn btn-xs btn-default'><i class='fa fa-comments-o'></i> Comment</a>
                        <a href='javascript:void(0)' class='btn btn-xs btn-default'><i class='fa fa-share-square-o'></i> Share</a>
                    </p>
                </div>
            </div>");
        $container->addElement(new BSButton("Regalar", ["href"=>$this->getUrl("user/showToGiftForm"), "style"=>  BSButton::STYLE_PRIMARY]));
        return $container;
    }
}