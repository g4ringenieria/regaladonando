<?php

namespace com\rd\view;

use com\rd\component\MainPageFoundations;
use com\rd\component\MainPageLists;
use com\rd\component\MainPagePrices;
use NeoPHP\web\html\HTMLTag;

class PortalView extends SiteView
{
    public function __construct()
    {
        parent::__construct();
        $this->addScript('
            function adjustMainNavBar (scrollValue)
            {
                var scrollValue = $(document).scrollTop();
                if (scrollValue < 50)
                {
                    $("#mainnavbar").css("background-color", "transparent");
                }
                else
                {
                    $("#mainnavbar").css("background-color", "#DD4814");
                }
            }

            $(document).on("scroll", function (e) 
            {
                adjustMainNavBar();
            });
            adjustMainNavBar();
        ');
    }
    
    protected function build()
    {
        $this->addElement($this->createMainJumbotron());
        parent::build();
    }
    
    protected function createMainJumbotron()
    {
        $jumbotronButtonGive = new HTMLTag("a", ["id"=>"mainGiveButton", "href"=>"#", "class"=>"btn btn-lg btn-default btn-jumbotron"], "Quiero regalar");
        $jumbotronButtonReceive = new HTMLTag("a", ["id"=>"mainReceiveButton", "href"=>"#", "class"=>"btn btn-lg btn-default btn-jumbotron"], "Quiero recibir regalos");        
        $jumbotronTitle = new HTMLTag("h1", ["class"=>"jumbotrontitle"], "Regala Donando");
        $jumbotronText = new HTMLTag("p", ["class"=>"lead jumbotrontext"], "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore");
        $jumbotronButtons = new HTMLTag("p", ["class"=>"lead jumbotronbuttons"]);
        $jumbotronButtons->add ($jumbotronButtonGive);
        $jumbotronButtons->add ($jumbotronButtonReceive);
        $jumbotronbody = new HTMLTag("div", ["id"=>"mainjumbotronbody"], [$jumbotronTitle, $jumbotronText, $jumbotronButtons]);
        $jumbotronFooter = new HTMLTag("div", ["id"=>"mainjumbotronfooter"], "<p class=\"text-muted credit\">&copy; 2015 RegalaDonando.com. Todos los derechos reservados</p>");
        $jumbotron = new HTMLTag("div", ["id"=>"mainjumbotron"], [$jumbotronbody, $jumbotronFooter]);
        return $jumbotron;
    }
    
    protected function createMainContainer()
    {
        $container = parent::createMainContainer();
        $container->addElement(new MainPageLists());
        $container->addElement(new MainPagePrices());
        $container->addElement(new MainPageFoundations());
        return $container;
    }
}
