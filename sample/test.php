<?php

use Paliari\Gd\Image,
    Paliari\Gd\Color;

require_once "../vendor/autoload.php";

$w    = 1.5*793;
$logo = "isse.png";
$h    = 1.5*1122;
$file = dirname(__DIR__) . '/tmp/img.jpg';

$f = \Paliari\ImageFacade::create($w, $h);
$f->getImage()->margin();
$f->cell(200, 50, 'kajdkfajsdksa ajdlkf', true);
$f->cell(200, 60, 'hfskdjhfksafhkdsj', true);
$f->cell(278, 50, 'hfskdjhfksafhkdsj', true);
$f->cell(200, 50, 'hfskdjhfksafhkdsj', true, true);
$f->cell(200, 50, 'hfskdjhfksafhkdsj', true);
$f->cell(200, 50, 'hfskdjhfksafhkdsj oiuroiqweur ewrer ewoirueir uweqoiru wqepoir uewpor uewr qwe iorq', true);

$img = $f->getImage();
//$img->margin(2);

$l = new Image($logo);

$img->copyResampled($l, new \Paliari\Gd\Point(100, 200), $l->getSize()->zoom(0.1));


$img->save($file);
//$img = new Image($file);
//$img = $img->resize($img->getSize()->zoom(0.7));
//$img->save($file.'r.jpg');
