<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DatePeriod;
use DateInterval;

class ScheduleController extends Controller
{
	public function viewSchedule()
	{
		$slug = 'schedule';

		return view('schedule.browse', compact(
			'slug'
		));
	}

	// Function to get all the times in given range
	public static function getTimesFromRange($start, $end, $format = 'H:i:s')
	{

		// Declare an empty array
		$array = array();

		// Variable that store the time interval
		// of period 30 minutes
		$interval = new DateInterval('PT30M');

		$realEnd = new DateTime($end);
		$realEnd->add($interval);

		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

		// Use loop to store time into array
		foreach($period as $time) {
			$array[] = $time->format($format);
		}

		// Return the array elements
		return $array; 
	}
}
