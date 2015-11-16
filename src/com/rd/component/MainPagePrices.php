<?php

namespace com\rd\component;

use NeoPHP\web\html\HTMLComponent;
use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\html\HTMLTag;

class MainPagePrices extends HTMLComponent
{
    private $prices;

    public function __construct ()
    {
        $this->addPrice(["name" => "SILVER", "featured"=> "", "items" => array("<span class=\"label label-danger\"><strong>bla bla</strong></span>", "Unlimited Support", "Access from anywhere", "24/7 phone support", "&nbsp;", "<span class=\"number\"><sup>$</sup>5</span> <sup>MONTH</sup>")]);
        $this->addPrice(["name" => "GOLD", "featured"=> "featured", "items" => array("<span class=\"label label-danger\"><strong>bla bla</strong></span>", "Unlimited Support", "Access from anywhere", "24/7 phone support", "&nbsp;", "<span class=\"number\"><sup>$</sup>15</span> <sup>MONTH</sup>")]);
    }

    public function build ( HTMLPage $page, HTMLTag $parent )
    {
        $divContainer = new HTMLTag("div", ["id"=>"mainprices", "class" => "container text-center wow fadeIn animated", "style" => "visibility: visible; animation-name: fadeIn;"]);
        $divContainer->add("<i class=\"icon icon-heading ion-bag size-64 fa-opacity\"></i><br>");
        $divContainer->add("<h2 class=\"maintitle\">Precios</h2>");
        $divContainer->add("<hr class=\"mainrow\">");
        $divContainer->add("<p class=\"mainsubtitle\">Bla bla bla.</p>");
        $divRow = new HTMLTag("div", [ "class" => "row"]);
        if (!empty($this->getPrices())) {
            foreach ($this->getPrices() as $index => $price) {
                $divPrice = new HTMLTag("div", ["class" => "{$price['featured']} col-md-6 col-sm-6 price wow fadeIn animated", "data-wow-delay" => "0.".($index+1)."s", "style" => "visibility: visible; animation-delay: 0.".($index+1)."s; animation-name: fadeIn;"]);
                $divPrice->add("<h2>PRECIO <span class=\"thin\">{$price["name"]}</span></h2>");
                $ul = new HTMLTag("ul", ["class" => "list-group"]);
                if (!empty($price["items"])) {
                    foreach ($price["items"] as $item) {
                        $li = new HTMLTag("li", ["class" => "list-group-item"]);
                        $li->add($item);
                        $ul->add($li);
                    }
                }
                $divPrice->add($ul);
                $divPrice->add("<a href=\"#\" class=\"btn border-button-black\">CONTRATAR</a>");
                $divRow->add($divPrice);
            }
        }

        $divContainer->add($divRow);
        $parent->add($divContainer);
    }

    public function getPrices ()
    {
        return $this->prices;
    }

    public function setPrices ( $prices )
    {
        $this->prices = $prices;
    }

    public function addPrice ( $price )
    {
        $this->prices[] = $price;
    }

}
