<?php
include "RyDate.php";
$RD = new RyDate();

/*******************************************************************/
$GYear = 2020;
if ($RD->IsGregorianLeapYear($GYear))
    echo "$GYear is Leap.<br>";
else
    echo "$GYear is not Leap.<br>";

/*******************************************************************/
$JYear = 1362;
if ($RD->IsJalaliLeapYear($JYear))
    echo "$JYear is Leap.<br>";
else
    echo "$JYear is not Leap.<br>";

/*******************************************************************/
$GYear = 1984;
$GMonth = 3;
$GDay = 21;
echo "Jalali date of $GYear/$GMonth/$GDay is: " . $RD->Gregorian2Jalali($GYear, $GMonth, $GDay) . "<br>";

/*******************************************************************/
$JYear = 1363;
$JMonth = 1;
$JDay = 1;
echo "Gregorian date of " . strval($JYear) . "/" . strval($JMonth) . "/" . strval($JDay) . " is: " . date_format($RD->Jalali2Gregorian($JYear, $JMonth, $JDay), "Y/m/d") . "<br>";

/*******************************************************************/
$JYear = 1389;
$JMonth = 3;
$JDay = 19;
echo "Jalali elapsed day(s) from " . strval($JYear) . "/" . strval($JMonth) . "/" . strval($JDay) . " is: " . $RD->JalaliDaysInYear($JYear, $JMonth, $JDay) . "<br>";

/*******************************************************************/
$JYear = 1396;
$JMonth = 7;
$JDay = 10;
echo "Jalali day name of " . strval($JYear) . "/" . strval($JMonth) . "/" . strval($JDay) . " is: " . $RD->JalaliDateDayName($JYear, $JMonth, $JDay) . "<br>";

/*******************************************************************/
$JMonth = 7;
echo "Jalali month name of " . strval($JMonth) . " is: " . $RD->JalaliMonthName($JMonth) . "<br>";

/*******************************************************************/
$JYear = 1396;
echo "Jalali year name of " . strval($JYear) . " is: " . $RD->JalaliYearName($JYear) . "<br>";

/*******************************************************************/
echo "Jalali today is: " . $RD->JalaliTodayShortDate() . "<br>";
echo "Jalali today is: " . $RD->JalaliTodayLongDate() . "<br>";

/*******************************************************************/
$JYear = 1396;
echo "First Jalali day name of this year is: " . $RD->JalaliFirstDayNameOfYear($JYear) . "<br>";
echo "Last Jalali day name of this year is: " . $RD->JalaliLastDayNameOfYear($JYear) . "<br>";

?>