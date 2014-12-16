<?php

namespace Paliari;

use Paliari\Gd\Color;
use Paliari\Gd\Image;
use Paliari\Gd\Point;
use Paliari\Gd\Rect;
use Paliari\Gd\Size;

/**
 * Class ImageFacade
 * @package Paliari
 */
class ImageFacade
{

    private static $_instance;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var Point
     */
    protected $current_point;

    /**
     * @var string
     */
    protected $font = '';

    /**
     * @var string
     */
    protected $font_path = '';

    /**
     * @var int
     */
    protected $font_size = 12;

    /**
     * @var int
     */
    protected $cell_padding = 10;

    /**
     * @var Color
     */
    protected $font_color;

    public function __construct()
    {
        $this->font_path     = dirname(dirname(__DIR__)) . '/font';
        $this->current_point = new Point();
        $this->font_color    = new Color();
        $this->setFont('arial');
    }

    /**
     * @return static
     */
    public static function instance()
    {
        return static::$_instance = static::$_instance ?: new static();
    }

    /**
     * @param int|resource|Image|array|string $width
     * @param int                             $height
     *
     * @return static
     */
    public static function create($width, $height)
    {
        static::instance()->setImage(new Image($width, $height));

        return static::instance();
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return Point
     */
    public function getCurrentPoint()
    {
        return $this->current_point;
    }

    /**
     * @param Point $current_point
     */
    public function setCurrentPoint($current_point)
    {
        $this->current_point = $current_point;
    }

    /**
     * @param        $w
     * @param        $h
     * @param string $text
     * @param bool   $border
     * @param bool   $ln
     *
     * @return $this
     */
    public function cell($w, $h, $text = '', $border = false, $ln = false)
    {
        $p = $this->getCurrentPoint();
        if (!$w) {
            $w = $this->getImage()->getSize()->width - $p->x;
        }
        if ($border) {
            $this->getImage()->rectangle(new Rect(new Size($w, $h), $this->current_point));
        }
        if ($text) {
            $this->getImage()
                 ->text($text,
                     new Point($p->x + $this->getCellPadding(), $p->y + $h - $this->getCellPadding()),
                     $this->getFont(),
                     $this->getFontSize(),
                     $this->getFontColor()
                 )
            ;
        }
        $p->x = $p->x + $w;
        if ($ln) {
            $p->x = 0;
            $p->y = $p->y + $h;
        }
        $this->setCurrentPoint($p);

        return $this;
    }

    /**
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * @param string $font
     * @param string $path
     * @param string $ext
     *
     * @return $this
     */
    public function setFont($font, $path = '', $ext = 'ttf')
    {
        $path       = $path ?: $this->font_path;
        $this->font = "$path/$font.$ext";

        return $this;
    }

    /**
     * @return Color
     */
    public function getFontColor()
    {
        return $this->font_color;
    }

    /**
     * @param Color $font_color
     *
     * @return $this
     */
    public function setFontColor($font_color)
    {
        $this->font_color = $font_color;

        return $this;
    }

    /**
     * @return string
     */
    public function getFontPath()
    {
        return $this->font_path;
    }

    /**
     * @param string $font_path
     *
     * @return $this
     */
    public function setFontPath($font_path)
    {
        $this->font_path = $font_path;

        return $this;
    }

    /**
     * @return int
     */
    public function getFontSize()
    {
        return $this->font_size;
    }

    /**
     * @param int $font_size
     *
     * @return $this
     */
    public function setFontSize($font_size)
    {
        $this->font_size = $font_size;

        return $this;
    }

    /**
     * @return int
     */
    public function getCellPadding()
    {
        return $this->cell_padding;
    }

    /**
     * @param int $cell_padding
     */
    public function setCellPadding($cell_padding)
    {
        $this->cell_padding = $cell_padding;
    }

}
