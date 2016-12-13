<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sup</title>
</head>

<body>
  <?php
    // Depeding on server, use one or the other
    //$ini_array = parse_ini_file("data-local.ini.php");
    $ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
    
	if (array_key_exists('submit', $_REQUEST))
	{
	  $submitButton = $_REQUEST['submit'];
	  $name = $_REQUEST['name'];
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
	    $smt = $pdo->prepare("SELECT * FROM LDWP_TV_Shows WHERE name LIKE :Name");
		$smt->bindValue(':Name', '%'.$name.'%');
		if ($smt->execute())
		{
		  $rows = $smt->fetchAll();
		  if (count($rows)==0){
			echo 'No show matches that search.';
		  }
		  else{
			foreach($rows as $row)
			{
			  echo "ID: ".$row['id'].'<br>';
			  echo 'Name:'.$row['name'].'<br>';
			}
		  }
		}
	  }
	}
	else{
	  ?>
      <h1>Please search for the name of a TV show.</h1>
      <p>(To see a list of all the shows, search on a blank string.)</p>
	  <form>
		<input type="text" name="name">
		<input type="submit" name="submit" value="submit">
      </form>
	  <?php } ?>
</body>
</html>
