<?php
include_once("Controllers/MainController.php");
include_once("Resources/Scripts.php");
$Controller = new MainController();
$Id = isset($_GET["id"]) ? $_GET["id"] : -1;
$Controller->Recipe($Id);
?>