 <?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {

    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "12345678";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if (isset($_POST['sub2'])) {
        $email = $_POST['email'];

        $sqltest = "SELECT * FROM student_details WHERE email_address ='" . $email . "'";
        $result = $connection->query($sqltest);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];

                $fullname = $fname . ' ' . $lname;
            }
        }
        $debit = $_POST['debit'];
        $credit = 0.00;
        $balance = ($debit - $credit);
        $date = date('Y-m-d');

        if (isset($email)) {
            $sql1 = "UPDATE finance_record SET balance = '$balance', credit = '$credit', date = '$date', debit = '$debit' WHERE email_address = '$email'";
            if ($connection->query($sql1) === TRUE) {
                $sql = "INSERT INTO record_history (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                if ($connection->query($sql) === TRUE) {
                    header('Location: feepayment.php');
                }
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }

            $connection->close();
            header('Location: feepayment.php');
        }
    } elseif (isset($_POST['sub1'])) {
        $email = $_POST['email'];

        $sqltest = "SELECT * FROM student_details WHERE email_address ='" . $email . "'";
        $result = $connection->query($sqltest);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];

                $fullname = $fname . ' ' . $lname;
            }
        }
        $debit = $_POST['debit'];
        $sqltest = "SELECT * FROM finance_record WHERE email = '" . $email . "'";
        $result = $connection->query($sqltest);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $balance = $row['balance'];
            }
        }
        $balance = $balance + $debit;
        $credit = 0.00;
        $date = date('Y-m-d');

        if (isset($email)) {
            $sql1 = "UPDATE finance_record SET balance = '$balance', credit = '$credit', date = '$date', debit = '$debit' WHERE email = '$email'";
            if ($connection->query($sql1) === TRUE) {
                $sql = "INSERT INTO record_history (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";

                if ($connection->query($sql) === TRUE) {
                    header('Location: feepayment.php');
                }
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }

            $connection->close();
        } else {
            echo "error";
        }
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