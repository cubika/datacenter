<?php
Class Util {

	// compute Variances
	public static function getAverage($list, $type) {
		$sum = 0;
		for ($j = 0; $j < count($list); $j++) {
			if ($type == "ttsr") {
				$sum += $list[$j] -> timeToStartRender;
			} elseif ($type == "ttdr") {
				$sum += $list[$j] -> timeToDomReady;
			} elseif ($type == "ttpl") {
				$sum += $list[$j] -> timeToPageLoaded;
			}

		}
		$avg = $sum / count($list);

		return $avg;
	}

	public static function getVariance($list, $type) {
		$total_var = 0;
		$avg = Util::getAverage($list, $type);
		for ($j = 0; $j < count($list); $j++) {
			if ($type == "ttsr") {
				$total_var += pow(($list[$j] -> timeToStartRender - $avg), 2);
			} elseif ($type == "ttdr") {
				$total_var += pow(($list[$j] -> timeToDomReady - $avg), 2);
			} elseif ($type == "ttpl") {
				$total_var += pow(($list[$j] -> timeToPageLoaded - $avg), 2);
			}
		}

		return bcsqrt($total_var / count($list), 2);
	}

}
?>