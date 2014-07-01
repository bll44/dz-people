<?php


class Dates {

	public static function getYearsExperience($startDate)
	{

		$now = strtotime('now');
		$date_gap = $now - strtotime($startDate);
		$year = 60 * 60 * 24 * 365; // 1 year in seconds
		$yoe = $date_gap / $year;
		$rounded_yoe = round($yoe, 1, PHP_ROUND_HALF_DOWN);

		if($rounded_yoe > 1) $rounded_yoe = round($rounded_yoe, 0, PHP_ROUND_HALF_DOWN);

		$yoe = $rounded_yoe;

		if($yoe < .5)
			return 'Less than 6 months';
		else if($yoe < 1)
			return 'Less than a year';
		else if( (int) $yoe === 1)
			return $yoe . ' year';
		else
			return $yoe . ' years';
	}

}