<?php
$pdfType = 0;
$pdfImages = '';
$pdfUrlsArray;
// <editor-fold defaultstate="collapsed" desc="Проверяем post запрос">
if ($_POST["type"] && $_POST["images"]) {
    $pdfType = $_POST['type'];
    $pdfImages = $_POST['images'];
    $pdfUrlsArray = explode(",", $pdfImages);
    {
        if (count($pdfUrlsArray) < 1) {
            echo('Error. No Images.');
            exit();
        }
    }
} else {
    echo('Error. Incorrect Post params.');
    exit();
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Объявляем все константы">
define("leftMargin", "99");
define("topTextSecondPartLeftMargin", "229");
define("firstPicTopMargin", "129");
define("topTextTopMargin", "34");
define("topLineTopMargin", "88");
define("bottomTextTopMargin", "765");//798
define("picsOnPageMaxHeight", "621");
define("picsOnPageMaxWidth", "940");
define("twoPicsMaxPicWidth", "424");
define("fourPicsMaxPicHeight", "312");
define("fourPicsSecondLineTop", "449");
define("spaceBetweenPisc", "8");
// </editor-fold>
require('fpdf.php');
//require('makefont/makefont.php');
//MakeFont('Optima-Regular.ttf','cp1252');

$pdf = new FPDF('P', 'pt', 'A3');
$pdf->SetAuthor('Vahe Petrosian');
//$pdf->SetFont('Helvetica', 'B', 20);
addFirstPage($pdf, $pdfUrlsArray[0]);
if ($pdfType == 1) {
    for ($i = 1; $i <= count($pdfUrlsArray) - 1; $i++) {
        addPageStart($pdf);
        addPic($pdf, $pdfUrlsArray[$i], picsOnPageMaxWidth, picsOnPageMaxHeight, leftMargin, firstPicTopMargin);
        addPageEnd($pdf);
    }
}
if ($pdfType == 2) {
    $picOnPage = 0;
    $leftMargin = 0;
    for ($i = 1; $i <= count($pdfUrlsArray) - 1; $i++) {


        if ($picOnPage == 0) {
            addPageStart($pdf);
            $leftMargin = addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, picsOnPageMaxHeight, leftMargin, firstPicTopMargin);
            $picOnPage++;
        } else
            if ($picOnPage == 1) {
                addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, picsOnPageMaxHeight, intval(leftMargin) + $leftMargin + intval(spaceBetweenPisc), firstPicTopMargin);
                $leftMargin = 0;
                $picOnPage = 0;
                addPageEnd($pdf);
            }

    }
    if ($picOnPage == 1) {
        addPageEnd($pdf);
    }
}
if ($pdfType == 3) {
    $picOnPage = 0;
    $leftMargin = 0;
    for ($i = 1; $i <= count($pdfUrlsArray) - 1; $i++) {

        if ($picOnPage == 0) {
            addPageStart($pdf);
            $leftMargin = addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, fourPicsMaxPicHeight, leftMargin, firstPicTopMargin);
            $picOnPage++;
        } else
            if ($picOnPage == 1) {
                addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, fourPicsMaxPicHeight, intval(leftMargin) + $leftMargin + intval(spaceBetweenPisc), firstPicTopMargin);
                $leftMargin = 0;
                $picOnPage++;
            } else
                if ($picOnPage == 2) {
                    $leftMargin = addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, fourPicsMaxPicHeight, leftMargin, fourPicsSecondLineTop);
                    $picOnPage++;
                } else
                    if ($picOnPage == 3) {
                        addPic($pdf, $pdfUrlsArray[$i], twoPicsMaxPicWidth, fourPicsMaxPicHeight, intval(leftMargin) + $leftMargin + intval(spaceBetweenPisc), fourPicsSecondLineTop);
                        $leftMargin = 0;
                        //$pdf->Image($pdfUrlsArray[$i],400,510,0,300);
                        $picOnPage = 0;
                        addPageEnd($pdf);
                    }
    }
    if ($picOnPage > 0) {
        addPageEnd($pdf);
    }
}

addLastPage($pdf);
$pdf->Output('yourselection.pdf', 'I');


function addPic($pdf, $picUrl, $maxWidthPP, $maxHeightPP, $left, $top)
{
    list($widthPX, $heightPX) = getimagesize($picUrl);
    $koef = $heightPX / $maxHeightPP;
    $widthPP = $widthPX / $koef;
    if ($widthPP < $maxWidthPP) {
        $pdf->Image($picUrl, $left, $top, 0, $maxHeightPP);
        return $widthPP;
    } else {
        $pdf->Image($picUrl, $left, $top, $maxWidthPP, 0);
        return $maxWidthPP;
    }
}

function addFirstPage($pdf, $picUrl)
{
    addPageStart($pdf);
    addPic($pdf, $picUrl, picsOnPageMaxWidth, picsOnPageMaxHeight, leftMargin, firstPicTopMargin);
    addPageEnd($pdf);
}

function addLastPage($pdf)
{
    addPageStart($pdf);
    addPageEnd($pdf);
}

function addPageStart($pdf)
{
    $pdf->AddPage('A');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',27);
    $pdf->SetXY(leftMargin, topTextTopMargin);
    $pdf->Write(27,'K E I T H'); 

    $pdf->SetTextColor(169,27,39);
    $pdf->SetFont('Arial','',27);
    $pdf->SetXY(topTextSecondPartLeftMargin, topTextTopMargin);
    $pdf->Write(27,'S C H O F I E L D');
    $pdf->Image('topLine.png', 0, topLineTopMargin , 1100, 0);
}

function addPageEnd($pdf)
{
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',16);
    $pdf->SetXY(leftMargin, bottomTextTopMargin);
    $pdf->Write(16,'© KEITH SCHOFIELD |');
    $pdf->SetTextColor(169,27,39);
    $pdf->Write(16,' View more ...','http://google.com');
}
?>