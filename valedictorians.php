<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Valedictorians</title>

<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css"
 href="css/cardinalAward.css">

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
	  $smt = $pdo->prepare("SELECT * FROM valedictorians ORDER BY Class");
	  if ($smt->execute())
	  {
		$rows = $smt->fetchAll();
		if (count($rows)==0){
		  echo '<div>No show matches that search.</div>';
		}
		else{
		  foreach($rows as $row)
		  {
			//echo "ID: ".$row['id'].'<br>';
			echo '<h1 class="name">'.$row['Name'].'</h1><br>';
			echo '<h1 class="class">'.
$row['Class'].'</h1><br><br>';
			
		  }
		}
	  }
	}?>
</body>
</html>
