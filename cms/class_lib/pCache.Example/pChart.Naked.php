<?php
 /*
     Naked: Naked and easy!
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(1,4,3,2,3,3,2,1,0,7,4,3,2,3,3,5,1,0,7));
 $DataSet->AddSerie();
 $DataSet->SetSerieName("实例数据","Serie1");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->setGraphArea(40,30,680,200);
 $Test->drawGraphArea(252,252,252,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
 $Test->drawGrid(4,TRUE,230,230,230,70);

 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

 // Finish the graph
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(45,35,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->drawTitle(60,22,"我漂亮的图表",50,50,50,585);
 $Test->Render("report/Naked.png");
?>
<img src="report/Naked.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">