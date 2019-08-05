<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "first name is required";
  } else {
    $name = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["lname"])) {
      $lnameErr = "last name is required";
  } else {
      $name = test_input($_POST["lname"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
          $lnameErr = "Only letters and white space allowed";
      }
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?><meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<div class="signupform display">
	<form action="addstudent.php" id="loginform" method="post">
	<div class="formheader"><a href="login.php" id="logbord">Log In</a><a class="selected">Sign Up</a></div>
	<hr>
	<h2>Student Sign Up</h2>
		<input class="input" type="text" name="fname"
			placeholder="Enter student first name..." required="required">* <?php echo $fnameErr;?><br> <input
			class="input" type="text" name="lname"
			placeholder="Enter student second name..." required="required"><br> 
			<select class="input" name="gender"
			form="loginform" required="required">
				<option value=null>Select your gender...</option>
				<option value="male" required="required">Male</option>
				<option value="female" required="required">Female</option>
		</select><br>
		<input
			class="input" type="email" name="email"
			placeholder="Enter student email address..." required="required"><br>
		<input class="input" type="tel" name="phone_number"
			placeholder="Enter student phone number..." required="required"><br>
		<input class="input" type="number" min="0" max="40000000"
			name="idnumber" placeholder="Enter student ID number..."
			required="required"><br> <label>Date of Birth: </label><br> <input
			class="input" type="date" date-format="YYYY MMMM DD" value="2000-01-01" max="2000-01-31" name="date_of_birth"
			required="required"><br> <select class="input" name="religion"
			form="loginform">
				<option value=null>Select your religion...</option>
				<option value="christian" required="required">Christian</option>
				<option value="muslim" required="required">Muslim</option>
				<option value="hindu" required="required">Hindu</option>
		</select><br> <input type="password" class="input" name="password"
			required="required" placeholder="Enter you new password..."> <br> <input
			type="password" class="input" name="cpassword" required="required"
			placeholder="Confirm your password..."> <br> <input
			class="submit input" type="submit" name="submit1" >
	</form>
	<div class="footer">
		<div class="signup">
			Have an account?<a href="login.php">Log in</a>
		</div>
	</div>
</div>
