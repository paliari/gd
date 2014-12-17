<?php

use Paliari\Gd\Image,
    Paliari\Gd\Color;

require_once "../vendor/autoload.php";

/*$discriminacao = " SERVICOS EXEMPLO - R$  1000.00
 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00
 REFERENTE AO VENCIMENTO: 12/2010 SERVICOS EXEMPLO - R$  1000.00
 REFERENTE AO VENCIMENTO: 12/2010";
$discriminacao = str_replace(array("\t"), '', $discriminacao);
$discriminacao = wordwrap($discriminacao, strlen($discriminacao)>1000 ? 125 : 105, "\n", true);
$count = count(explode("\n", $discriminacao));
if (strlen($discriminacao)<1000 && $count<16) {
    $fontSizeDisc = 8;
} else {
    $fontSizeDisc = 7;
}
if ($count>16) {
    $discriminacao = implode("\n", explode("\n", $discriminacao, 16-$count)) . '...';
}

echo $discriminacao;*/


$w    = 1.5*793;
$logo = "isse.png";
$h    = 1.5*1122;
$file = dirname(__DIR__) . '/tmp/img.jpg';

$f = \Paliari\ImageFacade::create($w, $h);
$f->getImage()->margin(1);
$f->cell(200, 50, 'kajdkfajsdksa ajdlkf', true);
//$f->cell(200, 60, 'hfskdjhfksafhkdsj', true);
//$f->cell(278, 50, 'hfskdjhfksafhkdsj', true);
//$f->cell(200, 50, 'hfskdjhfksafhkdsj', true, true);
//$f->cell(200, 50, 'hfskdjhfksafhkdsj', true);
//$f->cell(200, 50, 'hfskdjhfksafhkdsj oiuroiqweur ewrer ewoirueir uweqoiru wqepoir uewpor uewr qwe iorq', true, true);
//$f->cell(200, 50, "iewierp\njkjlklk", true);
//$f->cell(200, 50, "iewierp\njkjlklk", true);
//$f->cell(200, 50, "iewierp\njkjlklk", true);
$f->cell(200, 50, "iewierp\njkjlklk", true, true);
//$f->setFontColor(new Color(0, 0, 255));
$f->setFontSize(10)->cell(700, 50, "Font Arial(10) OEWIERP INCO", true, true);
$f->setFontSize(12)->cell(700, 50, "Font Arial(12) OEWIERP INCO", true, true);
$f->setFontSize(15)->cell(700, 50, "Font Arial(15) OEWIERP INCO", true, true);
$f->setFontSize(20)->cell(700, 50, "Font Arial(20) OEWIERP INCO", true, true);
$f->setFontSize(25)->cell(700, 50, "Font Arial(25) OEWIERP INCO", true, true);
$f->setFont('arialbd');
$f->setFontSize(10)->cell(700, 50, "Font Arialbd (10) OEWIERP INCO", true, true);
$f->setFontSize(12)->cell(700, 50, "Font Arialbd (12) OEWIERP INCO", true, true);
$f->setFontSize(15)->cell(700, 50, "Font Arialbd (15) OEWIERP INCO", true, true);
$f->setFontSize(20)->cell(0, 50, "Font Arialbd (20) OEWIERP INCO", true, true);
$f->setFontSize(25)->cell(0, 50, "Font Arialbd (25) OEWIERP INCO", true, true);

$f->setFontSize(15)->cell(0, 35, "Font Arialbd (15) OEWIERP INCO", true, true);

$text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta ligula. Mauris consectetur lectus et luctus elementum. Morbi enim nunc, molestie a consequat eget, fringilla ac tortor. Aenean porta metus ac laoreet congue. Nunc quis sodales tortor, in dictum risus. Nunc condimentum malesuada eros sed dictum. Nam justo tortor, aliquam eu porttitor sed, fermentum ac sapien. Fusce in gravida ex, sed feugiat quam.

Nullam eget dignissim diam, et fermentum urna. Aliquam posuere est venenatis, venenatis est at, sodales arcu. Pellentesque blandit feugiat nisl, vel aliquam tellus lacinia ut. Vestibulum convallis ante quis ullamcorper luctus. Integer vestibulum cursus mi, et pellentesque ligula euismod ut. Cras vel vulputate nibh, a convallis enim. Suspendisse tincidunt blandit dui, in maximus tellus mollis eu. Sed non ipsum massa.

