<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {
    ?><html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a href="adminhome.php">Home</a></li>
				<li><a href="update.php">Update Student Details</a></li>
				<li><a class="selectnav" href="delete.php">Delete Student</a></li>
				<li><a href="student_details.php">Student Details</a></li>
				<li><a href="feepayment.php">Fee Payment</a></li>
				<li><a href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a href="examlist.php">Exams</a></li>
				<li><a class="logout" href="adminlogout.php">Log Out</a></li>
			</ul>
		</div>
		<div class="loginform display exxt">
			<h1>Delete student</h1>
			<form action="deleter.php" method="post">
				<label for="email">Enter student email:</label> <input class="input"
					type="email" name="email"
					placeholder="Enter student email address..."><br> <input
					class="submit input" type="submit" name="submit1"><br>
			</form>
		</div>
	</div>
</body>
</html>
<?php
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: adminlogin.php');
}
?>