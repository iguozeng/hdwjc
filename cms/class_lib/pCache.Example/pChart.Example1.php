<?php   
include("../include/init.php");    
include(YXS."class_lib/class.pData.php");   
include(YXS."class_lib/class.pChart.php");   
// Dataset definition    
$DataSet = new pData;   
$DataSet->ImportFromCSV(YXS."report_data/bulkdata.csv",",",array(1,2,3),FALSE,0);   
$DataSet->AddAllSeries();   
$DataSet->SetAbsciseLabelSerie();   
$DataSet->SetSerieName("一月","Serie1");   
$DataSet->SetSerieName("二月","Serie2");   
$DataSet->SetSerieName("三月","Serie3");   
$DataSet->SetYAxisName("平均年龄");
$DataSet->SetYAxisUnit("岁");
// Initialise the graph   
$Test = new pChart(700,230);
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",8);   
$Test->setGraphArea(70,30,680,200);   
$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240); //圆角捣角参数
$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  //圆角边框参数 
$Test->drawGraphArea(255,255,255,TRUE); //主图背景透明
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);   //载入数据 
$Test->drawGrid(4,TRUE,230,230,230,50); //增加虚网格
// Draw the 0 line   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",6);   
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);   
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  //绘制曲线   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);  //标注曲线节点
// Finish the graph   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",8);   
$Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",10);   
$Test->drawTitle(60,22,"实例(1)",50,50,50,585);  
$Test->Render(YXS."report_data/example1.png");
?>
<img src="/report_data/example1.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">