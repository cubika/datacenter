<?php

class Constants {
	
	public static $common_fetch_pns = "http://123.125.70.35:8099/sdc/%s/pns?plid=%s";
	public static $common_fetch_versions = "http://123.125.70.35:8099/sdc/%s/vers?plid=%s";
	public static $common_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/%s/vers?plid=%s&pn=%s";
	public static $common_fetch_scenarios = "http://123.125.70.35:8099/sdc/%s/ts?plid=%s&pn=%s&v=%s";
	public static $common_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/%s?plid=%s&eva=%s";
	public static $common_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/%s/website?plid=%s&pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $ldt_fetch_pns = "http://123.125.70.35:8099/sdc/ldt/pns?plid=%s";
	public static $ldt_fetch_versions = "http://123.125.70.35:8099/sdc/ldt/vers?plid=%s";
	public static $ldt_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/ldt/vers?plid=%s&pn=%s";
	public static $ldt_fetch_scenarios = "http://123.125.70.35:8099/sdc/ldt/ts?plid=%s&pn=%s&v=%s";
	public static $ldt_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/ldt?plid=%s&eva=%s";
	public static $ldt_fetch_avg_by_pn_version_tsid = "http://123.125.70.35:8099/sdc/ldt/avg?plid=%s&pn=%s&v=%s&tsid=%s";
	public static $ldt_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/ldt/website?plid=%s&pn=%s&v=%s&website=%s&tsid=%s";
	public static $ldt_del_by_id = "http://123.125.70.35:8099/sdc/ldt/%s";
	
	public static $cpu_fetch_pns = "http://123.125.70.35:8099/sdc/cpu/pns?plid=%s";
	public static $cpu_fetch_versions = "http://123.125.70.35:8099/sdc/cpu/vers?plid=%s";
	public static $cpu_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/cpu/vers?plid=%s&pn=%s";
	public static $cpu_fetch_scenarios = "http://123.125.70.35:8099/sdc/cpu/ts?plid=%s&pn=%s&v=%s";
	public static $cpu_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/cpu?plid=%s&pns=%s";
	public static $cpu_fetch_details = "http://123.125.70.35:8099/sdc/cpu?plid=%s&pn=%s&v=%s&tsid=%s";
	public static $cpu_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/cpu/website?pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $mem_fetch_pns = "http://123.125.70.35:8099/sdc/mem/pns?plid=%s";
	public static $mem_fetch_versions = "http://123.125.70.35:8099/sdc/mem/vers?plid=%s";
	public static $mem_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/mem/vers?plid=%s&pn=%s";
	public static $mem_fetch_scenarios = "http://123.125.70.35:8099/sdc/mem/ts?plid=%s&pn=%s&v=%s";
	public static $mem_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/mem?plid=%s&eva=%s";
	public static $mem_fetch_details_by_pn_version_tsid = "http://123.125.70.35:8099/sdc/mem?plid=%s&pn=%s&v=%s&tsid=%s";
	public static $mem_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/mem/website?plid=%s&pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $trf_fetch_pns = "http://123.125.70.35:8099/sdc/trf/pns?plid=%s";
	public static $trf_fetch_versions = "http://123.125.70.35:8099/sdc/trf/vers?plid=%s";
	public static $trf_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/trf/vers?plid=%s&pn=%s";
	public static $trf_fetch_scenarios = "http://123.125.70.35:8099/sdc/trf/ts?plid=%s&pn=%s&v=%s";
	public static $trf_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/trf?plid=%s&eva=%s";
	public static $trf_fetch_details_by_pn_version_tsid = "http://123.125.70.35:8099/sdc/trf?plid=%s&pn=%s&v=%s&tsid=%s";
	public static $trf_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/trf/website?plid=%s&pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $pow_fetch_pns = "http://123.125.70.35:8099/sdc/trf/pns?plid=%s";
	public static $pow_fetch_versions = "http://123.125.70.35:8099/sdc/pow/vers?plid=%s";
	public static $pow_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/pow/vers?plid=%s&pn=%s";
	public static $pow_fetch_scenarios = "http://123.125.70.35:8099/sdc/pow/ts?plid=%s&pn=%s&v=%s";
	public static $pow_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/pow?plid=%s&eva=%s";
	public static $pow_fetch_details_by_pn_version_tsid = "http://123.125.70.35:8099/sdc/pow?plid=%s&pn=%s&v=%s&tsid=%s";
	public static $pow_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/pow/website?plid=%s&pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $fps_fetch_versions = "http://123.125.70.35:8099/sdc/fps/vers";
	public static $fps_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/fps/vers?pn=%s";
	public static $fps_fetch_scenarios = "http://123.125.70.35:8099/sdc/fps/ts?pn=%s&v=%s";
	public static $fps_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/fps?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $fps_fetch_details_by_pn_version_tsid = "http://123.125.70.35:8099/sdc/fps?pn=%s&v=%s&tsid=%s";
	public static $fps_fetch_website_details_by_pn_version_website_tsid = "http://123.125.70.35:8099/sdc/fps/website?pn=%s&v=%s&website=%s&tsid=%s";
	
	public static $ben_fetch_pns = "http://123.125.70.35:8099/sdc/benchmark/pns?plid=%s";
	public static $ben_fetch_versions = "http://123.125.70.35:8099/sdc/benchmark/vers";
	public static $ben_fetch_versions_by_pn = "http://123.125.70.35:8099/sdc/benchmark/vers?plid=%s&pn=%s";
	public static $ben_fetch_details_by_pn_version = "http://123.125.70.35:8099/sdc/benchmark?plid=%s&pn=%s&v=%s";
	
	public static $menu_fetch_all = "http://123.125.70.35:8099/sdc/menu?plid=%s";
	
	public static $product_fetch_name = "http://123.125.70.35:8099/sdc/product/pn?plid=%s";
}

?>
