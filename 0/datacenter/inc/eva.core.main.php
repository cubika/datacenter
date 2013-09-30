<?php
Class EVA {
	
	
	
	// public function toRadarJson(){
		// return json_encode($this->radar_json);
	// }
	
	public function generateTotalPoints($caption, $p_pns) {
		$arr_json = array(
			'chart'=>array('yaxisname'=>'','caption'=>$caption,'yAxisMaxValue'=>'10','numberprefix'=>'','useroundedges'=>'1','bgcolor'=>'FFFFFF,FFFFFF','showborder'=>'0'),
			'data'=>array()
		);
		
		// array('label'=>'baidu','value'=>$p_baidu),
			// array('label'=>'uc','value'=>$p_uc),
			// array('label'=>'qq','value'=>$p_qq)
		
		foreach ($p_pns as $key => $value) {
			$item = array('label'=>$key, 'value'=>$value);
			array_push($arr_json['data'], $item);
		}
		
		return json_encode($arr_json);
	}
	
	
}	
	

	
?>