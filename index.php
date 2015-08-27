<!--Helpers-->
<?php 
    require_once '../helpers/rootResolver.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	    <title>artist: Giusy Pirrotta</title>

	    <!--Meta-->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta name="google" content="notranslate" /> <!--stops google trying to translate -->

	    <link rel="shortcut icon" href="favicon.ico">

	</head>
	<body>
		<h1>Content Manager</h1>

<?php               
    $dirs = glob("*", GLOB_ONLYDIR);
    if (count($dirs) > 0) {
        foreach($dirs as $dir) {
            echo "<p>".$dir."</p>";
            $sub_dirs = glob($dir."/*", GLOB_ONLYDIR);
            foreach($sub_dirs as $sub_dir) {
	            echo "<a href='".$sub_dir."'>".$sub_dir."</a>";
	        }
        }
    }            

?>
	</body>
</html>