<?php
include './utils/utils.php';
include './abstract/abstractController.php';
include './interface/interfaceModel.php';
include './model/playerModel.php';
include './view/header.php';
include './view/footer.php';
include './view/viewPlayer.php';
include './controller/playerController.php';

$player = new PlayerController();
$player->render();