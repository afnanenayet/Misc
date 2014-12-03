#!/usr/bin/php
<?php
$NumberFileName = 'numbers.txt';
$NumberFile = fopen($NumberFileName, 'r');
$NumberCounter = 0;
$RunningTotal = 0;
$Average = 0;
echo "Content of $NumberFileName:\n";
while (!feof($NumberFile)) {
	$ANumber = fgets($NumberFile);
	$NumberCounter += 1;
	$RunningTotal += $ANumber;
	print "'".trim($ANumber)."'";
}

fclose($NumberFile);
$Average = $RunningTotal / $NumberCounter;
echo "\nRunning total: $RunningTotal\n";
echo "\nNumber of numbers: $NumberCounter\n";
echo "\nAvg $Average\n";
?>
