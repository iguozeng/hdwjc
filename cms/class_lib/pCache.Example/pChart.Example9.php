<?php
 /*
     Example9 : Showing how to use labels
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(0,70,70,0,0,70,70,0,0,70),"Serie1");
 $DataSet->AddPoint(array(0.5,2,4.5,8,12.5,18,24.5,32,40.5,50),"Serie2");

 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie();
 $DataSet->SetSerieName("一月","Serie1");
 $DataSet->SetSerieName("二月","Serie2");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setGraphArea(50,30,585,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("include/fonts/simhei.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

 // Set labels
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1","2","日产量",221,230,174);
 $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2","6","产品损益",239,233,195);

 // Finish the graph
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->drawTitle(50,22,"实例(9)",50,50,50,585);
 $Test->Render("report/example9.png");
?>
<img src="report/example9.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">