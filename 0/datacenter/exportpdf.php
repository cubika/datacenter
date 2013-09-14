<?php
// require_once("inc/dompdf/dompdf_config.inc.php");
// // spl_autoload_register('DOMPDF_autoload');

// ob_start();
// include 'eva_tech.php';
// $html = ob_get_clean();

// $dompdf = new DOMPDF();
// $dompdf->load_html($html);
// $dompdf->render();
// $dompdf->stream("sample.pdf");

include('inc/mpdf/mpdf.php');

$mpdf = new mPDF('utf-8', 'A4');
$html='<html>
		<head>
			<style>
				table,th,td{ border:1px solid black;}
				table{border-collapse:collapse;}
				h1{text-align:center;}
			</style>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<h1>浏览内核评测报告</h1>
			<h2>一、性能评测</h2>
			<h3>1.雷达图</h3>
			FLASH HERE
			<h3>2.平均加载时间</h3>
				<h4>综合评分</h4>
				  FLASH HERE
				<h4>详细评测场景评分</h4><br>'.$_POST["ldt"].
			  '
			 <h3>3.CPU</h3>
			  	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["cpu"].
			  	'
			 <h3>4.内存</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  		<h4>详细评测场景评分</h4><br>'.$_POST["mem"].
			  	'
			 <h3>5.流量</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  		<h4>详细评测场景评分</h4><br>'.$_POST["trf"].
			  	'
			 <h3>6.流畅度</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["fps"].
			  	 '
			 <h3>7.耗电量</h3>
			  	 	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["pow"].
			  	 '
			 <h3>8.Benchmark</h3>
			  	 	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["ben"].
			  	 '
			 <h2>二、稳定性评测</h2>
			 <h2>三、兼容性评测</h2>
		</body>
		</html>
		';

$mpdf->useLang = true;
$mpdf->useAdobeCJK = true;
$mpdf->SetAutoFont(AUTOFONT_ALL);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

// require_once("inc/html2pdf/html2pdf.class.php");

// ob_start();
// include 'eva_tech.php';
// $html = ob_get_clean();
// $html2pdf = new HTML2PDF('P','A4','en');
// $html2pdf->WriteHTML($html);
// $html2pdf->Output('exemple.pdf');


// require('inc/html2fpdf/html2fpdf.php');
// $pdf=new HTML2FPDF();
// $pdf->AddPage();
// ob_start();
// include 'eva_tech.php';
// $html = ob_get_clean();
// $pdf->WriteHTML($html);
// $pdf->Output("docs.pdf");
?>