<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {
    // Using MYSQLi connection
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "12345678";
    $dbname = "egerton_university";

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
				<li><a href="feepayment.php">Fee Payment</a></li>
				<li><a href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a class="selectnav" href="examlist.php">Exams</a></li>
				<li><a class="logout" href="adminlogout.php">Log Out</a></li>
			</ul>
		</div>
		<div class="display exxt">
			<div>
				<form action="examdebit.php" method="post">
					<input type="submit" class="input submit" name="init"
						value="ADD STUDENTS"><br>
				</form><br>
				<form action="examdebit.php" method="post">
					<input type="submit" class="input submit" name="exam"
						value="EXAM TIME"><br>
				</form>
			</div>
			<div>
				<div class="overflower display exxt">
					<div>
						<form action="#" method="get">
							<input type="submit" class="input submit" name="getlist"
								value="Get List"><br>
						</form>

					</div>
    <?php
    if (isset($_GET['getlist'])) {
        $sql = "SELECT * FROM finance_record ORDER BY idfinance_record DESC, email";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            // AS fr GROUP BY fr.email ORDER BY fr.idfinance_record DESC
            $counter = 1;
            $prevemail = null;
            echo '<h1>Exam List</h1><hr>';
            echo '<table class="table" border="0" cellspacing="2" cellpadding="5">
	
	<tr>
<th>No</th>
<th>Full Name</th>
<th>Email</th>
<th>Date</th>
<th>Balance</th>
</tr><br>';

            while ($row = $result->fetch_assoc()) {
                $date = $row["date"];
                $email = $row["email"];
                $balance = $row["balance"];
                $full_name = $row["full_name"];

                if ($email != $prevemail && $balance >= 0) {

                    echo '
<tr>
    <td>' . $counter ++ . '</td>
    <td>' . $full_name . '</td>
    <td>' . $email . '</td>
    <td>' . $date . '</td>
    <td>' . $balance . '</td>
	</tr><br>';
                    $prevemail = $row["email"];
                }
            }
            $result->free();
        } else {
            echo "No student enlisted";
        }

        $connection->close();
    }
    ?>
			
			</div>
			</div>
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