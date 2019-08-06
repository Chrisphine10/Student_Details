<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin']) && !isset($_SESSION['student'])) {
    ?><html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="loginform display">
<h1>Delete student</h1>
<form action="deleter.php" method="post">
<label for="email">Enter student email:</label>
<input class="input" type="email" name="email" placeholder="Enter student email address..."><br>
<input class="submit input" type="submit" name="submit1"><br>
</form>
</div>

</body>
</html>
<?php 
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy(); 
}
$_SESSION['LAST_ACTIVITY'] = time();
			}
			else {
			    header('Location: adminlogin.php');
			}
			?>