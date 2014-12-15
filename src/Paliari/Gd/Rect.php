<?php

namespace Paliari\Gd;

/**
 * Class Rect
 * @package Paliari\Gd
 */
class Rect
{
    /**
     * @var Point
     */
    public $origin;

    /**
     * @var Size
     */
    public $size;

    /**
     * @param Size  $size
     * @param Point $origin
     */
    public function __construct($size, $origin = null)
    {
        $this->size   = $size;
        $this->origin = $origin ?: new Point();
    }

    public function getRight()
    {
        return $this->size->width + $this->origin->x;
    }

    public function getBottom()
    {
        return $this->size->height + $this->origin->y;
    }

    public function contract($factor)
    {
        return $this->expand(-$factor);
    }

    public function expand($factor)
    {
        $size    = new Size($this->size->width + $factor * 2, $this->size->height + $factor * 2);
        $point   = new Point($this->origin->x - $factor, $this->origin->y - $factor);
        $newRect = new Rect($size, $point);

        return $newRect;
    }
}
