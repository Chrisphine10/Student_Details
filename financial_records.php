<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {
    ?>
    <!DOCTYPE HTML>
<html class="htmlextend">
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
				<li><a class="selectnav" href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a href="examlist.php">Exams</a></li>
				<li><a class="logout" href="adminlogout.php">Log Out</a></li>
			</ul>
		</div>
		<div class="overflower display exxt">
		<?php
    // Using MYSQLi connection
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "12345678";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    echo '<h1>Financial Record</h1><hr>';

    echo '<table class="table" border="2" cellspacing="2" cellpadding="5">
	
<tr>
<th>No</th>
<th>Full Name</th>
<th>Email</th>
<th>Date</th>
<th>Balance</th>
<th>Debit</th>
<th>Credit</th>
</tr><br>';

    $sql = "SELECT * FROM finance_record ORDER BY full_name ASC";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {

        $counter = 1;
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $date = $row["date"];
            $email = $row["email"];
            $balance = $row["balance"];
            $debit = $row["debit"];
            $credit = $row["credit"];
            $full_name = $row["full_name"];
            echo '
<tr>
    <td>' . $counter ++ . '</td>
    <td>' . $full_name . '</td>
    <td>' . $email . '</td>
    <td>' . $date . '</td>
    <td>' . $balance . '</td>
    <td>' . $debit . '</td>
    <td>' . $credit . '</td>
	</tr><br>';
        }

        $result->free();
    } else {
        echo "No Record Found";
    }

    $connection->close();
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
    header('Location: adminlogin.php');
}
?>