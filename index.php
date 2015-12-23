<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Gamertag</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
  
  <script>
	function myFunction() {
    var str = document.getElementById("enc").innerHTML; 
    var res = str.replace("+", "%20");
    document.getElementById("enc").innerHTML = res;
}
</script>

</head>
<body>

<div class='container'>

	<h1>Xbox Live Profile</h1>

	<div class="well col-md-4">
		<p>Enter your xbox gamertag</p>
		<p>Add  %20  if you have a space in your gamertag (between spaces)</p>
		<form action="" method="post">
			<p>Gamertag: <input type="text" class='form-control' name="gamertag" value="""></p>
			<p><input type="submit" name="submit" value="Go" class="btn btn-success" id="enc"></p>
		</form>
	</div>

	<?php if(isset($_POST['submit'])){ ?>
	<div class='well col-md-offset-1 col-md-6'>
	<?php
		$gamertag = $_POST['gamertag']; //post request here
		
		
		$json_string =    file_get_contents("https://www.xboxleaders.com/api/profile.json?gamertag=$gamertag");
		$parsed_json = json_decode($json_string, true);
		
		//var_dump($json_string);
		
			
			echo '<img src="' . $parsed_json['avatar'] .'"/><br><br>';
			echo 'GT - ' . $parsed_json['gamertag'] . '<br><br>'; //Gamertag
			echo 'GS - ' . $parsed_json['gamerscore'] . '<br><br>'; //gamerscore
			echo 'Status - ' . $parsed_json['status'] . '<br><br>'; //status
			echo 'Bio - ' . $parsed_json['bio'] . '<br><br>'; //Bio
			echo 'location - ' . $parsed_json['location'] . '<br><br>'; //location
			echo "</p>";
			
			$parsed_json = $parsed_json['recentgames'];


			foreach($parsed_json as $key => $value)
			{
				echo '<img src="' . $value['image'] .'"/><br><br>';
				echo 'Title - ' . $value['title'] . '<br>';
				echo 'Last Played - ' . $value['last_played'] . '<br>';
				echo 'Earned GS - ' . $value['earned_gamerscore'] . '<br>';
				echo 'Total GS - ' . $value['total_gamerscore'] . '<br>';
				echo 'Earned ACH - ' . $value['earned_achievements'] . '<br>';
				echo 'Total ACH - ' . $value['total_achievements'] . '<br>';
				echo '% Complete - ' . $value['percent_complete'] . '<br><br>';
			   // etc
			}
		
	?>
	<img src="<?php echo $parsed_json['avatar']; ?>">
	</div>
	<?php }else{
		echo "";
	} ?>
 
</div>
</body>
</html>		