<?php
	include "vigenere.php";
	
	$host = 'localhost';
	$username='root';
	$password = '';
	$db = 'cipher';
	
	$connect = mysqli_connect($host, $username, $password, $db);
	
	$date = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];
	$status = 1;
	
	if(isset($_GET['error1']) == true ){
		
		echo "Error.";
	}
	
	

		
	if(isset($_POST['encrypter'])){
		//var_dump($_POST);
		$plainText = $_POST['plainText'];
		$key= $_POST['txtClef'];
		$action= "C";
		$result = encrypt($key, $plainText);
		//var_dump($result);
		
		$sql = "INSERT INTO cryptography (date, ip, key, action, status) VALUES ('$date', '$ip', '$key', '$action', '$status')";
		var_dump($sql);
		$resultsql = mysqli_query($connect, $sql);
		var_dump(mysqli_error($connect));
		/*if ($connect->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $connect->error;
		}*/
	}

	if(isset($_POST['decrypter'])){
		$key= $_POST['txtClef'];
		$encryptText = $_POST['txtEncrypte'];
		$decrypt = decrypt($key, $encryptText);
		$action = "D";
		
		$sql = "INSERT INTO cryptography (date, ip, key, action, status) VALUES ('$date', '$ip', '$key', '$action', '$status')";
		
		if ($connect->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $connect->error;
		}
		//var_dump($decrypt);
	}
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ze Vigenere Tool</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div id="tool">
			<form method="POST" action="index.php">
				
				<label>Texte en clair : </label>
				<textarea rows="10" cols="50"  name="plainText" ><?php if(isset($decrypt)){echo $decrypt ; }?></textarea><br/>
				
				<label id="msgError" name="error1"></label><br>
				
				<label>Clef :</label>
				<input type="text" class="txtClef" name="txtClef"/>
				<button name="encrypter" class="btn">Encrypter</button>
				<button name="decrypter" class="btn">Decrypter</button><br>
											
				<label id="msgError" name="error2"></label><br>
				
				<label>Texte encrypte :</label>
				<textarea rows="10" cols="50" name="txtEncrypte"><?php if(isset($result)){ echo $result; }?></textarea><br/>
				
				<input type="submit" name="btnSubmit" value="Effacer" class="effacer"/>
			</form>
		<div><!-- end tool-->
		
	</body>
</html>