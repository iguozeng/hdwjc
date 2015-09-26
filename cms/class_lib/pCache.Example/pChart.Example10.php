<?php
 /*
     Example10 : A 3D exploded pie graph
 */

 // Standard inclusions   
 include("class_lib/pData.class.php");   
 include("class_lib/pChart.class.php"); 

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(10,2,3,5,3),"Serie1");
 $DataSet->AddPoint(array("һ��","����","����","����","����"),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(420,250);
 $Test->drawFilledRoundedRectangle(7,7,413,243,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,415,245,5,230,230,230);
 $Test->createColorGradientPalette(195,204,56,223,110,41,5);

 // Draw the pie chart
 $Test->setFontProperties("include/fonts/simhei.ttf",8);
 $Test->AntialiasQuality = 0;
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),180,130,110,PIE_PERCENTAGE_LABEL,FALSE,50,20,5);
 $Test->drawPieLegend(330,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

 // Write the title
 $Test->setFontProperties("include/fonts/simhei.ttf",10);
 $Test->drawTitle(10,20,"�����۱�",100,100,100);

 $Test->Render("report/example10.png");
?>
<img src="report/example10.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">