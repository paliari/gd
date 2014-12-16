<?php

namespace Paliari\Gd;

/**
 * Class Point
 * @package Paliari\Gd
 */
class Point
{

    public $x = 0;
    public $y = 0;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct($x = 0, $y = 0)
    {
        if (!is_numeric($x)) {
            if (is_array($array = $x)) {
                $x = reset($array);
                $y = end($array);
            } elseif ($x instanceof Point) {
                $point = $x;
                $x     = $point->x;
                $y     = $point->y;
            } elseif ($x instanceof Rect) {
                $rect = $x;
                $x    = $rect->origin->x;
                $y    = $rect->origin->y;
            }
        }
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("(%d, %d)", $this->x, $this->y);
    }

}
