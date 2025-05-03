<?php
require_once('routes/router.php');
require_once('includes/navigation.php');

// Get the navigation HTML
$nav = getNavigation();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Assignment 12</title>
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	</head>

	<body class="container">
		<?php
			/* This is the navigation  */
			echo $nav;
			
			/* This is the page content  */
			echo $path; 

		?>
	</body>
</html> 