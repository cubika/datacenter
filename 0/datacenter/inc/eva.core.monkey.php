<?php

if(!class_exists('EVA')){ include 'inc/eva.core.main.php'; }

Class Monkey {
	private $json = array(
		'chart' => array(
			'palette' => '2',
			'caption' => 'Monkey评测', 
			'showvalues' => '0', 
			'divlinedecimalprecision' => '1', 
			'limitsdecimalprecision' => '1', 
			'pyaxisname' => '运行时长', 
			'syaxisname' => '异常数', 
			'formatnumberscale' => '0', 
			'numvisibleplot' => '5' 
		), 
		'categories' => array(array(
			'category' => array(array('label' => 'baidu'), array('label' => 'uc'), array('label' => 'qq'))
		)),
		'dataset' => array(
			array(
				'seriesname' => '运行时长', 
				'parentyaxis' => 'S', 
				'data' => array(
					array('value' => '3616'), 
					array('value' => '3650'), 
					array('value' => '4853')
				)
			),
			array(
				'seriesname' => '异常数', 
				'linethickness' => '3', 
				'data' => array(
					array('value' => '2'), 
					array('value' => '1'), 
					array('value' => '2')))
		 )
	);
	
	public function toJson(){
		return json_encode($this->json);
	}
}
?>

