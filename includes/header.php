<!DOCTYPE html>
<html>
<head>
		<meta charset='UTF-8'>
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" type="text/css" href="assets/css/main.css" />
</head>

<header>    
	<center><img src="assets/img/logo.png"></center>
</header>
<nav>
	<ul>
		<li><a href="index.php">HOME</a></li>
		<li><a href="admin.php">Admin</a></li>
		<li><a href="password_change.php">Change Agent Password</a></li>
		<li><?php if ( (isset($_SESSION['agent_id'])) && (basename($_SERVER['PHP_SELF']) != 'logout.php') ) {
			echo '<a href="logout.php">
			Logout</a>';
			} else { echo '<a href="login.php">
			Login</a>';
			}			
?></li>
	</ul>
</nav>
<!-- This is the TenBuyers Application-->
<body>