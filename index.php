<?php
//FICHIER D'EXECUTION
include "./interface/interfaceModel.php";
include "./model/playerModel.php";
include "./view/header.php";
include "./view/viewPlayer.php";
include "./view/footer.php";
include "./abstract/abstractController.php";
include "./controller/playerController.php";

$controller = new PlayerController();
$controller->render();
?>
