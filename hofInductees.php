<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Hall of Fame Inductees</title>
<link rel="stylesheet" href="css/hofInductees.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="icon" href="images/b.png">
</head>

<body>
	<a href="home.html" class="back"><i class="fa fa-angle-left fa-2x" aria-hidden="true"></i></a>
  <?php
    $ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
?>
   	<div class="container">
   		<!-- JUST AN EXAMPLE WEB PAGE FOR TESTING -->
		<iframe src="hofIframe.php" name="this" style="border:1px solid #000;margin-left:450px; position:absolute;margin-top:60px;width:510px;height:95%;"></iframe>
		
		
		<!--<iframe src="hofIframe.php" name="this" style="border:1px solid #000;margin-left:450px; position:absolute;margin-top:60px;width:510px;height:95%;"></iframe>-->



		<h1>Please choose which sports you would like displayed</h1>

		<form>

		  <?php
			try{
			  $pdo = new PDO("mysql:dbname=$db_name; host=$host", $user_name, $password);
			  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e){
			  echo 'Connection failed: ' . $e->getMessage();
			  exit;
			}
			if ($pdo)
			{
			  $smt = $pdo->prepare("SELECT Sport, id FROM sports ORDER BY Sport");
			  if ($smt->execute())
			  {
				$rows = $smt->fetchAll();

				if (count($rows)==0){
				  echo 'No show matches that search.';
				}
				else{?>
			  	  <ul>
				  <?php
				  foreach($rows as $row)
				  {
					?>
					<!--<div class="center"><label><input type="checkbox" name="sport[]"
					value="'.$row['Sport'].'">'.$row['Sport'].'</label></div><br>-->

					<!--<div class="center">
						<button class="submit" name="sport[]" value="<?=$row['Sport']?>"><?=$row['Sport']?></button>
					</div>
					<br>-->
		<li><a href="hofIframe.php?sport=<?=$row['Sport']?>&sportId=<?=$row['id']?>" target="this"><?=$row['Sport']?></a></li>
					<?php
				  }?>
				  </ul>
				  <br>
				  <!--<div class="submit-center"><input class="submit" type="submit" name="submit" value="Submit"></div>-->
				  <?php

				}
			  }
			} ?>
		  </form>
	</div>
</body>
</html>
