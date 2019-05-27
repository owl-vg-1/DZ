<?php
session_start();
require_once('Game.php');
require_once('Game_comp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <title>Крестики нолики</title>
</head>
<body>
    <?php
        $new_game = new Game(3);
        $new_game1 = new Game_comp(3);
        if ($_SESSION['player'] == 'new'){
            $new_game->get_array($_SESSION['array_game']);
            $new_game->start_game();
            $_SESSION['array_game']=$new_game->set_array();
        }
        else {
            $new_game->get_array($_SESSION['array_game']);
            $new_game->check_winner ();
            $new_game1->get_array($_SESSION['array_game']);
            $new_game1->move_comp();
            $new_game1->check_winner ();
            $_SESSION['array_game']=$new_game1->set_array();
        }

    ?>
    <form action="file.php" method="post" id="start_game">
        <input type="submit" value="Новая игра!">
    </form>
</body>
</html>


