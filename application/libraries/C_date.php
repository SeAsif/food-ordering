<?
//  Name: c_date.php
//  Author: Jerry Mattsson // www.Timehole.com
//  No Rights is claimed for these basic functions
      
       /////////////////////////////////////////////////
      //  Functions for calculate date difference,   //
     //  add or subtract n days to/from a date      //
    //  and returns the resulting date.            //
   // Limitied to time() that starts 1970-1-1     //
  // Depends on strtotime for date input format  //
 // Use eg. floor to eliminate fractions of day //
/////////////////////////////////////////////////
class c_date {
	var $t1=0;
	var $t2=0;
	/**
	* @method constructor		
	*/
	function __construct()
	{
		$this->_obj =& get_instance();
	}
	
	function diffDate ($date1, $date2=NULL) {
	// Returns diff between two dates in days // By JM, www.Timehole.com
	// If date2 is not set, diff is calculated from "now"
	   $t1 = strtotime($date1);
	   if ($date2==NULL) { $t2 = $t1; $t1 = time(); }
	   else                $t2 = strtotime($date2);
	return ($t2-$t1)/86400; // difference of dates in days
	}

	function addDays ($days, $fmt="Y-m-d", $date=NULL) {
	// Adds days to date or from now  // By JM, www.Timehole.com
	   if ($date==NULL) { $t1 = time(); }
	   else               $t1 = strtotime($date);
	   $t2 = $days * 86400; // make days to seconds
	return date($fmt,($t2+$t1));
	}

	function subtractDays ($days, $fmt="Y-m-d", $date=NULL) {
	// Subtracts days from date or from now
	return $this->addDays(-($days),$fmt,$date);
	}
}
/*// Usage and samples:
$dt       = new c_date;
$new_date = $dt->addDays(10);                          // Add 10 days to today and get the new date
echo '10 days in the future from now is: '.$new_date.'<br>';
$new_date = $dt->subtractDays(10);                     // Subtract 10 days from today and get the new date
echo '10 days back in time from now is: '.$new_date.'<br>';
$diff     = $dt->diffDate('2007-05-23');               // How many days is it to this date from today
echo 'Days until 2007-05-23 is: '.round($diff).'<br>';

$new_date = $dt->addDays(10,'Y-m-d','2006-02-24');       // Add 10 days to a date and get the new date
echo '10 days in the future from 2006-02-24 is: '.$new_date.'<br>';
$new_date = $dt->subtractDays(10,'Y-m-d','2006-02-24');  // Subtract 10 days from a date and get the new date
echo '10 days back in time from 2006-02-24 is: '.$new_date.'<br>';
$diff     = $dt->diffDate('2007-02-23','2007-03-09');  // How many days is it between two dates
echo 'Days until 2007-02-09 from 2007-03-23 is: '.$diff.'<br>';
$diff     = $dt->diffDate('2006-03-23','2006-02-09');  // How many days is it between two dates (negative)
echo 'Days until 2006-03-09 from 2006-02-23 is:'.$diff.'<br>';
*/
?>