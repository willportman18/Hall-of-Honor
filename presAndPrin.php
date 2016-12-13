
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>John Hanna Awards</title>
<link rel="icon" href="images/b.png">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
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
		echo '<h1 class="header">Presidents</h1>';
		
	    $smt1 = $pdo->prepare("SELECT * FROM presidents ORDER BY `id`");
		if ($smt1->execute())
		{
		  $rows = $smt1->fetchAll();
		  if (count($rows)==0){
			echo 'No matches.';
		  }
		  else{
			foreach($rows as $row)
			{
			  echo '<h1 class="name">Name: '.$row['Name'].'</h1><br>';
			  echo '<h1 class="class">Start: '.$row['Start'].'</h1><br>';
			  echo '<h1 class="class">Ended: '.$row['End'].'</h1><br><br>';
			}
		  }
		}
		
		echo '<h1>Principals</h1>';
		
		$smt2 = $pdo->prepare("SELECT * FROM principals ORDER BY Start");
		if ($smt2->execute())
		{
	      $rows = $smt2->fetchAll();
		  if (count($rows)==0){
			echo 'No matches.';
		  }
		  else{
			foreach($rows as $row)
			{
			  echo '<h1 class="name">Name: '.$row['Name'].'<br>';
			  echo '<h1 class="class">Start: '.$row['Start'].'<br>';
			  echo '<h1 class="class">End: '.$row['End'].'<br><br>';
			}
		  }
		}
	      
	  }
	  ?>
</body>
</html>
