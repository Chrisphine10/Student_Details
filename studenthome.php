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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Student Home Page</title>
</head>
    <body>
    <h1>Welcome Home student!</h1><br>
    <a href="logoutsession.php">Log Out</a>
    </body>
</html>