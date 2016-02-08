<?php

//debugging definitions
//define("ForceTodayIsMonday",1);
//define("ForceTodayIsHoliday",1);

//standard definitions
define("DayOfWeekMonday", 1);

//class W3OINetMonday Author: John Borchers W3AMD
//copyright 2016 W3OI all rights reserved
class W3OINetMonday
{
   function CheckHoliday()
   {
      //if the debug force define is set it's a holiday
      //(used for testing)
      if(defined("ForceTodayIsHoliday"))
      {
         return TRUE;
      }
      //if we are here it is already a monday for a net

      //get the week number of the year
      //ISO-8601 weeks start on Monday should be no difference for W3OI
      //Monday night net
      $MonthOfTheYear = date('n');
      //get the day
      $DayOfTheMonth = date('j');
      //start checking for holiday conditions
      //is it a new years Monday or was New Year's Sunday
      //in which case Monday will be the holiday
      if($MonthOfTheYear == 1)
      {
         //test for first or second day of the year
         if(($DayOfTheMonth == 1) || ($DayOfTheMonth == 2))
         {
            //it's new years today or was yesterday and is a holiday
            return TRUE;
         }
         //is it the third Monday in Jan (Martin Luther King, Jr Day)
         //test for the third monday of the month
         if(($DayOfTheMonth >= 15) && ($DayOfTheMonth <= 21))
         {
            //it's Martin luther King Jr Day and a holiday
            return TRUE;
         }
      }
      //is it the third Monday in Feb (Washington's Birthday)
      if($MonthOfTheYear == 2)
      {
         //test for the third monday of the month
         if(($DayOfTheMonth >= 15) && ($DayOfTheMonth <= 21))
         {
            //it's Washington's Birthday and a holiday
            return TRUE;
         }
      }
      //is it the last Monday in May (Memorial Day)
      if($MonthOfTheYear == 5)
      {
         //test for the last monday of the month
         if(($DayOfTheMonth >= 25) && ($DayOfTheMonth <= 31))
         {
            //it's Memorial and a holiday
            return TRUE;
         }
      }
      //is it July 4th? (Independence Day) or was it on Sunday
      //in which case Monday will be the holiday
      if($MonthOfTheYear == 7)
      {
         //test for the the 4th or the 5th
         if(($DayOfTheMonth == 4) || ($DayOfTheMonth == 5))
         {
            //it's July 4th or the day after and a Holiday
            return TRUE;
         }
      }
      //is it the first Monday in September (Labor Day)
      if($MonthOfTheYear == 9)
      {
         //test for the first monday of the month
         if(($DayOfTheMonth >= 1) && ($DayOfTheMonth <= 7))
         {
            //it's Labor day and a holiday
            return TRUE;
         }
      }
      //is it the second Monday in October (Columbus Day)
      if($MonthOfTheYear == 10)
      {
         //test for the second monday of the month
         if(($DayOfTheMonth >= 8) && ($DayOfTheMonth <= 14))
         {
            //it's Columbus day and a holiday
            return TRUE;
         }
      }
      //is it Dec 25th? (Christmas) or was it yesterday
      //in which case Monday will be the holiday
      if($MonthOfTheYear == 10)
      {
         //test for the the 25th or the 26th
         if(($DayOfTheMonth == 25) || ($DayOfTheMonth == 26))
         {
            return TRUE;
         }
      }
      //it's not a holiday today
      return FALSE;
   }
   function CheckMonday()
   {
      //if the debug force define is set it's monday no matter what the day
      //(used for testing)
      if(defined("ForceTodayIsMonday"))
      {
         return TRUE;
      }
      // set the default timezone to use no matter where the server is
      date_default_timezone_set('EST');
      //get the day of the week
      $DayOfTheWeek = date('N');
      //is it Monday?
      if($DayOfTheWeek == DayOfWeekMonday)
      {
         //yes, it's monday we need to check if today is a holiday to see if
         //there is a net tonight
         return TRUE;
      }
      else
      {
         //no it's not monday just display the standard message about
         //nets on monday night
         return FALSE;
      }
   }

}
//check for net tonight
//function to check if it's a monday night net and if there is a holiday
//if it is a monday in which case the net is cancelled
$MondayNet = new W3OINetMonday();
$TodayIsMonday = $MondayNet->CheckMonday();
if($TodayIsMonday == FALSE)
{
   //if today isn't monday display the standard Monday night nets message
   //or graphic or other option
   ECHO '<h3>W3OI Monday Night Net At 7:30 PM EST On 146.94<h3>';
}
else
{
   //if today is monday we need to check if it's a holiday to know
   //if there is a Net tonight
   $TodayIsHoliday = FALSE;//$MondayNet->CheckHoliday();
   if($TodayIsHoliday)
   {
      //today is holiday no net tonight
      ECHO '<h3>There Is No Net Tonight At 7:30 PM Due To The Holiday<h3>';
   }
   else
   {
      //it's monday there is a net tonight message
      ECHO '<h3>W3OI Monday Night Net Tonight At 7:30 PM EST On 146.94<h3><hr />';
   }
}
?>