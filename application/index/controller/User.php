<?php
namespace app\index\controller;
use lib1\Test;
use com\tcpdf\methods\tcpdf_font_data;
use com\tcpdf\methods\tcpdf_fonts;
use com\tcpdf\methods\tcpdf_colors;
use com\tcpdf\methods\tcpdf_images;
use com\tcpdf\methods\tcpdf_static;
use think\Config;
use com\tcpdf\tcpdf;
class User
{
    public function index()
    {
	$list = Db('keywords')->where('id','>',10)->order('id ASC')->select();
	
    	//vendor('PHPExcel.PHPExcel');
    	//2.加载PHPExcle类库
        vendor('PHPExcel.PHPExcel');
        //3.实例化PHPExcel类
        $objPHPExcel = new \PHPExcel();
        //4.激活当前的sheet表
        $objPHPExcel->setActiveSheetIndex(0);
        //5.设置表格头（即excel表格的第一行）
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', '防伪码')
                                ->setCellValue('C1', '标签码');
        //设置A列水平居中
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //设置单元格宽度
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30); 
        //6.循环刚取出来的数组，将数据逐一添加到excel表格。
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+2),$list[$i]['id']);//ID
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2),$list[$i]['keyword']);//标签码
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2),$list[$i]['flag']);//防伪码
        }
        //7.设置保存的Excel表格名称
        $filename = '印刷防伪码'.date('ymd',time()).'.xls';
        //8.设置当前激活的sheet表格名称；
        $objPHPExcel->getActiveSheet()->setTitle('防伪码');
        //9.设置浏览器窗口下载表格
        header("Content-Type: application/force-download");  
        header("Content-Type: application/octet-stream");  
        header("Content-Type: application/download");  
        header('Content-Disposition:inline;filename="'.$filename.'"');  
        //生成excel文件
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        //下载文件在浏览器窗口
        $objWriter->save('php://output');
        exit;
		// $test=new Test();
		// Config::load(EXTEND_PATH.'com/tcpdf/config/tcpdf_config.php');

		// Config::load(EXTEND_PATH.'com/tcpdf/tcpdf_autoconfig.php');
		// $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT,true, 'UTF-8', false);
		// echo PDF_PAGE_ORIENTATION;
		// return $test->demo();
		
       //echo $this-> king(10,3);
	 //return EXTEND_PATH;
	}
}
