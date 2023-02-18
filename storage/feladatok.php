<?php
	echo '<h3>3. feladat:</h3>';
// Fix Number
$number = 6;
//var_dump(numberIsPrime($number));

// Random numbers
$numbers = range(2,100,1);

foreach ($numbers as $number){
	echo 'Number ' . $number . ' is ' . numberIsPrime($number) . ' <br>';
}

function numberIsPrime($number){
	for($i = 2; $i < $number; $i++){
		if($number % $i == 0){
			return 'not prime';
		}
		return 'prime number';
	}
}


echo '<h3>4. feladat:</h3>';
$a = 10;
$b = 20;
$a=$a+$b;
$b=$a-$b;
$a=$a-$b;

echo '$a = ' . $a . '<br>';
echo '$b = ' . $b . '<br>';