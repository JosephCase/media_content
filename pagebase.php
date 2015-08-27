<!--Helpers-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>artist: Giusy Pirrotta</title>

	    <!--Meta-->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta name="google" content="notranslate" /> <!--stops google trying to translate -->

	    <link rel='stylesheet' type='text/css' href='css/style.css' />

	    <link rel="shortcut icon" href="favicon.ico">

	</head>
	<body>
		<h1>Content Manager</h1>

<?php
	echo "<h4>Main Image</h4>";
	echo "<img src='mainImage_s.jpg' />";         
    $images = glob("images/*_s.jpg");
    echo "<h4>Images</h4>";
    if (count($images) > 0) {
        foreach($images as $image) {        	
			echo "<img src='".$image."' />"; 
        }
    }
?>

	</body>
</html>