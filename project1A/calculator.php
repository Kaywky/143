<!DOCTYPE html>
<html>
<body>

<?php
echo 'Calculator<br><br>';
echo '(Version 1.1 10/2/2016 by Kaiyi)<br>';
echo 'Type an expression in the following box (e.g., 10.5+20*3/25).<br><br>';
?>

<form action="calculator.php" method="post">
Please enter: <input type="text" name="expression"><br>
<input type="submit" value="Calculate">
</form>

<?php
echo '<br> 1. Only numbers and +, -, * and / operators are allowed in the expression.<br>';
echo '2. The evaluation follows the standard operator precedence.<br>';
echo '3. The calculator does not support parentheses.<br>';
echo '4. The calculator handles invalid input "gracefully". It does not output PHP error messages.<br>';
echo '<br>Here are some(but not limit to) reasonable test case:<br>';
echo '<br> 1. A basic arithmetic operation: 3+4*5=23<br>';
echo '2. An expression with floating point or negative sign: -3.2+2*4-1/3=4.46666666667, 3*-2.1*2=-12.6<br>';
echo '3. Some types inside operation (e.g. alphabetic letter): Invalid input expression 2d4+1<br>';

?>


<?php


function separate($expre) {
	$split_array = str_split($expre);
	$arraylength = count($split_array);
	$spacetest=true;
	if(($split_array[0]=="+"
		||$split_array[0]=="-")
		&&($split_array[1]=="+"
			||$split_array[1]=="-")
		||($split_array[0]=="/"
			||$split_array[0]=="*"
			||$split_array[0]=="+")){
		$spacetest=false;
	}

	for($x=0; $x<$arraylength; $x++){
		if(($split_array[$x]=="+"
			||$split_array[$x]=="-"
			||$split_array[$x]=="/"
			||$split_array[$x]=="*")
			&&($split_array[$x+1]=="+"
				||$split_array[$x+1]=="/"
				||$split_array[$x+1]=="*")){
			$spacetest=false;
		break;
	}
}
	$y=0;
	$x=1;

    $str_array[0]=$split_array[0];
    while($x < $arraylength) {
    	if(($split_array[$x]!="+")
    		&& ($split_array[$x]!="-")
    		&& ($split_array[$x]!="*")
    		&& ($split_array[$x]!="/")){
    		$str_array[$y]=$str_array[$y].$split_array[$x];
    	    $x++;
    } elseif(($split_array[$x+1]!="+")
    	&& ($split_array[$x+1]!="-")
    	&& ($split_array[$x+1]!="*")
    	&& ($split_array[$x+1]!="/")) {
    	$y++;
    	$str_array[$y]=$split_array[$x];
    	$y++;
    	$x=$x+1;
    } else {
    	$y++;
    	$str_array[$y]=$split_array[$x];
    	$y++;
    	$str_array[$y]=$split_array[$x+1];
    	$x=$x+2;
    }
    }


    $strlength = count($str_array);
    $strrealtest=true;
    $strtest=true;

    if($spacetest==false){
    	echo '<br>Opps! Invalid Expression<br>';
    } else{
	for($x=0; $x<$strlength; $x++){
		$strtest=is_numeric($str_array[$x]);
		if($strtest==false
			&& $str_array[$x]!="+"
			&& $str_array[$x]!="-"
			&& $str_array[$x]!="*"
			&& $str_array[$x]!="/"){
			echo '<br>Opps! Invalid Expression<br>';
		$strrealtest=false;
		break;
		} 

	}

	$zerotest=true;
	for($x=0; $x<$strlength; $x++){
		if($str_array[$x]=="/"
			&& $str_array[$x+1]==0){
			echo '<br>Opps! Division by zero error!';
		return $zerotest=false;
		break;
		}
	}

	while($strrealtest==true && $zerotest==true && $spacetest==true && $strlength==1){
    	echo "<br>Result<br>";
		echo $_POST["expression"] . "=" . $str_array[0];
		break;
    }

	while($strrealtest==true && $zerotest==true && $spacetest==true && $strlength>1){
		for($x=0; $x<$strlength; $x++){
			if($str_array[$x]=="*"){
			$newstr=$str_array[$x-1]*$str_array[$x+1];
			array_splice($str_array, $x-1, 3, $newstr);
			$strlength=count($str_array);
			$x--;
		}
		    if($str_array[$x]=="/"){
			$newstr=$str_array[$x-1]/$str_array[$x+1];
			array_splice($str_array, $x-1, 3, $newstr);
			$strlength=count($str_array);
			$x--;
		}
		}
		for($x=0; $x<$strlength; $x++){
			if($str_array[$x]=="+"){
				$newstr=$str_array[$x-1]+$str_array[$x+1];
				array_splice($str_array, $x-1, 3, $newstr);
				$strlength=count($str_array);
				$x--;
			}
			if($str_array[$x]=="-"){
				$newstr=$str_array[$x-1]-$str_array[$x+1];
				array_splice($str_array, $x-1, 3, $newstr);
				$strlength=count($str_array);
				$x--;
			}
		}
		

        echo "<br>Result<br>";
        echo $_POST["expression"] . "=" . $str_array[0];
	}
}


	}

?>

<?php
separate($_POST["expression"]);


?>

</body>
</html>