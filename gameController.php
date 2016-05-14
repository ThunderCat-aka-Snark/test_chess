<?php

require "Desk.php";
require "Figure.php";
require "Player.php";
require "Game.php";
require "Redis.php";
//require "FileStorage.php";


/**
 * Class gameController
 */
class gameController {

    /**
     * @var array
     */
    public $events = array();
    /**
     * @var array
     */
    public $errors = array();

    /**
     *
     */
    function __construct(){
        $this->dataStorage = new Redis();
        //$this->dataStorage = new FileStorage();
        $this->player = Registry::get("player"); // use some auth and store $player in Registry
        $this->gameName = Registry::get("gameName"); // get from session $gameName and  store in Registry
        $this->ttl = $this->action=="save"?0:$this->dataStorage->getTTL();
        $this->loadAction();
    }


    /**
     *
     */
    function indexAction(){

    }


    /**
     *
     */
    function addAction(){
        $figure = new Figure(1,2); // get some vars for figure from client
        if($this->player->getColor() == $figure->getColor()) {
            if ($this->desk->addFigureOnDesk($figure, 1, 1)) {  // get some vars for adding from client
                $this->game->switchMove();
                $eventComment = "";
                $this->addCustomEvent($figure, $eventComment);
                $this->saveAction();
            }
            else {
                $this->addError($figure, ADDING_FIGURE_ERROR);
            }
        }
        else {
            $this->addError($figure, ACCESS_ERROR);
        }
        //some code to render View
        print_r($this);
    }

    /**
     *
     */
    function removeAction(){
        $figure = $this->desk->getFigureByCoords(1,2);// get some vars for figure from client
        if($this->player->getColor() == $figure->getColor()) {
            if ($this->desk->removeFigureFromDesk(1, 1)) {  // get some vars for adding from client
                $this->game->switchMove();
                $eventComment = "";
                $this->addCustomEvent($figure, $eventComment);
                $this->saveAction();
            }
            else {
                $this->addError($figure, REMOVING_FIGURE_ERROR);
            }
        }
        else {
            $this->addError($figure, ACCESS_ERROR);
        }
        print_r($this);
    }


    /**
     *
     */
    function moveAction(){
        $figure = $this->desk->getFigureByCoords(1,2);// get some vars for figure from client
        if($this->player->getColor() == $figure->getColor()) {
            if ($this->desk->moveFigure(1,2,3,4)) {  // get some vars for adding from client
                $this->game->switchMove();
                $eventComment = "";
                $this->addCustomEvent($figure, $eventComment);
                $this->saveAction();
            }
            else {
                $this->addError($figure, MOVING_FIGURE_ERROR);
            }
        }
        else {
            $this->addError($figure, ACCESS_ERROR);
        }
        print_r($this);
    }


    /**
     *
     */
    function saveAction(){
        $ttl = $this->ttl; //save on unlimited time in storage if get 0 from client
        $desk = serialize($this->desk);
        $game = serialize($this->game);
        $this->dataStorage->set($this->gameName."-desk",$desk,$ttl);
        $this->dataStorage->set($this->gameName."-game",$game,$ttl);
    }


    /**
     *
     */
    function newAction(){
        $this->game = new Game();
        $this->desk = new Desk();
        $this->saveAction();
    }


    /**
     *
     */
    function loadAction(){
        $prefix = ($this->action = "load")?"-long":"";
        $this->game = new Game();
        $this->game = unserialize($this->dataStorage->get($this->gameName."-game".$prefix));
        $this->desk = $this->game->createNewDesk(); // create empty desk with needed (saved) rules
        $this->desk = unserialize($this->dataStorage->get($this->gameName."-desk".$prefix));
        $this->saveAction();
        if($this->action == "load")header('Location: /');
    }


    /**
     * @param Figure $figure
     * @param string $eventComment
     */
    function addCustomEvent(Figure $figure, string $eventComment = null){
        $this->events[] = $eventComment  ." ". $figure->getColor()." ". $figure->getFigureName();
    }

    /**
     * @param $figure
     * @param $errString
     */
    function addError($figure, $errString){
        $this->errors[] = $errString  ." ". $figure->getColor()." ". $figure->getFigureName();
    }



} 