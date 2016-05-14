<?php
/**
 * Created by PhpStorm.
 * User: TC
 * Date: 13.05.2016
 * Time: 15:03
 */

class Player {

    private $color;

    private $colors = array(
        0 => "Black",
        1 => "White",
    );



    public function __construct($color = 0){
        $this->color = $color;
    }

    public function getColor(){
        return $this->colors[$this->color];
    }

} 