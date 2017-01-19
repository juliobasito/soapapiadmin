<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 13/01/2017
 * Time: 11:39
 */
class location
{
    private $x;
    private $y;

    function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
    public function getX(){
        return $this->x;
    }
    public function getY(){
        return $this->y;
    }
}