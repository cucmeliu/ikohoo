<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="sytlesheet" type="text/css" href="css/bootstrap.css"/>
<title>科狐工作室</title>
</head>

<body>
	<div id="header"><?php include 'header.php' ?></div>
	<div id="maincontent">
		<div id="side">
		<?php include 'sidebar.php' ?></div>
		<div id="main" class="col-xs-10">
			<?php  $pagename = $_GET['mainpage'].'.php'; ?>
			<?php include "$pagename";?>
		</div>
    <div id="footer"><?php include "footer.php"; ?></div>		
	</div>
	
<script src="js/bootstrap.js"></script>
<script src="js/jquery-1.11.2.js"></script>
</body>
</html>