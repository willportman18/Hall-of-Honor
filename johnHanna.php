<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>John Hanna Awards</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
<link rel="icon" href="images/b.png">
<link rel="stylesheet" type="text/css" href="css/cardinalAward.css">

</head>

<body>
  <?php
    $ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
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
	    $smt = $pdo->prepare("SELECT * FROM johnHannaAward ORDER BY `Class of`");
		if ($smt->execute())
		{
		  $rows = $smt->fetchAll();
		  if (count($rows)==0){
			echo 'No matches.';
		  }
		  else{
			foreach($rows as $row)
			{
			  echo '<h1 class="name">Name: '.$row['Name'].'</h1><br>';
			  echo '<h1 class="class">Class: '.$row['Class of'].'</h1><br><br>';
			}
		  }
		}
	  }
	  ?>
</body>
</html>
