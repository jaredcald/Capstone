<?php


	if(!empty($_POST["name"])){


		foreach ($_POST["name"] as $key => $value) {
			echo $value;
		}
		echo json_encode(['success'=>'Names Inserted successfully.']);
	}


?>