<?php
 /*
     Example25 : Playing with shadow
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
 $Test->drawGraphAreaGradient(90,90,90,90,TARGET_BACKGROUND);
 $Test->setFixedScale(0,40,4);

 // Graph area setup
 $Test->setFontProperties("include/fonts/simhei.ttf",6);
 $Test->setGraphArea(60,40,680,200);
 $Test->drawGraphArea(200,200,200,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,200,200,200,TRUE,0,2);
 $Test->drawGraphAreaGradient(40,40,40,-50);
 $Test->drawGrid(4,TRUE,230,230,230,10);

 // Draw the line chart
 $Test->setShadowProperties(3,3,0,0,0,30,4);
 $Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->clearShadow();
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,0,-1,-1,-1,TRUE);

 // Write the title
 $Test->setFontProperties("include/fonts/simhei.ttf",18);
 $Test->setShadowProperties(1,1,0,0,0);
 $Test->drawTitle(0,0,"温度均值",255,255,255,700,30,TRUE);
 $Test->clearShadow();

 // Draw the legend
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(610,5,$DataSet->GetDataDescription(),0,0,0,0,0,0,255,255,255,FALSE);

 // Render the picture
 $Test->Render("report/example25.png");
?>
<img src="report/example25.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">