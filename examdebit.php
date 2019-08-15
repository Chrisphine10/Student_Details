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
    $prevemail = null;

    if (isset($_POST['exam'])) {

        $sqltest = "SELECT * FROM finance_record ORDER BY email";
        $result = $connection->query($sqltest);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $balance = $row["balance"];
                $email = $row["email"];
                $fullname = $row["full_name"];
                $debit = 0.00;
                $credit = 8000.00;
                $balance = $balance - $credit;
                $date = date('Y-m-d');
                if ($email != $prevemail) {

                    $sql = "INSERT INTO finance_record (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";

                    $connection->query($sql) === TRUE;

                    $prevemail = $email;
                }
           }
           $connection->close();
        } else {
            $servername = "127.0.0.1:3306";
            $username = "pheene";
            $password = "Passw0rd";
            $dbname = "egerton_university";
            
            $connection = new mysqli($servername, $username, $password, $dbname);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $sqltest = "SELECT * FROM student_details";
            $result = $connection->query($sqltest);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $balance = 0.00;
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $email = $row['email_address'];
                    $fullname = $fname . ' ' . $lname;
                    $debit = 0.00;
                    $credit = 8000.00;
                    $balance = $balance - $credit;
                    $date = date('Y-m-d');

                    $sql = "INSERT INTO finance_record (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";

                    $connection->query($sql) === TRUE;
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