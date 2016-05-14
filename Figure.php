<?php

class Figure {

    /**
     * @var int
     */
    private $type; // type of figure

    /**
     * @var int
     */
    private $color; // color/fraction

    /**
     * @var array
     */
    private $typesOfFigures = array(
        1 => "Queen",
        2 => "King",
        3 => "Castle",
        4 => "Bishop",
        5 => "Knight",
        6 => "Pawn"
    );

    private $colors = array(
        0 => "Black",
        1 => "White",
    );

    /**
     * @param int $color
     * @param int $type
     * init object by data given
     */
    public function __construct(int $color, int $type) {
        $this->color = ($color > 0) ? 1 : 0;
        if (in_array($this->typesOfFigures, $type)) {
            $this->type = $type;
        } else {
            $this->type = 6;
        }
    }

    /**
     * @return string
     * return color of figure
     */
    public function getColor(){
        return $this->colors[$this->color];
    }

    /**
     * @return string
     * return type of figure
     */
    public function getFigureName(){
        return $this->typesOfFigures[$this->type];
    }
}
