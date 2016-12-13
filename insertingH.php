<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert into Bellarmine Award</title>
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
	  $firstNa = $_REQUEST['firstNa'];
	  $lastNa = $_REQUEST['lastNa'];
	  $sport = $_REQUEST['sport'];
	  //$yearInd = $_REQUEST['yearInd'];
	  
	  
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
	    $smt = $pdo->prepare("INSERT INTO hofInductees (`Last Name`, `First Name`, Name, `Class of`, Sport) VALUES (:LastNa, :FirstNa, :Name, :Class, :Sport)");
		
		$smt->bindValue(':LastNa', $lastNa);
		$smt->bindValue(':FirstNa', $firstNa);
		$smt->bindValue(':Name', $name);
		$smt->bindValue(':Class', $class);
		$smt->bindValue(':Sport', $sport);
		//$smt->bindValue(':YearInducted', $yearInd);
		
		if($smt->execute())
		{
	      echo 'Inserted successfully<br>';
		  echo $name.' from the class of '.$class;
		  echo '<br><br><a href="insertingH.php">Back</a>';
		}
	  }
	}
	else{
	  ?>
      <h1>Insert into the Hall of Fame table here</h1>
	  <form>
		<label><input type="text" name="name"> Full Name (Example: Bob A. Smith)</label>
        <br><br>
        <label><input type="text" name="firstNa"> First Name (Example: Bob)</label>
        <br><br>
        <label><input type="text" name="lastNa"> Last Name (Example: Smith)</label>
        <br><br>
        <label><input type="text" name="class"> Class of (Example: 2051)</label>
        <br><br>
        <div class="form-group">
          <label for="sport">Sport </label>
          <select class="form-control" name="sport" id="sport">
            <option>Aquatics</option>
            <option>Baseball</option>
            <option>Basketball</option>
            <option>Cross Country</option>
            <option>Football</option>
            <option>Golf</option>
            <option>Multi-Sport</option>
            <option>Soccer</option>
            <option>Special</option>
            <option>Tennis</option>
            <option>Track</option>
            <option>Wrestling</option>
          </select>
        </div>
        <br><br>
        <label><input type="text" name="yearInd"> Year Inducted (Example: 1999)</label>
        <br><br>
		<input type="submit" name="submit" value="submit">
     	<br><br><a href="../changes/iuHof.html">Back</a>
      </form>
	  <?php } ?>

</body>
</html>