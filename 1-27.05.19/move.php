<?php
    session_start();
    require_once('Game.php');
    require_once('Game_comp.php');
    $new_game = new Game(3);
    $new_game1 = new Game_comp(3);
    $_SESSION['player'] = '';
    $new_game->get_array($_SESSION['array_game']);
    $new_game->move($_GET['x'], $_GET['y'], "X");
    $_SESSION['array_game']=$new_game->set_array();
    header("Location: index.php");
?>


