<?php
require_once('Game.php');

class Game_comp extends Game {
    public $player = "0";

    public function __construct($size)
    {
        $this->size = $size;
        $this->create_array($size);
    }

    public function random_point()
    {
        return round(rand(0, ($this->size-1)));
    }

    // Проверка на наличиее места для осуществления хода
    public function check_vacancies(){
        foreach ($this->array_game as $key => $value) {
            foreach ($this->array_game[$key] as $k => $v) {
                while ($this->array_game[$key][$k] != "X" && $this->array_game[$key][$k] != "0") {
                    return true;
                    break;
                }
            }
        }
    }

    public function move_comp()
    {
        if ($this->check_vacancies() ) {
            do {
                $x=$this->random_point();
                $y=$this->random_point();
            } while ($this->busy_zone($x, $y));
            $this->move_zero($x, $y);
        } else {
           echo 'Ход не возможен!';
        }
    }
}