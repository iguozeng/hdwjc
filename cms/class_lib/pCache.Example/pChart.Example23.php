<?php
 /*
     Example23 : Playing with background bis
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(9,9,9,10,10,11,12,14,16,17,18,18,19,19,18,15,12,10,9),"Serie1");
 $DataSet->AddPoint(array(10,11,11,12,12,13,14,15,17,19,22,24,23,23,22,20,18,16,14),"Serie2");
 $DataSet->AddPoint(array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22),"Serie3");
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("一月","Serie1");
 $DataSet->SetSerieName("二月","Serie2");
 $DataSet->SetYAxisName("温度");
 $DataSet->SetYAxisUnit("度");
 $DataSet->SetXAxisUnit("h");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->drawGraphAreaGradient(132,173,131,50,TARGET_BACKGROUND);

 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setGraphArea(120,20,675,190);
 $Test->drawGraphArea(213,217,221,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,213,217,221,TRUE,0,2,TRUE);
 $Test->drawGraphAreaGradient(163,203,167,50);
 $Test->drawGrid(4,TRUE,230,230,230,20);

 // Draw the bar chart
 $Test->drawStackedBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),70);

 // Draw the title
 $Title = "  2008年月初温度监控均值  ";
 $Test->drawTextBox(0,0,50,230,$Title,90,255,255,255,ALIGN_BOTTOM_CENTER,TRUE,0,0,0,30);

 // Draw the legend
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(610,10,$DataSet->GetDataDescription(),236,238,240,52,58,82);

 // Render the picture
 $Test->addBorder(2);
 $Test->Render("report/example23.png");
?>
<img src="report/example23.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">