<?php

namespace com\rd\view;

use com\rd\model\User;

class UserSummaryView extends SiteView
{
    private $user;
    
    public function __construct(User $user = null)
    {
        parent::__construct();
        $this->user = $user;
    }
    
    private function getUser()
    {
        return $this->user;
    }
    
    protected function createContent()
    {
        $this->addStyleFile("res/css/event.css");
        $this->addStyleFile("res/css/theme.css");
        $this->addStyleFile("res/css/plugin.css");
        
        $container = parent::createContent();
        $container->addElement("
    
        <div id='main-container'>
            <header class='navbar navbar-default'>
            </header><div id='page-content'>
                <div class='row'>
                    <div class='col-sm-6 col-lg-3'>
                        <div class='widget'>
                            <div class='widget-simple'>
                                <a href='javascript:void(0)' class='widget-icon pull-left themed-background'>
                                    <i class='gi gi-package'></i>
                                </a>
                                <h3 class='text-right animation-stretchRight'>+ <strong>50%</strong></h3>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-6 col-lg-3'>
                        <div class='widget'>
                            <div class='widget-simple'>
                                <a href='javascript:void(0)' class='widget-icon pull-right themed-background-amethyst'>
                                    <i class='gi gi-wallet'></i>
                                </a>
                                <h3 class='animation-stretchLeft'>$ <strong>75%</strong></h3>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-6 col-lg-3'>
                        <div class='widget'>
                            <div class='widget-simple'>
                                <a href='javascript:void(0)' class='widget-icon pull-left themed-background-night'>
                                    <i class='gi gi-bug animation-tossing'></i>
                                </a>
                                <h3 class='text-right animation-stretchRight'>3 <strong>Bugs</strong></h3>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-6 col-lg-3'>
                        <div class='widget'>
                            <div class='widget-simple'>
                                <a href='javascript:void(0)' class='widget-icon pull-right themed-background-fire'>
                                    <i class='gi gi-fire animation-floating'></i>
                                </a>
                                <h3 class='animation-stretchLeft'>1 <strong>Crash</strong></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='widget'>
                            <div class='widget-advanced widget-advanced-alt'>
                                <div class='widget-header text-center themed-background'>
                                    <h3 class='widget-content-light text-left pull-left animation-pullDown'>
                                        <strong>Sales &amp; Earnings</strong><br>
                                        <small>2013</small>
                                    </h3>
                                    <div id='chart-widget1' class='chart'></div>
                                </div>
                                <div class='widget-main'>
                                    <div class='row text-center'>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><strong>7.500</strong><br><small>Clients</small></h3>
                                        </div>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><strong>10.970</strong><br><small>Sales</small></h3>
                                        </div>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><strong>$ 31.230</strong><br><small>Earnings</small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class='widget'>
                            <div class='widget-advanced widget-advanced-alt'>
                                <div class='widget-header text-center themed-background-dark'>
                                    <h3 class='widget-content-light text-left pull-left animation-pullDown'>
                                        <strong>Sales &amp; Earnings</strong><br>
                                        <small>2013</small>
                                    </h3>
                                    <div id='chart-widget2' class='chart'></div>
                                </div>
                                <div class='widget-main'>
                                    <div class='row text-center'>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><i class='gi gi-group'></i> <br><small><strong>7.500</strong></small></h3>
                                        </div>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><i class='gi gi-briefcase'></i><br><small><strong>10.970</strong></small></h3>
                                        </div>
                                        <div class='col-xs-4'>
                                            <h3 class='animation-hatch'><i class='gi gi-money'></i><br><small><strong>$ 31.230</strong></small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>");
        return $container;
    }
}

?>