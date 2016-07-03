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
//var_dump ($pdfUrlsArray);
	for ($i = 0; $i <= count($pdfUrlsArray) - 1; $i++) // kastil kotoriy pomenyaet vse umenshennie kartinki na ix analog
	{
		$lastPoint = strripos($pdfUrlsArray[$i],'.');
		$lastLine = strripos($pdfUrlsArray[$i],'-');
		$pdfUrlsArray[$i] = substr($pdfUrlsArray[$i], 0, $lastLine).substr($pdfUrlsArray[$i], $lastPoint, strlen($pdfUrlsArray[$i])-1); 		
	}
//var_dump ($pdfUrlsArray);
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Объявляем все константы">
define("leftMargin", "99");
define("topTextSecondPartLeftMargin", "229");
define("firstPicTopMargin", "129");
define("topTextTopMargin", "34");
define("topSecondLineTopMargin", "78");
define("bottomTextTopMargin", "765");//798
define("picsOnPageMaxHeight", "621");
define("picsOnPageMaxWidth", "940");
define("twoPicsMaxPicWidth", "424");
define("fourPicsMaxPicHeight", "312");
define("fourPicsSecondLineTop", "449");
define("spaceBetweenPisc", "8");
// </editor-fold>
require('fpdf.php');

class FPDF_CellFit extends FPDF {
	//http://fpdf.de/downloads/add-ons/fit-text-to-cell.html
    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1, 1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, true);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }

}


//require('makefont/makefont.php');
//MakeFont('Optima-Regular.ttf','cp1252');

$pdf = new FPDF_CellFit('P', 'pt', 'A3');
$pdf->SetAuthor('VP');
$pdf->AddFont('PtSerif','','PTF55F.php');
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
	/*
    addPageStart($pdf);
    addPageEnd($pdf);
	*/
}

function addPageStart($pdf)
{
    $pdf->AddPage('A');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('PtSerif','',28);
    $pdf->SetXY(leftMargin, topTextTopMargin);
    //$pdf->Write(28,'KEITH SCHOFIELD'); 
	$pdf->CellFitSpaceForce(350, 9, 'KEITH SCHOFIELD', 0, 0, '', 0);
	
	$pdf->SetFont('PtSerif','',16);
    $pdf->SetXY(leftMargin, topSecondLineTopMargin);
    //$pdf->Write(16,'PHOTOGRAPHY'); 
	$pdf->CellFitSpaceForce(200, 5, 'PHOTOGRAPHY', 0, 0, '', 0);
	/*
    $pdf->SetTextColor(169,27,39);
    $pdf->SetFont('Arial','',27);
    $pdf->SetXY(topTextSecondPartLeftMargin, topTextTopMargin);
    $pdf->Write(27,'S C H O F I E L D');
    $pdf->Image('topLine.png', 0, topLineTopMargin , 1100, 0);
	*/
}

function addPageEnd($pdf)
{
	/*
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',16);
    $pdf->SetXY(leftMargin, bottomTextTopMargin);
    $pdf->Write(16,'© KEITH SCHOFIELD |');
    $pdf->SetTextColor(169,27,39);
    $pdf->Write(16,' View more ...','http://google.com');
	*/
}
?>