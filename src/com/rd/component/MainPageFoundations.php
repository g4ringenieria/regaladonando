<?php

namespace com\rd\component;

use com\bootstrap\component\BSContainer;
use com\bootstrap\component\BSLayoutConstraints;
use NeoPHP\web\html\HTMLTag;

class MainPageFoundations extends BSContainer
{
    public function __construct ()
    {
        parent::__construct();
        $constraints = new BSLayoutConstraints();
        $constraints->colsXs = 6;
        $constraints->colsSm = 4;
        $constraints->colsLg = 2;
        $this->setId("mainfoundations");
        $this->addElement($this->createFoundationLink("res/images/foundations/caritas.jpg"), $constraints);
        $this->addElement($this->createFoundationLink("res/images/foundations/favaloro.jpg"), $constraints);
        $this->addElement($this->createFoundationLink("res/images/foundations/messi.jpg"), $constraints);
        $this->addElement($this->createFoundationLink("res/images/foundations/integra.jpg"), $constraints);
        $this->addElement($this->createFoundationLink("res/images/foundations/leer.png"), $constraints);
        $this->addElement($this->createFoundationLink("res/images/foundations/remar.jpg"), $constraints);
    }

    public function createFoundationLink ($image, $url="#")
    {
        return new HTMLTag("a", ["href"=>$url], new HTMLTag("img", ["src"=>$image], ""));
    }
}
