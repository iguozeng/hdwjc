<?php   
 /*
     Example22 : Customizing plot graphs
 */

 // Standard inclusions
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 
  
 // Dataset definition
 $DataSet = new pData;
 $DataSet->AddPoint(array(60,70,90,110,100,90),"Serie1");
 $DataSet->AddPoint(array(40,50,60,80,70,60),"Serie2");
 $DataSet->AddPoint(array("一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"),"Serie3");
 $DataSet->AddSerie("Serie1");
 $DataSet->AddSerie("Serie2");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("A公司","Serie1");
 $DataSet->SetSerieName("B公司","Serie2");
 $DataSet->SetYAxisName("销售额");
 $DataSet->SetYAxisUnit("k");
 $DataSet->SetSerieSymbol("Serie1","data/Point_Asterisk.gif");
 $DataSet->SetSerieSymbol("Serie2","data/Point_Cd.gif");

 // Initialise the graph   
 $Test = new pChart(700,230);
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->setGraphArea(65,30,650,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
 $Test->drawGrid(4,TRUE,230,230,230,50);
  
 // Draw the title
 $Test->setFontProperties("include/fonts/simhei.ttf",6);
 $Title = "A公司 & B公司";
 $Test->drawTextBox(65,30,650,45,$Title,0,255,255,255,ALIGN_RIGHT,TRUE,0,0,0,30);
  
 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
  
 // Draw the legend
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->drawLegend(80,60,$DataSet->GetDataDescription(),255,255,255);

 // Render the chart
 $Test->Render("report/example22.png");
?>
<img src="report/example22.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">