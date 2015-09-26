<?php
 /*
     Example16 : Importing CSV data
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->ImportFromCSV("data/CO2.csv",",",array(1,2,3,4,5,6,7,8,9),TRUE,0);
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie();
 $DataSet->SetYAxisName("CO2 浓度");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->reportWarnings("GD");
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setGraphArea(60,30,680,180);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,90,2);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("include/fonts/simhei.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

 // Finish the graph
 $Test->setFontProperties("include/fonts/simhei.ttf",8);   
 $Test->drawLegend(70,40,$DataSet->GetDataDescription(),255,255,255);   
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->drawTitle(60,22,"CO2巧克力浓度",50,50,50,585);
 $Test->Render("report/example16.png");
?>
<img src="report/example16.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">