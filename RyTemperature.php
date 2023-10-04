<?php
/*******************************************************************/
/*  Author : Yousef Rahimy Akhondzadeh
/*  Copyright : 2022
/*  Email : wkpviana@gmail.com
/*******************************************************************/
class RyTemperature
{
    public function CelsiusToFahrenheit(float $Celsius): float
    {
        return (($Celsius * (9 / 5)) + 32);
    }
    public function FahrenheitToCelsius(float $Fahrenheit): float
    {
        return (($Fahrenheit - 32) * (5 / 9));
    }
    public function KelvinToCelsius(float $Kelvin): float
    {
        return ($Kelvin - 273.15);
    }
    public function CelsiusToKelvin(float $Celsius): float
    {
        return ($Celsius + 273.15);
    }
    public function FahrenheitToKelvin(float $Fahrenheit): float
    {
        return (($Fahrenheit + 459.67) * (5 / 9));
    }
    public function KelvinToFahrenheit(float $Kelvin): float
    {
        return ($Kelvin * (9 / 5) - 459.67);
    }
    public function KelvinToRankine(float $Kelvin): float
    {
        return ($Kelvin * (9 / 5));
    }
    public function RankineToKelvin(float $Rankine): float
    {
        return ($Rankine * (5 / 9));
    }
    public function CelsiusToRankine(float $Celsius): float
    {
        return ($Celsius * (9 / 5) + 491.67);
    }
    public function RankineToCelsius(float $Rankine): float
    {
        return (($Rankine - 491.67) * (5 / 9));
    }
    public function FahrenheitToRankine(float $Fahrenheit): float
    {
        return ($Fahrenheit + 459.67);
    }
    public function RankineToFahrenheit(float $Rankine): float
    {
        return ($Rankine - 459.67);
    }
}
?>