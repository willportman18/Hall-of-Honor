<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Updating Valedictorian Table</title>
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
	  $class = $_REQUEST['class'];
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
	    $smt = $pdo->prepare("UPDATE valedictorians SET Name = :Name WHERE `Class` = :Class");
		$smt->bindValue(':Name', $name);
		$smt->bindValue(':Class', $class);
		if($smt->execute())
		{
	      echo 'Updated successfully'.'<br>';
		  echo $name.' from the class of '.$class;
		  echo '<br><br>'.'<a href="updatingVa.php">Back</a>';
		}
	  }
	}
	else{
	  ?>
      <h1>Update the Valedictorian table here</h1>
	  <form>
		<label><input type="text" name="name"> Full Name (Example: Bob A. Smith)</label>
        <br><br>
 		<label><input type="text" name="class"> Class (Example: 2051)</label>
        <br><br>
		<input type="submit" name="submit" value="submit">
      </form>
	  <?php } ?>

</body>
</html>