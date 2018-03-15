<?php

	include "details.php";

	$tester = new Details("Hello", 350);
	echo "<hr>" . $tester->getDescription();

	//require('class.php');

?>



<?php
	function totalPrice($list) 
	{
		//var_dump(is_float(27.25));
		//$pass = var_dump(is_float($list));
		
		$total = 0.0;
		$pass = true;

		for($k = 0; $k < count($list); $k++)
    	{
    		if(!is_numeric($list[$k]))
    		{
    			$pass = false;
    		}
    	}
		
		if($pass)
		{
			
	    	for($k = 0; $k < count($list); $k++)
	    	{
	    		$total += $list[$k];
	    	}
    	}
    	else
    	{
    		echo "<br>List does not contain a dollar amount.";
    	}

    	return $total;
	}

?>


<?php

	$array1 = array(300,400,"Hello");
	$total1 = totalPrice($array1); 

	echo "<br>First test: $total1";

	$array2 = array(300,400,700);
	$total2 = totalPrice($array2); 

	echo "<br>Second test: $total2";

	echo "<h3>Doubly Linked List</h3>";
	$dlist = new SplDoublyLinkedList();
	$dlist->add(0, new Details("Painting", 700.00));
	$dlist->add(1, new Details("Drywall", 400.00));
	$dlist->add(2, new Details("Deck", 600.00));

	foreach ($dlist as $value) {
        echo sprintf("%s\n", $value->getDescription() . " - " . $value->getPrice() . "<br>");
    }
?>