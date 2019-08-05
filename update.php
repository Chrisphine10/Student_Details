<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title>Update Student</title>
</head>
<body>
	<div class="loginform display exxt">
	<form action="#">
	<input class="input" type="email" name="email"
				placeholder="Enter student email address...">
				<input class="submit input" type="submit">
				</form>
								<?php
// Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset( $_GET["email"])) {
    $emails = $_GET["email"];
$sql = "SELECT * FROM student_details WHERE email_address = '". $emails."'";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
   
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $fname = $row["fname"];
        $lname = $row["lname"];
        $phone = $row["phone_number"];
        $gender = $row["gender"];
        $id = $row["id_number"];
        $dob = $row["date_of_birth"];
        $religion = $row["religion"];
        $pass = $row["password"];
    }
}
   $connection->close();  
?>
				
	<form action="editstudent.php" id="loginform" method="post">
		<h3>Edit Student Detail</h3>		
				<br>
				<label for="email">Email:</label>
				<input class="input" type="text" value="<?php if (isset($emails)) {echo $emails;}?>" name="email"><br>
				<label for="fname">First Name:</label>
			<input class="input" type="text" value="<?php if (isset($fname)) {echo $fname;}?>" name="fname"
			><br> 
			<label for="lname">Last Name:</label><input class="input"
				type="text" name="lname" value="<?php if (isset($lname)) { echo $lname; }?>"><br>
				<label for="gender">Gender:</label>
			<select class="input" name="gender" form="loginform">
				<option value= "<?php if (isset($gender)) {echo $gender;}?>"><?php if (isset($gender)) {echo "Currently set to ". $gender;}?></option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select><br>
			<label for="phone">Phone Number: </label><input
				class="input" type="tel" value="<?php if (isset($phone)) {echo $phone;}?>" name="phone_number"><br>
				<label for="id">ID Number:</label>
				<input
				class="input" type="number" min="0" max="40000000" value="<?php if (isset($id)) { echo $id;}?>" name="idnumber"
				><br> <label>Date of Birth:
			</label><input value="<?php if (isset($dob)) {echo $dob;}?>" class="input" type="date"
				date-format="YYYY MMMM DD" max="2000-01-31" name="date_of_birth"><br>
			<label for="religion">Religion:</label><select class="input" name="religion" form="loginform">
					<option value= "<?php if (isset($religion)) {echo $religion;}?>"><?php if (isset($religion)) {echo $religion;}?></option>
					<option value="christian">Christian</option>
					<option value="muslim">Muslim</option>
					<option value="hindu">Hindu</option>
			</select><br>
			<label>Your old password is <?php if (isset($pass)) { echo $pass;}?></label><br>
			<input type="password" class="input" name="password" placeholder="Enter new password..."> <br> <input type="password"
				class="input" name="cpassword" placeholder="Confirm new password..."> <br> <input
				class="submit input" type="submit" name="submit1">
		
		</form>
		<?php }
		else {
		   echo "Student record not found!";
		   
		   $connection->close();
		}
}?>
	</div>
</body>
</html>