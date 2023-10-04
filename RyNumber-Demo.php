<?php
include "RyNumber.php";
$RN = new RyNumber();

/*******************************************************************/
$N = 1234567890;
echo "$N in Farsi is:<br>";
echo $RN->N2L_FA($N) . "<br>";
echo "<br>";
echo "$N in English is:<br>";
echo $RN->N2L_EN($N) . "<br>";

?>