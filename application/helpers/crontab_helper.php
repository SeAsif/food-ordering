<?  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This function returns the weeks of the current month
 *
 * @access	public
 * @return	integer
 */ 
 
if ( ! function_exists('weekofmonth') )
{
    function weekofmonth($month,$year){

        $lastDayOfWeek = '7'; //1 (for monday) to 7 (for sunday) 
        $aWeeksOfMonth = [];
        $date = new DateTime("{$year}-{$month}-01");
        $iDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $aOneWeek = [$date->format('Y-m-d')];
        $weekNumber = 1;
        for ($i = 1; $i <= $iDaysInMonth; $i++)
        {
            if ($lastDayOfWeek == $date->format('N') || $i == $iDaysInMonth)
            {
                $aOneWeek[]      = $date->format('Y-m-d');
                $aWeeksOfMonth[$weekNumber++] = $aOneWeek;
                $date->add(new DateInterval('P1D'));
                $aOneWeek = [$date->format('Y-m-d')];
                $i++;
    
            }
            $date->add(new DateInterval('P1D'));
        }
         
        foreach($aWeeksOfMonth  as $weekNumber => $week){
        echo "Week".$weekNumber.":". $week[0].'-'.$week[1]."<br>";
        }
    }
}
