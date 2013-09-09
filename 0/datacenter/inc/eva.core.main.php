<?php
Class EVA {
	
	
	
	// public function toRadarJson(){
		// return json_encode($this->radar_json);
	// }
	
	public function generateTotalPoints($caption, $p_baidu, $p_uc, $p_qq) {
		$arr_json = array(
			'chart'=>array('yaxisname'=>'','caption'=>$caption,'yAxisMaxValue'=>'10','numberprefix'=>'','useroundedges'=>'1','bgcolor'=>'FFFFFF,FFFFFF','showborder'=>'0'),
			'data'=>array(array('label'=>'baidu','value'=>$p_baidu),
			array('label'=>'uc','value'=>$p_uc),
			array('label'=>'qq','value'=>$p_qq))
		);
		
		return json_encode($arr_json);
	}
	
	
}	
	

	
?>