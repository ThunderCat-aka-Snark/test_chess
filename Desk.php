<?php

class Desk {
    /**
     * @var int
     * w of desk in squares
     */
    private $width = 8;

    /**
     * @var int
     * h of desk in squares
     */
    private $height = 8;

    /**
     * @var array
     * desk array - reference of figures on desk
     */
    private $desk = array();


    /**
     * @param int $height
     * @param int $width
     */
    public function __construct(int $height = null, int $width = null) {
        if($height)$this->height = $height;
        if($width)$this->width = $width;
    }


    /**
     * @param Figure $figure
     * @param int $x
     * @param int $y
     * @param bool $replaceRule
     * @return bool
     */
    public function addFigureOnDesk(Figure $figure, int $x, int $y, bool $replaceRule = null) {
        if(!is_object($this->desk[$x][$y]) || !$replaceRule) {
            $this->desk[$x][$y] = $figure;
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function removeFigureFromDesk(int $x, int $y) {
        if(is_object($this->desk[$x][$y])) {
            unset($this->desk[$x][$y]);
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $x1
     * @param int $y1
     * @param bool $replaceRule
     * @return bool
     */
    public function moveFigure(int $x, int $y, int $x1, int $y1, bool $replaceRule = null ) {
        if(is_object($this->desk[$x][$y])) {
            if($figure = $this->getFigureByCoords($x, $y)){
                $this->addFigureOnDesk($figure, $x1, $y1, $replaceRule);
                $this->removeFigureFromDesk($x, $y);
                return true;
            }
        }
        else {
            return false;
        }
    }


    /**
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function getFigureByCoords(int $x, int $y) {
        if(is_object($this->desk[$x][$y])) {
            return $this->desk[$x][$y];
        }
        else {
            return false;
        }
    }



}