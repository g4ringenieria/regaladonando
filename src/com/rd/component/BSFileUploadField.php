<?php

namespace com\rd\component;

use com\bootstrap\component\form\BSFormField;
use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\html\HTMLTag;

class BSFileUploadField extends BSFormField
{
    public function build (HTMLPage $page, HTMLTag $parent)
    {
        parent::build($page, $parent);
        $page->addStyleFile("res/assets/bootstrap-file-input/css/fileinput.min.css"); 
        $page->addScriptFile("res/assets/bootstrap-file-input/js/plugins/canvas-to-blob.min.js"); 
        $page->addScriptFile("res/assets/bootstrap-file-input/js/fileinput.min.js");    
    }

    protected function buildField()
    {
        $field = new HTMLTag("input");
        $field->setContent("");
        $field->setAttribute("id", $this->id);
        if (!empty($this->name))
            $field->setAttribute("name", $this->name);
        $field->setAttribute("type", "file");
        $field->setAttribute("multiple", "true");
        $field->setAttribute("class", "file");
        return $field;
    }
}
