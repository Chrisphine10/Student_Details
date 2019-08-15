<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {

    $servername = "127.0.0.1:3306";
    $username = "pheene";
    $password = "Passw0rd";
    $dbname = "egerton_university";
    global $fullname;
    global $balance;

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title>Update Student</title>
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a href="adminhome.php">Home</a></li>
				<li><a href="update.php">Update Student Details</a></li>
				<li><a href="delete.php">Delete Student</a></li>
				<li><a href="student_details.php">Student Details</a></li>
				<li><a class="selectnav" href="feepayment.php">Fee Payment</a></li>
				<li><a href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a href="examlist.php">Exams</a></li>
				<li><a class="logout" href="adminlogout.php">Log Out</a></li>

			</ul>
		</div>
		<div class="loginform display exxt">

			<form action="#" method="get">
				<h1>Fee Payment</h1>
				<label for="email">Student Email: </label> <br> <input type="email"
					name="email" class="input" placeholder="Enter student email..."> <input
					type="submit" class="input submit" name="sub" value="search">
			</form>
			<br> <br>
	
	<?php

    if (isset($_GET["sub"]) && ! ($_GET["email"] == null)) {
        $email = $_GET["email"];

        $sqltest = "SELECT * FROM student_details WHERE email_address ='" . $email . "'";
        $result = $connection->query($sqltest);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];

                $fullname = $fname . ' ' . $lname;
                $sql = "SELECT * FROM finance_record WHERE email = '" . $email . "'";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $balance = $row["balance"];
                    }
                    ?>
			<br> <label>Full Name: </label>
			<?php if(isset($fullname)){ echo $fullname; }?>
			
             <br> <label for="email">Email: </label><?php echo $email; ?>
			<br> <label for="balance">Balance: </label>
			<?php if(isset($balance)){ echo $balance; }?><br>
			<form action="debit.php" method="post">
				<input class="input" type="hidden" readonly name="email"
					value="<?php echo $_GET['email']; ?>"> <input class="input"
					type="number" name="debit"
					placeholder="Enter amount paid by student..." step="0.01"> <input
					type="submit" class="input submit" name="sub1" value="Pay"><br>
			</form>
			
			<?php
                } else {

                    ?>
            	<form action="debit.php" method="post">
				<input class="input" type="hidden" readonly name="email"
					value="<?php echo $_GET['email']; ?>"> <input class="input"
					type="number" name="debit"
					placeholder="Enter amount paid by student..." step="0.01"> <input
					type="submit" class="input submit" name="sub2" value="Pay"><br>
			</form>
			<br>
	    
            <?php
                    echo $fullname . " has no fee history<br>";
                    $connection->close();
                    ?>
	    <?php
                }
            }
        } else {
            echo "There is no record of the student in our database!<br>";
        }
    }
    ?>
		
	
	
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
    header('Location: login.php');
}
?>