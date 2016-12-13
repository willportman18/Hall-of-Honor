<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Stuff</title>
<link rel="stylesheet" href="css/hofInductees.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="icon" href="images/b.png">
</head>

<body>
  <?php
    $ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
	$data = [];
	if (array_key_exists('sportId', $_REQUEST))
	{
		$sport = $_REQUEST['sport'];
		$sportId = $_REQUEST['sportId'];

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
			$smt = $pdo->prepare("SELECT * FROM hofInducteesCopy WHERE sport_id = :Sport ORDER BY `Last Name`");
			$smt->bindParam(':Sport', $sportId);

			$smt->execute();
			$rows = $smt->fetchAll();

			foreach($rows as $row)
			{
				array_push($data, $row);
			}

			foreach($data as $row){
				echo '<h1>'.$row['Name'].'</h1><br>';
				echo '<p class="blue">'.$row['Sport'].'</p>';
				echo '<p class="blue">Class of: '.$row['Class of'].'</p>';
				echo '<p class="blue">Year Inducted: '.$row['Year Inducted'].'</p><br>';
			}
		}
	}?>
	
	</body>
</html>