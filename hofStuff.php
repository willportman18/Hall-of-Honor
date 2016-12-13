<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	$ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
	$data = [];
	
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
		  //$smt = $pdo->prepare("SELECT * FROM hofInductees WHERE Sport LIKE :Sport ORDER BY `Last Name`");
		  $smt = $pdo->prepare("UPDATE hofInducteesCopy SET sport_id = 9 WHERE Sport LIKE 'Special'");
		  $smt->execute();
		  $smt2 = $pdo->prepare("UPDATE hofInducteesCopy SET sport_id = 10 WHERE Sport LIKE 'Tennis'");
		  $smt2->execute();
		  $smt3 = $pdo->prepare("UPDATE hofInducteesCopy SET sport_id = 11 WHERE Sport LIKE 'Track'");
		  $smt3->execute();
		  $smt4 = $pdo->prepare("UPDATE hofInducteesCopy SET sport_id = 12 WHERE Sport LIKE 'Wrestling'");
		  $smt4->execute();


		  echo 'Success';
		}
	?>
</body>
</html>