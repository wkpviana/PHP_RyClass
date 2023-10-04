<?php
include "RyTemperature.php";
$RT = new RyTemperature();

/*******************************************************************/
$C = 45; // Celsius Degree
$F = 113; // Fahrenheit Degree
$K = 318.15; // Kelvin Degree
$R = 240; // Rankine

echo sprintf("%.2f Celsius Degree is: %.2f Fahrenheit Degree<br>", $C, $RT->CelsiusToFahrenheit($C));
echo sprintf("%.2f Fahrenheit Degree is: %.2f Celsius Degree<br>", $F, $RT->FahrenheitToCelsius($F));
echo sprintf("%.2f Kelvin Degree is: %.2f Celsius Degree<br>", $K, $RT->KelvinToCelsius($K));
echo sprintf("%.2f Celsius Degree is: %.2f Kelvin Degree<br>", $C, $RT->CelsiusToKelvin($C));
echo sprintf("%.2f Fahrenheit Degree is: %.2f Kelvin Degree<br>", $F, $RT->FahrenheitToKelvin($F));
echo sprintf("%.2f Kelvin Degree is: %.2f Fahrenheit Degree<br>", $K, $RT->KelvinToFahrenheit($K));
echo sprintf("%.2f Kelvin Degree is: %.2f Rankine Degree<br>", $K, $RT->KelvinToRankine($K));
echo sprintf("%.2f Rankine Degree is: %.2f Kelvin Degree<br>", $R, $RT->RankineToKelvin($R));
echo sprintf("%.2f Celsius Degree is: %.2f Rankine Degree<br>", $C, $RT->CelsiusToRankine($C));
echo sprintf("%.2f Rankine Degree is: %.2f Celsius Degree<br>", $R, $RT->RankineToCelsius($R));
echo sprintf("%.2f Fahrenheit Degree is: %.2f Rankine Degree<br>", $F, $RT->FahrenheitToRankine($F));
echo sprintf("%.2f Rankine Degree is: %.2f Fahrenheit Degree<br>", $R, $RT->RankineToFahrenheit($R));

?>