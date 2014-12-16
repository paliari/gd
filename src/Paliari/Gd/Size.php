<?php

namespace Paliari\Gd;

/**
 * Class Size
 * @package Paliari\Gd
 */
class Size
{

    public $width;
    public $height;

    /**
     * @param int|resource|Size|array $width
     * @param int                     $height
     */
    public function __construct($width = 100, $height = null)
    {
        if (!is_numeric($width)) {
            if (is_resource($image = $width)) {
                $width  = imagesx($image);
                $height = imagesy($image);
            } elseif (is_array($array = $width)) {
                list($width, $height) = array_values($array);
            } elseif (is_string($file = $width) && is_readable($file)) {
                list($width, $height) = getimagesize($file);
            } elseif ($width instanceof static) {
                $size   = $width;
                $width  = $size->width;
                $height = $size->height;
            }
        }
        $this->width  = $width;
        $this->height = $height;
    }

    public function getRatio()
    {
        return $this->width / $this->height;
    }

    /**
     * @param Size $target
     *
     * @return Size
     */
    public function fit($target)
    {
        if ($this->getRatio() > $target->getRatio()) {
            $width  = $target->width;
            $height = $width / $this->getRatio();
        } else {
            $height = $target->height;
            $width  = $height * $this->getRatio();
        }

        return new static($width, $height);
    }

    /**
     * @param float $times
     *
     * @return static
     */
    public function zoom($times)
    {
        return new static($times * $this->width, $times * $this->height);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("(%d/%d=%0.2f)", $this->width, $this->height, $this->getRatio());
    }

}
