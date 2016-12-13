<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Update Past President's Table</title>
<link rel="stylesheet" href="../css/form.css">
</head>

<body>
  <?php
    $ini_array = parse_ini_file("../data-times.ini.php");
    
    $host = $ini_array['host'];
    $db_name = $ini_array['db_name'];
    $user_name = $ini_array['user_name'];
    $password = $ini_array['password'];
	
    
	if (array_key_exists('submit', $_REQUEST))
	{
	  $submitButton = $_REQUEST['submit'];
	  $name = $_REQUEST['name'];
	  $lastNa = $_REQUEST['lastNa'];
	  $end = $_REQUEST['end'];
	  $start = $_REQUEST['start'];
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
	    $smt = $pdo->prepare("UPDATE presidents SET Name = :Name, `Last Name` = :lastNa,   WHERE `End` = :End");
		$smt->bindValue(':Name', $name);
		$smt->bindValue(':lastNa', $lastNa);
		$smt->bindValue(':End', $end);
		if($smt->execute())
		{
	      echo 'Updated successfully'.'<br>';
		  echo $name.' who served from'.$served;
		  echo '<br><br>'.'<a href="updatingC.php">Back</a>';
		}
	  }
	}
	else{
	  ?>
      <h1>Update the Cardinal Bellarmine Award table here</h1>
	  <form>
		<label><input type="text" name="name"> Full Name (Example: Bob A. Smith)</label>
        <br><br>
        <label><input type="text" name="lastNa"> Last Name (Example: Smith)</label>
        <br><br>
 		<label><input type="text" name="start"> Start Year (Example: 1990-2015)</label>
        <br><br>
        <label><input type="text" name="end"> End Year (Example: 1990-2015)</label>
        <br><br>
		<input type="submit" name="submit" value="submit">

      </form>
	  <?php } ?>

</body>
</html>