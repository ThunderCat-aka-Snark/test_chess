<?php

define ("ADDING_FIGURE_ERROR","ADDING_FIGURE_ERROR");
/**
 *
 */
define ("ACCESS_ERROR","ACCESS_ERROR");
/**
 *
 */
define ("REMOVING_FIGURE_ERROR","REMOVING_FIGURE_ERROR");
/**
 *
 */
define ("MOVING_FIGURE_ERROR","MOVING_FIGURE_ERROR");

/**
 * Class Game
 */
class Game {


    /**
     * @var array
     */
    private $rules = array(
        "firstMove" => "white",
        "removeOnCollision" => true,
        "throwMessageOnEvent" => false,
        "deskHeight" => 8,
        "deskWidth" => 8,
    );


    /**
     * @var
     */
    public $move;


    /**
     * @param array $rules
     */
    function __construct(array $rules = null) {
        if($rules)$this->createNewGame($rules);
    }


    /**
     * @param $rules
     */
    private function createNewGame($rules){
        $this->rules = $rules;
        $this->move = $this->rules['firstMove'];
    }


    /**
     * @return Desk
     */
    public  function createNewDesk(){
        return new Desk($this->rules['deskWidth'],$this->rules['deskHeight']);
    }

    /**
     * @return string
     */
    public function switchMove(){
        return $this->move = ($this->move == "white")?"black":"white";
    }

}