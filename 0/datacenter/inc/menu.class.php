<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class Menu extends DataCenter {

	public function classifyMenu($plid){
		$menus = $this->run_http_api(sprintf(Constants::$menu_fetch_all, $plid));
		
		$_menus = array();
		foreach ($menus as $key => $value) {
			if ($value->layer == 1) {
				$_menus[$value->menuName] = array();
			}
			elseif ($value->layer == 2) {
				array_push($_menus[$value->parentMenu], $value);
			}
		}
		
		return $_menus;
	}
}
