<?php

require_once ("../NeoPHP2/autoload.php");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath("./src");
NeoPHP\core\ClassLoader::getInstance()->addIncludePath("../NeoPHP-Bootstrap/src");
$app = new com\rd\WebApplication();
$app->handleRequest();

?>