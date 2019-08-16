 <?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {

    $servername = "127.0.0.1:3306";
    $username = "pheene";
    $password = "Passw0rd";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    if (isset($_POST['exam'])) {
        $sqltest = "SELECT * FROM finance_record ORDER BY email";
        $resultest = $connection->query($sqltest);
        if ($resultest->num_rows > 0) {
            while ($row = $resultest->fetch_assoc()) {
                $balance = $row["balance"];
                $email = $row["email"];
                $fullname = $row["full_name"];
                $debit = 0.00;
                $credit = 8000.00;
                $balance = $balance - $credit;
                $date = date('Y-m-d');

                $sql = "INSERT INTO record_history (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                if ($connection->query($sql) === TRUE) {
                    $sql1 = "UPDATE finance_record SET balance = '$balance', date = '$date' WHERE email = '$email'";
                    if ($connection->query($sql1) === TRUE) {}
                }
            }
        }

        $connection->close();
        header('Location: examlist.php');
    }

    if (isset($_POST['init'])) {
        $servername = "127.0.0.1:3306";
        $username = "pheene";
        $password = "Passw0rd";
        $dbname = "egerton_university";

        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT * FROM student_details";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $fullname = $fname . ' ' . $lname;
                $email = $row['email_address'];
                $debit = 0.00;
                $balance = 0.00;
                $credit = 8000.00;
                $balance = $balance - $credit;
                $date = date('Y-m-d');
                $sqltest = "SELECT * FROM finance_record WHERE email = '" . $email . "'";
                $resultest = $connection->query($sqltest);

                if ($resultest->num_rows > 0) {} else {

                    $sql = "INSERT INTO finance_record (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                    $connection->query($sql) === TRUE;
                }
            }
        }
        $sql = "SELECT * FROM student_details";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $fullname = $fname . ' ' . $lname;
                $email = $row['email_address'];
                $debit = 0.00;
                $balance = 0.00;
                $credit = 8000.00;
                $balance = $balance - $credit;
                $date = date('Y-m-d');
                $sqltesthis = "SELECT * FROM record_history WHERE email = '" . $email . "'";
                $resultesthis = $connection->query($sqltesthis);
                if ($resultesthis->num_rows > 0) {} else {
                    $sql1 = "INSERT INTO record_history (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                    $connection->query($sql1) === TRUE;
                }
            }
        }

        $connection->close();
        header('Location: examlist.php');
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: login.php');
}
?>