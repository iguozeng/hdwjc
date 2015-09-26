<?php   
include("../include/init.php");    
include(YXS."class_lib/class.pData.php");   
include(YXS."class_lib/class.pChart.php");   
// Dataset definition    
$DataSet = new pData;   
$DataSet->ImportFromCSV(YXS."report_data/bulkdata.csv",",",array(1,2,3),FALSE,0);   
$DataSet->AddAllSeries();   
$DataSet->SetAbsciseLabelSerie();   
$DataSet->SetSerieName("һ��","Serie1");   
$DataSet->SetSerieName("����","Serie2");   
$DataSet->SetSerieName("����","Serie3");   
$DataSet->SetYAxisName("ƽ������");
$DataSet->SetYAxisUnit("��");
// Initialise the graph   
$Test = new pChart(700,230);
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",8);   
$Test->setGraphArea(70,30,680,200);   
$Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240); //Բ�ǵ��ǲ���
$Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  //Բ�Ǳ߿���� 
$Test->drawGraphArea(255,255,255,TRUE); //��ͼ����͸��
$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);   //�������� 
$Test->drawGrid(4,TRUE,230,230,230,50); //����������
// Draw the 0 line   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",6);   
$Test->drawTreshold(0,143,55,72,TRUE,TRUE);   
$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  //��������   
$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);  //��ע���߽ڵ�
// Finish the graph   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",8);   
$Test->drawLegend(75,35,$DataSet->GetDataDescription(),255,255,255);   
$Test->setFontProperties(YXS."include/fonts/simhei.ttf",10);   
$Test->drawTitle(60,22,"ʵ��(1)",50,50,50,585);  
$Test->Render(YXS."report_data/example1.png");
?>
<img src="/report_data/example1.png" style="background-image:url(include/sysimg/report_bg.jpg);padding:15px 30px 10px 20px">