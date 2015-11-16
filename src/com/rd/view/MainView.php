<?php

namespace com\rd\view;

class MainView extends SiteView
{
    protected function createContent()
    {
        $container = parent::createContent();
        $container->addElement("content element");
        return $container;
    }
}
