<?php
include_once("Controllers/AuthController.php");
include_once("Resources/Scripts.php");
$Controller = new AuthController();
$Id = isset($_GET["id"]) ? $_GET["id"] : -1;
$Controller->User($Id);
