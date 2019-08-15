<html class="htmlextend">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="signupform">
	<div class="inside">
		<form name="signup" action="addstudent.php" id="loginform"
			method="post" onsubmit="validateform()">
			<div class="formheader">
				<a href="login.php" id="logbord">Log In</a><a class="selected">Sign
					Up</a>
			</div>
			<hr>
			<h2>Student Sign Up</h2>
			<input class="input" type="text" name="fname"
				placeholder="Enter student first name..." required="required"> *<br>
			<input class="input" type="text" name="lname"
				placeholder="Enter student second name..." required="required"> *<br>
			<select class="input" name="gender" form="loginform">
				<option value=null>Select your gender...</option>
				<option value="male" required="required">Male</option>
				<option value="female" required="required">Female</option>
			</select> *<br> <input class="input" type="email" name="email"
				placeholder="Enter student email address..." required="required"> *<br>
			<input class="input" type="tel" max="100000000000"
				name="phone_number" placeholder="Enter student phone number..."
				required="required"> *<br> <input class="input" type="number"
				min="100000" max="50000000" name="idnumber"
				placeholder="Enter student ID number..." required="required"> *<br>
			<label>Date of Birth: </label><br> <input class="input" type="date"
				date-format="YYYY MMMM DD" value="2000-01-01" max="2000-01-31"
				name="date_of_birth" required="required"> *<br> <select
				class="input" name="religion" form="loginform">
				<option value="null">Select your religion...</option>
				<option value="christian">Christian</option>
				<option value="muslim">Muslim</option>
				<option value="hindu">Hindu</option>
			</select> *<br> <input type="password" class="input" name="password"
				required="required" placeholder="Enter you new password..."> * <br>
			<input type="password" class="input" name="cpassword"
				required="required" placeholder="Confirm your password..."> *<br> <input
				class="submit input" type="submit" name="submit1">
		</form>
		<div class="footer">
			<div class="signup">
				Have an account?<a href="login.php">Log in</a>
			</div>
		</div>
	</div>
	</div>
</body>
</html>