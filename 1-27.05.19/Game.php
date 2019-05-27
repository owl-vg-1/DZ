<?php

class Game {

    public $size;
    public $player = "X";
    protected $array_game = [];

    public function __construct($size)
    {
        $this->size = $size;
        $this->create_array($size);
    }

    public function create_array()
    {
        for ($i=0; $i<$this->size; $i++) { 
            for ($j=0; $j<$this->size; $j++) { 
               $this->array_game[$i][$j] = '-'; 
            }
        }
        return $this->array_game;
    }

    public function set_array()
    {
        $array=$this->array_game;
        return $array;
    }

    public function get_array($array)
    {
        $this->array_game=$array;
    }

    public function start_game () {
        echo "<table class='table_game'>";
        foreach ($this->array_game as $key =>$val) {
            echo "<tr>";
           foreach ($this->array_game[$key] as $k => $v) {
            echo "<td><a href='move.php?x=$key&y=$k'>".$v."</a></td>";
           }
           echo "</tr>";
        }
        echo "</table>";
    }

    public function show ($array) {
        echo "<table class='table_game'>";
        foreach ($array as $key =>$val) {
            echo "<tr>";
           foreach ($array[$key] as $k => $v) {
            echo "<td><a href='index.php?x=$key&y=$k'>".$v."</a></td>";
           }
           echo "</tr>";
        }
        echo "</table>";
    }


    public function move_cross($x, $y)
    {
        $this->array_game[$x][$y] = "X";
    }

    public function move_zero($x, $y)
    {
        $this->array_game[$x][$y] = "0";
        return $this->start_game();
    }

    public function allowable_size($x, $y)
    {
        if ($x >=0 && $x < $this->size && $y >=0 && $y < $this->size) {
            return true;
        }
    }

    public function busy_zone($x, $y)
    {
        if ($this->array_game[$x][$y] == "X" || $this->array_game[$x][$y] == "0") {
            return true;
        }
    }

    public function check_move ($player) {
        if ($player == $this->player) {
            return true;
        }
    }

    public function reverse_player ($player) {
        if ($player != $this->player) {
            $this->player = $player;
        }
    }

    public function check($arr)
    {
        for ($i=0; $i < $this->size; $i++) { 
            $array_cross[$i] = "X";
            $array_zero[$i] = "0";
        }

        if (count(array_diff($arr, $array_zero)) == 0) {
            echo "Победа нолика!";
        } elseif (count(array_diff($arr, $array_cross)) == 0) {
            echo "Победа крестика!";
        }

    }
    public function check_winner () {
        // На победу в ряду 
        foreach ($this->array_game as $key => $value) {
            $this->check($this->array_game[$key]);
        }

        // На победу в столбце через транспонирование 
        array_unshift($this->array_game, null);
		$buff_array = call_user_func_array("array_map", $this->array_game);
        foreach ($buff_array as $key => $value) {
            $this->check($buff_array[$key]);
        }
        $this->array_game = array_slice($this->array_game, 1);

        // На победу диогоналей
        $j = 1;
        for ($i=0; $i < $this->size; $i++) { 
            $diagonal_arr[]=$this->array_game[$i][$i];
            $diagonal_arr1[]=$this->array_game[$i][$this->size-$j++];
        }
        $this->check($diagonal_arr);
        $this->check($diagonal_arr1);
    }

    public function move($x, $y, $player)
    {
        if ($this->allowable_size($x, $y)) {
            if (!$this->busy_zone($x, $y)) {
                if ($player == "X") {
                    $this->move_cross($x, $y);
                }
            } else {echo "Зона занята!";}
        } else {echo "НЕ в зоне!";}
    }
}