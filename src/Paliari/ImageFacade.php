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
        static::instance()->setImage(static::newImage($width, $height));

        return static::instance();
    }

    /**
     * @param int|resource|Image|array|string $width
     * @param int                             $height
     *
     * @return Image
     */
    public static function newImage($width, $height = null)
    {
        return new Image($width, $height);
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
     * @param int  $w
     * @param int  $h
     * @param bool $ln
     */
    protected function nextPoint($w, $h, $ln = true)
    {
        $p    = $this->getCurrentPoint();
        $p->x = $p->x + $w;
        if ($ln) {
            $p->x = 0;
            $p->y = $p->y + $h;
        }
        $this->setCurrentPoint($p);
    }

    /**
     * @param int $w
     *
     * @return int
     */
    protected function prepareWidth($w)
    {
        if (!$w) {
            $w = $this->getImage()->getSize()->width - $this->getCurrentPoint()->x;
        }

        return $w;
    }

    /**
     * @param int    $w
     * @param int    $h
     * @param string $text
     * @param bool   $border
     * @param bool   $ln
     *
     * @return $this
     */
    public function cell($w, $h, $text = '', $border = false, $ln = false)
    {
        $p = $this->getCurrentPoint();
        $w = $this->prepareWidth($w);
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
        $this->nextPoint($w, $h, $ln);

        return $this;
    }

    /**
     * @param int    $w
     * @param string $text
     * @param bool   $border
     *
     * @return $this
     */
    public function multCell($w, $text, $border = false)
    {
        $p    = $this->getCurrentPoint();
        $w    = $this->prepareWidth($w);
        $text = $this->prepareText($text, $w);
        $size = $this->getTextSize($text);
        $h    = $size['h'] + $this->getCellPadding() * 2;
        if ($border) {
            $this->getImage()->rectangle(new Rect(new Size($w, $h), $this->current_point));
        }
        if ($text) {
            $this->getImage()
                 ->text($text,
                     new Point($p->x + $this->getCellPadding(), $p->y + $this->getFontSize() + $this->getCellPadding()),
                     $this->getFont(),
                     $this->getFontSize(),
                     $this->getFontColor()
                 )
            ;
        }
        $this->nextPoint($w, $h);

        return $this;
    }

    /**
     * @param string $text
     * @param int    $w
     *
     * @return string
     */
    protected function prepareText($text, $w)
    {
        $lines = explode("\n", $text);
        foreach ($lines as $k => $line) {
            $lines[$k] = $this->prepareTextLine($line, $w);
        }

        return implode("\n", $lines);
    }

    /**
     * @param string $text
     * @param int    $w
     *
     * @return string
     */
    protected function prepareTextLine($text, $w)
    {
        $text = trim($text);
        $len  = strlen($text) ?: 1;
        $size = $this->getTextSize($text);
        $wx   = ($size['w'] / $len) ?: 1;
        $tw   = floor(($w - $this->getCellPadding() * 2) / $wx);

        return wordwrap($text, $tw, "\n", true);
    }

    /**
     * Obtem um array com a largura ['w'] e altura['h'] do texto alem dos index nativos do php.
     *
     * @param string $text
     *
     * @return array
     */
    protected function getTextSize($text)
    {
        $size      = imagettfbbox($this->getFontSize(), 0, $this->getFont(), $text);
        $size['w'] = $size[2] - $size[0];
        $size['h'] = $size[1] - $size[7];

        return $size;
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

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX($x)
    {
        $this->current_point->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->getCurrentPoint()->x;
    }

    /**
     * @param int $y
     *
     * @return $this
     */
    public function setY($y)
    {
        $this->current_point->y = $y;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->getCurrentPoint()->y;
    }

    /**
     * @param string    $text
     * @param int|Point $x
     * @param int       $y
     *
     * @return $this
     */
    public function text($text, $x = null, $y = null)
    {
        $point = $this->preparePoint($x, $y);
        $this->getImage()->text($text, $point, $this->getFont(), $this->getFontSize(), $this->getFontColor());

        return $this;
    }

    /**
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     *
     * @return $this
     */
    public function line($x1, $y1, $x2, $y2)
    {
        $p1 = $this->newPoint($x1, $y1);
        $p2 = $this->newPoint($x2, $y2);
        $this->getImage()->line($p1, $p2, $this->getFontColor());

        return $this;
    }

    /**
     * @param Image|string $src
     * @param int|Point    $x
     * @param int          $y
     *
     * @return $this
     */
    public function copyResampled($src, $x = null, $y = null)
    {
        if (is_string($src)) {
            $src = $this->newImage($src);
        }
        $point = $this->preparePoint($x, $y);
        $this->getImage()->copyResampled($src, $point);

        return $this;
    }

    /**
     * @param int|Point $x
     * @param int       $y
     *
     * @return Point
     */
    protected function preparePoint($x, $y)
    {
        if ($x instanceof Point) {
            return $x;
        } else {
            $x     = null === $x ? $this->getCurrentPoint()->x : $x;
            $y     = null === $y ? $this->getCurrentPoint()->y : $y;
            $point = $this->newPoint($x, $y);

            return $point;
        }
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return Point
     */
    public function newPoint($x = 0, $y = 0)
    {
        return new Point($x, $y);
    }

    /**
     * Send image to the browser with appropriated headers
     *
     * @param string $ext
     * @param int    $quality
     *
     * @return $this
     */
    public function flush($ext = null, $quality = 75)
    {
        $this->getImage()->flush($ext, $quality);

        return $this;
    }

    /**
     * Saves image to a file
     *
     * @param string $file
     * @param int    $quality
     *
     * @return $this
     */
    public function save($file, $quality = 75)
    {
        $this->getImage()->save($file, $quality);

        return $this;
    }

}
