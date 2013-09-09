<?php

class Constants {
	
	public static $ldt_fetch_versions = "http://123.125.70.35:8099/sdc/page/vers";
	public static $ldt_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/page/vers?browser=%s";
	public static $ldt_fetch_scenarios = "http://123.125.70.35:8099/sdc/page/ts?browser=%s&engineVersion=%s";
	public static $ldt_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/page?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $ldt_fetch_avg_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/page/avg?browser=%s&engineVersion=%s&ts=%s";
	public static $ldt_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/page/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	public static $cpu_fetch_versions = "http://123.125.70.35:8099/sdc/cpu/vers";
	public static $cpu_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/cpu/vers?browser=%s";
	public static $cpu_fetch_scenarios = "http://123.125.70.35:8099/sdc/cpu/ts?browser=%s&engineVersion=%s";
	public static $cpu_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/cpu?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $cpu_fetch_details_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/cpu?browser=%s&engineVersion=%s&tsid=%s";
	public static $cpu_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/cpu/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	public static $mem_fetch_versions = "http://123.125.70.35:8099/sdc/memory/vers";
	public static $mem_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/memory/vers?browser=%s";
	public static $mem_fetch_scenarios = "http://123.125.70.35:8099/sdc/memory/ts?browser=%s&engineVersion=%s";
	public static $mem_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/memory?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $mem_fetch_details_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/memory?browser=%s&engineVersion=%s&tsid=%s";
	public static $mem_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/memory/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	public static $trf_fetch_versions = "http://123.125.70.35:8099/sdc/traffic/vers";
	public static $trf_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/traffic/vers?browser=%s";
	public static $trf_fetch_scenarios = "http://123.125.70.35:8099/sdc/traffic/ts?browser=%s&engineVersion=%s";
	public static $trf_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/traffic?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $trf_fetch_details_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/traffic?browser=%s&engineVersion=%s&tsid=%s";
	public static $trf_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/traffic/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	public static $pow_fetch_versions = "http://123.125.70.35:8099/sdc/power/vers";
	public static $pow_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/power/vers?browser=%s";
	public static $pow_fetch_scenarios = "http://123.125.70.35:8099/sdc/power/ts?browser=%s&engineVersion=%s";
	public static $pow_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/power?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $pow_fetch_details_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/power?browser=%s&engineVersion=%s&tsid=%s";
	public static $pow_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/power/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	public static $fps_fetch_versions = "http://123.125.70.35:8099/sdc/fps/vers";
	public static $fps_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/fps/vers?browser=%s";
	public static $fps_fetch_scenarios = "http://123.125.70.35:8099/sdc/fps/ts?browser=%s&engineVersion=%s";
	public static $fps_fetch_eva_scenarios = "http://123.125.70.35:8099/sdc/fps?eva=[v_baidu:%s,v_uc:%s,v_qq:%s]";
	public static $fps_fetch_details_by_browser_version_tsid = "http://123.125.70.35:8099/sdc/fps?browser=%s&engineVersion=%s&tsid=%s";
	public static $fps_fetch_website_details_by_browser_version_website_tsid = "http://123.125.70.35:8099/sdc/fps/website?browser=%s&engineVersion=%s&website=%s&tsid=%s";
	
	
	public static $ben_fetch_versions = "http://123.125.70.35:8099/sdc/benchmark/vers";
	public static $ben_fetch_versions_by_browser = "http://123.125.70.35:8099/sdc/benchmark/vers?browser=%s";
	public static $ben_fetch_details_by_browser_version = "http://123.125.70.35:8099/sdc/benchmark?browser=%s&engineVersion=%s";
}

?>
