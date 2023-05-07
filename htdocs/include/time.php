<?php
require_once "Date/Calc.php";


function mins_to_time($mins)
{
   $followingdaystr="the following day";

   $hours=(int)($mins/60);
   $days=(int)($hours/24);		
   $ampm=($hours<12 ? "AM": "PM");
   $hours=$hours%12;
   if($hours==0)
      $hours=12;
   $mins=(int)($mins%60);
   if($mins<10)
      $mins="0" . $mins;
   return $hours . ":" . $mins . " " . $ampm .
      " " . ($days==1 ? $followingdaystr: "" );
}

function mins_to_duration($mins)
{
   $minssingularstr="minute";
   $minspluralstr="minutes";
   $hourssingularstr="hour";
   $hourspluralstr="hours";

   $hours=(int)($mins/60);
   $mins=(int)($mins%60);
   if($hours>1)
   $retstr=$hours . " " .
      ($hours>1 ? $hourspluralstr : $hourssingularstr);
   else 
      $retstr="";
   if($mins>1)
      $retstr = $retstr . " " . $mins . " " .
	 ($mins>1 ? $minspluralstr : $minssingularstr);
   return $retstr;
}

function get_datetime()
{
   return strftime("%Y%m%d%H%M%S",time());
}

function mysql_format_time($time)
{
   return strftime("%Y%m%d%H%M%S",$time);
}

function mysql_format_time2($time)
{
   return strftime("%Y-%m-%d %H:%M:%S",$time);
}

function mysql_cleantime($time)
{
   return mysql_format_time(strtotime($time));
}


function mysql_getdate($time)
{
   return strftime("%Y%m%d",strtotime($time)); 
}

function year_month_day($date,&$year,&$month,&$day)
{
   $year=substr($date,0,4);
   $month=substr($date,4,2);
   $day=substr($date,6,2);
}

function dashed_year_month_day($date,&$year,&$month,&$day)
{
   $year=substr($date,0,4);
   $month=substr($date,5,2);
   $day=substr($date,8,2);
}

function dash_remove_date($date)
{
   return substr($date,0,4) . substr($date,5,2) . substr($date,8,2);
}

function dash_date($date)
{
   return substr($date,0,4) . "-" . substr($date,4,2) . "-". substr($date,6,2); }

function time_to_days($time)
{
   $date=mysql_getdate($time);
   year_month_day($date,$year,$month,$day);
   return Date_Calc::dateToDays($day, $month, $year);
}

function now_to_days()
{
   return time_to_days(time());
}

function mktime_from_time($time)
{
   $year=substr($time,0,4);
   $month=substr($time,4,2);
   $day=substr($time,6,2);
   $hour=substr($time,8,2);
   $min=substr($time,10,2);
   $sec=substr($time,12,2);
   return mktime($hour,$min,$sec,$month,$day,$year);
}

function zero_pad_trip_date($year,$month,$day)
{
   return sprintf("%04d",$year) . sprintf("%02d",$month) . sprintf("%02d",$day);
}

function date_to_day($date)
{
   $day=substr($date,6,2);
   $month=substr($date,4,2);
   $year=substr($date,0,4);
      
   return (Date_Calc::dayOfWeek($day,$month,$year));
}

function days_since_start_2006($date)
{
   $day=substr($date,6,2);
   $month=substr($date,4,2);
   $year=substr($date,0,4);
   return Date_Calc::dateToDays($day,$month,$year)-Date_Calc::dateToDays(01,01,2006);
}

?>