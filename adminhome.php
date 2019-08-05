<?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
			   echo "<script type=\"text/javascript\">
                   $(document).ready(function() {
                    promptLogin();
                    });
			        </script>";
			   echo "<script>
			 window.onload = function() {
             document.getElementById('hidden').style.display = 'none';
             };
			    </script>";
			}
            ?>
<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Home Page</title>
</head>
    <body>
    <div class="loginform display ext">
    <h1>Welcome Home Admin!</h1>
    <div>
    <div>
    <ul>
    <li><a href="adminhome.php">Home</a></li>
    <li><a href="update.php">Update Student Details</a></li>
    <li><a href="delete.php">Delete Student</a></li>
    <li><a href="student_details.php">Student Details</a></li>
    </ul>
    </div>
    <div></div>
    </div>
    </div>
    </body>
</html>