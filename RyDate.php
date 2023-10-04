<?php
/*******************************************************************/
/*  Author : Yousef Rahimy Akhondzadeh
/*  Copyright : 2022
/*  Email : wkpviana@gmail.com
/*******************************************************************/
class RyDate
{
    /*** Protected Functions ***/
    protected function left($str, $length): string
    {
        return substr($str, 0, $length);
    }
    protected function right($str, $length): string
    {
        return substr($str, -$length);
    }
    protected function CheckLeap(int $iValue, bool $Leap): int
    {
        if ($iValue == 1 and $Leap)
            return 1;
        else
            return 0;
    }

    /*** Public Functions ***/
    public function IsGregorianLeapYear(int $GregorianYear): bool
    {
        if (($GregorianYear % 4 == 0) and (($GregorianYear % 100 != 0) or ($GregorianYear % 400 == 0)))
            return true;
        else
            return false;
    }
    public function IsJalaliLeapYear($JalaliYear): bool
    {
        $LeapSet = array(1, 5, 9, 13, 17, 22, 26, 30);
        if (in_array(($JalaliYear % 33), $LeapSet))
            return true;
        else
            return false;
    }

    public function Gregorian2Jalali(int $GregorianYear, int $GregorianMonth, int $GregorianDay): string
    {
        $I = 1;
        $DayOfYear = 0;
        $M = 0;
        $GMonthDays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $Result = "";

        /* Special Years */
        if (($GregorianYear % 400) == 384)
            $M = 1;
        else
            $M = 0;

        $GregorianDay = $GregorianDay - $M;
        if ($GregorianDay == 0) {
            $GregorianMonth = $GregorianMonth - 1;
            if ($GregorianMonth == 0) {
                $GregorianYear = $GregorianYear - 1;
                $GregorianMonth = 12;
            }
            $GregorianDay = $GMonthDays[$GregorianMonth];
        }

        /* Day of Year */
        while ($I < $GregorianMonth) {
            $DayOfYear += $GMonthDays[$I];
            $I++;
        }
        $DayOfYear += $GregorianDay;
        if ($this->IsGregorianLeapYear($GregorianYear) and ($GregorianMonth > 2))
            $DayOfYear++;

        /* Month and Day */
        if ($DayOfYear <= 79) {
            if (($GregorianYear - 1 % 4) == 0)
                $DayOfYear = $DayOfYear + 11;
            else {
                $DayOfYear = $DayOfYear + 10;
                $GregorianYear = $GregorianYear - 622;
            }
            if ($DayOfYear % 30 == 0) {
                $GregorianMonth = intdiv($DayOfYear, 30) + 9;
                $GregorianDay = 30;
            } else {
                $GregorianMonth = intdiv($DayOfYear, 30) + 10;
                $GregorianDay = $DayOfYear % 30;
            }
        } else {
            $GregorianYear = $GregorianYear - 621;
            $DayOfYear = $DayOfYear - 79;
            if ($DayOfYear <= 186) {
                if ($DayOfYear % 31 == 0) {
                    $GregorianMonth = intdiv($DayOfYear, 31);
                    $GregorianDay = 31;
                } else {
                    $GregorianMonth = intdiv($DayOfYear, 31) + 1;
                    $GregorianDay = $DayOfYear % 31;
                }
            } else {
                $DayOfYear = $DayOfYear - 186;
                if ($DayOfYear % 30 == 0) {
                    $GregorianMonth = intdiv($DayOfYear, 30) + 6;
                    $GregorianDay = 30;
                } else {
                    $GregorianMonth = intdiv($DayOfYear, 30) + 7;
                    $GregorianDay = $DayOfYear % 30;
                }
            }
        }
        $Result = strval($GregorianYear) . "/" . $this->right("00" . strval($GregorianMonth), 2) . "/" . $this->right("00" . strval($GregorianDay), 2);
        return $Result;
    }
    public function Jalali2Gregorian(int $JalaliYear, int $JalaliMonth, int $JalaliDay): DateTime
    {
        $GDayInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $JDayInMonth = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        $JYear = 0;
        $JMonth = 0;
        $JDay = 0;
        $GYear = 0;
        $GMonth = 0;
        $GDay = 0;
        $JDayNo = 0;
        $GDayNo = 0;
        $Leap = true;

        $JYear = $JalaliYear - 979;
        $JMonth = $JalaliMonth - 1;
        $JDay = $JalaliDay - 1;
        $JDayNo = 365 * $JYear + intdiv($JYear, 33) * 8 + intdiv((($JYear % 33) + 3), 4);
        $I = 1;
        while ($I <= $JMonth) {
            $JDayNo += $JDayInMonth[$I];
            $I++;
        }

        $JDayNo = $JDayNo + $JDay;
        $GDayNo = $JDayNo + 79;
        $GYear = 1600 + 400 * intdiv($GDayNo, 146097);
        $GDayNo = $GDayNo % 146097;

        $Leap = true;
        if ($GDayNo >= 36525) {
            $GDayNo--;
            $GYear = $GYear + 100 * intdiv($GDayNo, 36524);
            $GDayNo = $GDayNo % 36524;
            if ($GDayNo >= 365)
                $GDayNo++;
            else
                $Leap = false;
        }

        $GYear = $GYear + 4 * intdiv($GDayNo, 1461);
        $GDayNo = $GDayNo % 1461;
        if ($GDayNo >= 366) {
            $Leap = false;
            $GDayNo--;
            $GYear = $GYear + intdiv($GDayNo, 365);
            $GDayNo = $GDayNo % 365;
        }

        $I = 0;
        while ($GDayNo >= ($GDayInMonth[$I + 1] + $this->CheckLeap($I, $Leap))) {
            $GDayNo = $GDayNo - ($GDayInMonth[$I + 1] + $this->CheckLeap($I, $Leap));
            $I++;
        }
        $GMonth = $I + 1;
        $GDay = $GDayNo + 1;
        return date_create_from_format("Y/m/d", strval($GYear) . "/" . strval($GMonth) . "/" . strval($GDay));
    }
    public function JalaliDaysInYear(int $JalaliYear, int $JalaliMonth, int $JalaliDay): int
    {
        if ($JalaliMonth <= 6)
            return ((($JalaliMonth - 1) * 31) + $JalaliDay);
        else
            return (186 + (($JalaliMonth - 6 - 1) * 30) + $JalaliDay);
    }
    public function JalaliDateDayName(int $JalaliYear, int $JalaliMonth, int $JalaliDay): string
    {
        switch (date_format($this->Jalali2Gregorian($JalaliYear, $JalaliMonth, $JalaliDay), "w")) {
            case 0:
                return "یکشنبه";
                break;
            case 1:
                return "دوشنبه";
                break;
            case 2:
                return "سه شنبه";
                break;
            case 3:
                return "چهارشنبه";
                break;
            case 4:
                return "پنجشنبه";
                break;
            case 5:
                return "جمعه";
                break;
            case 6:
                return "شنبه";
                break;
            default:
                return "";
        }
    }
    public function JalaliMonthName(int $JalaliMonth): string
    {
        switch ($JalaliMonth) {
            case 1:
                return "فروردین";
                break;
            case 2:
                return "اردیبهشت";
                break;
            case 3:
                return "خرداد";
                break;
            case 4:
                return "تیر";
                break;
            case 5:
                return "مرداد";
                break;
            case 6:
                return "شهریور";
                break;
            case 7:
                return "مهر";
                break;
            case 8:
                return "آبان";
                break;
            case 9:
                return "آذر";
                break;
            case 10:
                return "دی";
                break;
            case 11:
                return "بهمن";
                break;
            case 12:
                return "اسفند";
                break;
            default:
                return "";
        }
    }
    public function JalaliYearName(int $JalaliYear): string
    {
        switch ($JalaliYear % 12) {
            case 0:
                return "مار";
                break;
            case 1:
                return "اسب";
                break;
            case 2:
                return "گوسفند";
                break;
            case 3:
                return "میمون";
                break;
            case 4:
                return "مرغ";
                break;
            case 5:
                return "سگ";
                break;
            case 6:
                return "خوک";
                break;
            case 7:
                return "موش";
                break;
            case 8:
                return "گاو";
                break;
            case 9:
                return "پلنگ";
                break;
            case 10:
                return "خرگوش";
                break;
            case 11:
                return "نهنگ";
                break;
            default:
                return "";
        }
    }
    public function JalaliTodayShortDate(): string
    {
        return $this->Gregorian2Jalali(date("Y"), date("m"), date("d"));
    }
    public function JalaliTodayLongDate(): string
    {
        $sTemp = $this->Gregorian2Jalali(date("Y"), date("m"), date("d"));
        return $this->JalaliDateDayName(intval($this->left($sTemp, 4)), intval(substr($sTemp, 5, 2)), intval($this->right($sTemp, 2)))
            . " " . $this->right($sTemp, 2) . " " . $this->JalaliMonthName(intval(substr($sTemp, 5, 2))) . " " . $this->left($sTemp, 4);
    }
    public function JalaliFirstDayNameOfYear(int $JalaliYear): string
    {
        return $this->JalaliDateDayName($JalaliYear, 1, 1);
    }
    public function JalaliLastDayNameOfYear(int $JalaliYear): string
    {
        if ($this->IsJalaliLeapYear($JalaliYear))
            return $this->JalaliDateDayName($JalaliYear, 12, 30);
        else
            return $this->JalaliDateDayName($JalaliYear, 12, 29);
    }
}
?>