Fusce ultricies bibendum lectus, id hendrerit augue auctor nec. Suspendisse purus purus, rhoncus a lacus nec, convallis pharetra erat. Sed congue venenatis diam, ut blandit massa placerat sed. Donec nibh nibh, lobortis a eros nec, aliquet facilisis neque. Mauris eu mauris ac est ultricies rhoncus. Integer ornare egestas nisl vel gravida. Cras urna ligula, interdum eget mi ac, pretium posuere lorem.

Fusce blandit congue massa, non sagittis ipsum imperdiet ac. Pellentesque vulputate enim leo, nec interdum nulla pharetra eu. Nulla venenatis metus justo, ut laoreet est sodales id. Nullam porta dolor sit amet justo fringilla rhoncus. Donec ac turpis sapien. Maecenas laoreet dictum felis, tristique rutrum ligula bibendum vulputate. Vestibulum elit metus, fermentum at diam ac, porttitor vestibulum leo. Nam eu lacus eget sem ultricies sodales. Cras quis lacinia tortor. Vestibulum fringilla facilisis nibh ac ultrices. Ut rhoncus dui et eros molestie, eget bibendum dui efficitur. Suspendisse suscipit lacus et mi faucibus lobortis.

Sed dignissim nisl ornare dolor feugiat mollis. Quisque faucibus dui turpis, sed sollicitudin lacus consequat nec. Curabitur faucibus tincidunt quam, eu posuere ante tristique et. Pellentesque vulputate luctus massa et sodales. Quisque facilisis arcu in sem dictum, ut interdum nisl aliquam. In ac lacus eros. Aliquam a eros viverra, consectetur mauris quis, tempus lacus. Donec ultrices ultrices consequat. Morbi justo augue, ornare in luctus eu, condimentum sit amet dui.

Vivamus sed aliquet tellus, ut consectetur dui. Vestibulum ut velit pharetra, venenatis augue a, vestibulum nisl. Mauris vitae faucibus nisi. Suspendisse non ligula sed purus lacinia faucibus sit amet in quam. Proin tempor felis ex, eget egestas sapien aliquet id. Praesent at mi quis nisi accumsan laoreet sed luctus quam. Maecenas volutpat lectus est, id rutrum justo ullamcorper dictum. Nulla vel blandit libero. Donec a laoreet ex.

Aliquam volutpat, sapien id eleifend consequat, magna odio ultricies ligula, eu consequat lacus augue sed nisl. Nulla hendrerit non nibh eu porta. Aenean hendrerit turpis et augue tempus, eu imperdiet lectus blandit. Mauris egestas ultricies nulla, non scelerisque ex tristique id. Duis id ex at mauris tempus dapibus. Nullam sollicitudin, mauris sed imperdiet elementum, felis turpis condimentum enim, nec rhoncus ligula tellus eu urna. Vestibulum in urna leo. Morbi imperdiet elementum luctus. Aenean vel elementum erat, nec elementum leo. Donec dignissim sem eu tellus laoreet fringilla sit amet in enim. Fusce quis lectus vel velit ornare imperdiet nec quis leo. In tincidunt, arcu efficitur finibus feugiat, sapien nibh eleifend mauris, imperdiet pulvinar felis purus imperdiet dolor. Etiam at velit et quam convallis vestibulum id nec lacus.

Etiam eget sagittis sem. In quis nibh luctus, posuere nibh nec, consequat augue. Cras imperdiet lorem quis tincidunt pulvinar. Sed porttitor est non felis tempus, sit amet tempus enim faucibus. Morbi malesuada lacinia leo. Aliquam consectetur nunc in justo molestie elementum. Aenean venenatis convallis orci scelerisque porttitor. Sed erat nunc, laoreet sed posuere.";

$f->setFont('arial');

$f->setFontSize(15)->multCell(0, $text, true);

$f->text('volutpat, sapien id eleifend consequat, magna odio ultricies ligula,', null, $f->getCurrentPoint()->y + 50);

$img = $f->getImage();
//$img->margin(2);

$l = new Image($logo);

$img->copyResampled($l, new \Paliari\Gd\Point(700, 100), $l->getSize()->zoom(0.5));


$img->save($file);
//$img = new Image($file);
//$img = $img->resize($img->getSize()->zoom(0.7));
//$img->save($file.'r.jpg');
