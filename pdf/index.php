<?php

require_once('../vendor/autoload.php');

//plantilla html
require_once('plantillas/reporte/index.php');

//codigo css de plantilla
require_once('plantillas/reporte/style.css');

//base de datos 
require_once('paoe_db.sql')

$mpdf = new \Mpdf\Mpdf([
    "format" => "A4"

]);

$plantilla = getPlantilla($productos);

$mpdf->writehtml($css, \Mpdf\HTMLParseMode::HEADER_CSS);
$mpdf->writehtml($plantilla, \Mpdf\HTMLParseMode::HTML_BODY);


$mpdf->output("reporte.pdf", "D");