<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');



$xml =  simplexml_load_file("sample2.jrxml");


$PHPJasperXML = new PHPJasperXML("en");
$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->arrayParameter=array("descricao"=>$descricao); //passa o parâmetro cadastrado no iReport

$PHPJasperXML->arraydetail=array("sample2line_itemname"=>"teste"); //passa o parâmetro cadastrado no iReport

$PHPJasperXML->xml_dismantle($xml);
//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
