#!/usr/bin/php
<?php
$NumberFileName = "/home/gschool/1500SATishBiModal.nbrs";
$StartTime = microtime(true);
$NumberFile = fopen ($NumberFileName, 'r');
$index = 0;
$Total = 0;
$invalid = 0;
while (!feof($NumberFile)) {
        $ANumber = fgets($NumberFile);
	$ANumber = trim($ANumber);
	if (is_numeric($ANumber)) {
	    $Total= $Total + $ANumber;
            $Array[$index] = $ANumber;
            $index++;
	}

	else {
		$invalid++;
	}
}
fclose($NumberFile);
$SortedArray = $Array;

 for($i = 0; $i < $index; $i++) {
        for($j = 0; $j < $index; $j++) {
            if ($SortedArray[$i] < $SortedArray[$j]) {
                $tem = $SortedArray[$i];
                $SortedArray[$i] = $SortedArray[$j];
                $SortedArray[$j] = $tem;
            }
       }
}

//echo "Key: ";
//print_r($SortedArray, false);

$Min = $SortedArray[0];
$Max = $SortedArray[$index-1];
$Median = 0;
if ($index % 2 == 0) {
   $i1 = ($index-1)/2;
   $m1 = $SortedArray[$i1];
   $m2 = $SortedArray[$i1+1];
  $Median = ($m1 + $m2)/2;
}

else {
$Median = $SortedArray[($index-1)/2];
}



$bSample = false;
 $fMean = array_sum($SortedArray) / $index;
    $fVariance = 0.0;
    foreach ($SortedArray  as $k)
    {
      //  $fVariance += pow($i - $fMean, 2);
	  $fVariance += ($k-$fMean)*($k-$fMean);
    }
    $fVariance /= ( $bSample ? count($SortedArray) - 1 : $index );
    $StdDev =  sqrt($fVariance);


$Qtile = 10;
$Range = $Max - $Min;
$interval = $Range/$Qtile;

$d = 0;
$n = 0;


for ($i=0; $i< $Qtile; $i++) {
   $qmin = $Min+ ($i*$interval);
   $qmax = $qmin + $interval;
   $desc[$i] = 0;
   for ($d = 0; $d < $index; $d++) {
       if ($SortedArray[$d] >=  $qmin && $SortedArray[$d] < $qmax) {     
           $n++;
          $desc[$i] =0 +  $n;
      }
     
  
   }
   $n = 0;
   $d = 0;

}

echo "\nMin: $Min\n";
echo "\nMax: $Max\n";
echo "\nAvg: $fMean\n";
echo "\nMed: $Median\n";
echo "\nStandard dev: $StdDev\n";
echo "\n$invalid invalid items.\n";
for ($z = 0; $z < $Qtile; $z++) {
  $hmin = $Min+ $z*$interval;
  $hmax = $hmin + $interval;
 echo "\n$hmin - $hmax: $desc[$z]";
}
echo "\nHistogram: \n";

for ($z = 0; $z < $Qtile; $z++) {
 echo "\n   |";
  $freq = ($desc[$z] / $index) * 300;
  for ($l = 0; $l < $freq ; $l++) {
   echo"O";
   }
}

$maxs = array_keys($desc, max($desc));
$hmin = $Min+ $maxs[0]*$interval;
  $hmax = $hmin + $interval;
$realmode = ($hmin + $hmax) /2;
echo "\nMode: $realmode\n";
$EndTime = microtime(true);
$dur = $EndTime - $StartTime;
echo "\nTime: $dur";


?>
