<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Hall of Fame Inductees</title>
<link rel="stylesheet" href="css/hofInductees.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
<link rel="icon" href="images/b.png">
</head>

<body>
  <a href="home.html"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
  <?php
    $ini_array = parse_ini_file("data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
	$data = [];
	
	if (array_key_exists('submit', $_REQUEST))
	{
	  $submitButton = $_REQUEST['submit'];
	  if (array_key_exists('sport', $_REQUEST)){
		$sports = $_REQUEST['sport'];	  
		
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
		  $smt = $pdo->prepare("SELECT * FROM hohInductees WHERE Sport LIKE :Sport");
		  $smt->bindParam(':Sport', $sport);
		  
		  foreach($sports as $sport){
			$smt->execute();
			$rows = $smt->fetchAll();
			
			foreach($rows as $row)
			{
			  array_push($data, $row);
			}
		  }
			  
		  foreach($data as $row){
			echo '<h1 class="name">'.$row['Name'].'</h1>';
			echo $row['Sport'].'<br>';
			echo 'Class of: '.$row['Class of'].'<br>';
			echo 'Year Inducted: '.$row['Year Inducted'].'<br><br>';
		  }
		}
	  }
	  else{
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
		  $smt = $pdo->prepare("SELECT * FROM hohInductees");
		  if ($smt->execute())
		  {
			$rows = $smt->fetchAll();
			if (count($rows)==0){
			  echo 'No show matches that search.';
			}
			else{
			  foreach($rows as $row)
			  {
				//echo "ID: ".$row['id'].'<br>';
				echo $row['Name'].'<br>';
				echo $row['Sport'].'<br>';
				echo 'Class of: '.$row['Class of'].'<br>';
				echo 'Year Inducted: '.$row['Year Inducted'].'<br><br>';
				
			  }
			}
		  }
		}
	  }
	}
	
	
	
	// First page displayed
	else{ ?>
    <h1>Please choose which sports you would like displayed</h1>
    <form>
      <div clas="checkbox">
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
		  $smt = $pdo->prepare("SELECT DISTINCT Sport FROM hohInductees ORDER BY Sport");
		  if ($smt->execute())
		  {
			$rows = $smt->fetchAll();
			if (count($rows)==0){
			  echo 'No show matches that search.';
			}
			else{
			  foreach($rows as $row)
			  {
		  		echo '<label><input type="checkbox" name="sport[]" value="'.$row['Sport'].'">'.$row['Sport'].'</label>';
				echo'<br>';
			  }
			  echo '<br>';
			  echo '<input type="submit" name="submit" value="submit">';
			}
		  }
		} ?>
      </form>
    <?php } ?>
</body>
</html>
