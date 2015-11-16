<?php

namespace com\rd\component;

use NeoPHP\web\html\HTMLComponent;
use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\html\HTMLTag;

class MainPageLists extends HTMLComponent
{

    private $lists;

    public function __construct ()
    {
        $this->addList(["category" => "wed", "image" => "res/images/lists/01.jpg", "title" => "Pepe y Pepa", "review" => "Nuestro casamiento 23 de Setiembre de 2016"]);
        $this->addList(["category" => "birthday", "image" => "res/images/lists/02.jpg", "title" => "Pepita", "review" => "Mis 15 12 de Octubre de 2015"]);
        $this->addList(["category" => "vacation", "image" => "res/images/lists/03.jpg", "title" => "Pepon", "review" => "Mi bautismo 30 de Enero de 2016"]);
        $this->addList(["category" => "wed", "image" => "res/images/lists/01.jpg", "title" => "Pepe y Pepa", "review" => "Nuestro casamiento 23 de Setiembre de 2016"]);
        $this->addList(["category" => "birthday", "image" => "res/images/lists/02.jpg", "title" => "Pepita", "review" => "Mis 15 12 de Octubre de 2015"]);
        $this->addList(["category" => "vacation", "image" => "res/images/lists/03.jpg", "title" => "Pepon", "review" => "Mi bautismo 30 de Enero de 2016"]);
    }

    public function build ( HTMLPage $page, HTMLTag $parent )
    {
        $page->addScriptFile("res/js/jquery.mixitup.js");
        $page->addScriptFile("res/js/jquery.easing.min.js");
        $page->addScript(
                "(function($) {
            var filterList = {
                init: function() {
                    $('#portfoliolist').mixitup({
                        targetSelector: '.portfolio',
                        filterSelector: '.filter',
                        effects: ['fade'],
                        easing: 'snap',
                        onMixEnd: filterList.hoverEffect()
                    });

                },
                hoverEffect: function() {
                    $('#portfoliolist .portfolio').hover(
                        function() {
                            $(this).find('.caption').stop().animate({
                                bottom: 0
                            }, 200, 'easeOutQuad');
                            $(this).find('img').stop().animate({
                                top: -20
                            }, 300, 'easeOutQuad');
                        },
                        function() {
                            $(this).find('.caption').stop().animate({
                                bottom: -75
                            }, 200, 'easeInQuad');
                            $(this).find('img').stop().animate({
                                top: 0
                            }, 300, 'easeOutQuad');
                        }
                    );
                }
            };
            filterList.init();
        })(jQuery);");

        $divContainer = new HTMLTag("div", ["id"=>"mainevents", "class" => "container text-center wow fadeIn animated", "style" => "visibility: visible; animation-name: fadeIn;"]);
        $divContainer->add("<h2 class=\"maintitle\">Listas</h2>");
        $divContainer->add("<hr class=\"mainrow\">");
        $divContainer->add("<p class=\"mainsubtitle\">Acá te mostramos algunas listas de nuestros usuarios.</p>");

        // Filtros.-
        $divFilter = new HTMLTag("div", [ "class" => "portfolio-filter"]);
        $ulFilters = new HTMLTag("ul", [ "id" => "filters", "class" => "clearfix"]);
        $liAllFilter = new HTMLTag("li");
        $liAllFilter->add("<span class=\"filter active\" data-filter=\"wed birthday vacation other\">Todos</span>");
        $ulFilters->add($liAllFilter);
        $liWedFilter = new HTMLTag("li");
        $liWedFilter->add("<span class=\"filter\" data-filter=\"wed\">Casamientos</span>");
        $ulFilters->add($liWedFilter);
        $liBirthdayFilter = new HTMLTag("li");
        $liBirthdayFilter->add("<span class=\"filter\" data-filter=\"birthday\">Cumpleaños</span>");
        $ulFilters->add($liBirthdayFilter);
        $liVacationFilter = new HTMLTag("li");
        $liVacationFilter->add("<span class=\"filter\" data-filter=\"vacation\">Vacaciones</span>");
        $ulFilters->add($liVacationFilter);
        $liOtherFilter = new HTMLTag("li");
        $liOtherFilter->add("<span class=\"filter\" data-filter=\"other\">Otros</span>");
        $ulFilters->add($liOtherFilter);
        $divFilter->add($ulFilters);
        $divContainer->add($divFilter);

        // Listas.-
        $divList = new HTMLTag("div", [ "id" => "portfoliolist"]);
        if (!empty($this->getLists())) {
            foreach ($this->getLists() as $index => $list) {
                $div1 = new HTMLTag("div", [ "class" => "portfolio {$list['category']} mix_all", "data-cat" => $list['category'], "href" => "#portfolioModal1", "data-toggle" => "modal", "style" => "display: inline-block;  opacity: 1;"]);
                $div2 = new HTMLTag("div", [ "class" => "portfolio-wrapper"]);
                if ($index == 0) {
                    $div2->add("<img src=\"{$list['image']}\" alt=\"\" style=\"top: 0px;\">");
                    $div3 = new HTMLTag("div", [ "class" => "caption", "style" => "bottom: -75px;"]);
                } else {
                    $div2->add("<img src=\"{$list['image']}\" alt=\"\">");
                    $div3 = new HTMLTag("div", [ "class" => "caption"]);
                }
                $div4 = new HTMLTag("div", [ "class" => "caption-text"]);
                $div4->add("<a class=\"text-title\">{$list['title']}</a>");
                $div4->add("<span class=\"text-category\">{$list['review']}</span>");
                $div4->add("<div class=\"caption-bg\"></div>");
                $div3->add($div4);
                $div2->add($div3);
                $div1->add($div2);
                $divList->add($div1);
            }
        }
        $divContainer->add($divList);
        $parent->add($divContainer);
    }

    public function getLists ()
    {
        return $this->lists;
    }

    public function setLists ( $lists )
    {
        $this->lists = $lists;
    }

    public function addList ( $list )
    {
        $this->lists[] = $list;
    }

}
