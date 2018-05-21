<?php
	
	class Details{
		private $description;
		private $price;

		public function __construct($description, $price)
		{
			$this->description = $description;
			$this->price = $price;
		}

		public function getDescription(){ return $this->description;}
		public function getPrice(){ return $this->price;}

		//public function __destruct()
		// {
		// 	echo "Details are destroyed after use.";
		// }

	}

	$data1 = new Details("Painting", 700.00);
	$data2 = new Details("Drywall", 400.00);
	$data3 = new Details("Deck", 600.00);

	echo "Test case 1: " . $data1->getDescription() . " - " . $data1->getPrice() . "<br>";
	echo "Test case 2: " . $data2->getDescription() . " - " . $data2->getPrice() . "<br>";
	echo "Test case 3: " . $data3->getDescription() . " - " . $data3->getPrice() . "<br><hr><br><br>";



	//Doubly Linked List
	
	echo "<h3>Doubly Linked List</h3>";
	$dlist = new SplDoublyLinkedList();
	$dlist->add(0, new Details("Painting", 700.00));
	$dlist->add(1, new Details("Drywall", 400.00));
	$dlist->add(2, new Details("Deck", 600.00));

	foreach ($dlist as $value) {
        echo sprintf("%s\n", $value->getDescription() . " - " . $value->getPrice() . "<br>");
    }


	//echo $tester->price;


?>