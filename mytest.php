<!DOCTYPE html>
<html lang="en">
<head>
  <title>Creation Center</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="stylesheets/proposalviews.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  

  <script>
  	$(document).ready(function(e)
  	{
  		//Variables

  		var html = '<div><table><tr><td><input type="text" id="childdesc" name="description"></td><td><input type="number" id="childprice" step="0.00" name="price"></td><td><a href="#" id="remove" style="color:red;">X</a></td></tr></table></div>';

  		var maxrow = 5;
  		var x = 1;

  		//Add Rows to Form
  		$("#add").click(function(e)
  		{
  			if(x <= maxrow)
  			{
  				$("#leForm").append(html);
  				x++;
  			}
  		});



  		//Remove rows to form

  		$("#leForm").on('click','#remove',function(e)
  		{
  			$(this).parent('div').remove();
  			x--;
  		});

  		//Populate

  	});


  </script>
</head>



<body>
<div class="container">
<div style="width:75%;padding:20px;">
<div id="leForm">
	<form method="post">
		<table>
			<tr>
				<th>Description</th>
				<th>Price</th>
				<th></th>
			</tr>
			<tr>
				<td><input type="text" id="desc" name="description"></td>
				<td><input type="number" id="price" step="0.00" name="price"></td>
				<td><button class="btn btn-primary"><a href="#" id="add">Add</a></button></td>
			</tr>

		</table>
		</div>
		<br><br>
		<input type="submit" name="submit" value="Submit">
	</form>

</div>
</div>


</body>
</html>