<?php
 /*
     Example3 : an overlayed bar graph, uggly no?
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(1,4,-3,2,-3,3,2,1,0,7,4,-3,2,-3,3,5,1,0,7),"Serie1");
 $DataSet->AddPoint(array(0,3,-14,1,-2,2,1,0,-1,6,3,-4,1,-4,2,4,0,-1,6),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie();
 $DataSet->SetSerieName("一月","Serie1");
 $DataSet->SetSerieName("二月","Serie2");
  $DataSet->SetYAxisName("平均年龄");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setGraphArea(50,30,585,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("include/fonts/simhei.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the bar graph
 $Test->drawOverlayBarGraph($DataSet->GetData(),$DataSet->GetDataDescription());

 // Finish the graph
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->drawTitle(50,22,"实例(3)",50,50,50,585);
 $Test->Render("report/example3.png");
?>
<img src="report/example3.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">