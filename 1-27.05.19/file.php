<?php
session_start();
require_once('Game.php');
require_once('Game_comp.php');
$new_game = new Game(3);
$new_game1 = new Game_comp(3);
$_SESSION['array_game']= $new_game->set_array();
$_SESSION['player'] = "new";
header("Location: index.php");
?>