<?php
	if ($_SERVER['REQUEST_METHOD'] === "POST") {

		echo $new_file = $_POST["directory"]."/mainImage_o.jpg";

		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_file)) {
			echo "Success";
		};

        resizeImage($new_file, 1400, "_l");
        resizeImage($new_file, 900, "_m");
        resizeImage($new_file, 600, "_s");

	}

	 function resizeImage($file, $newWidth, $extension) {

        set_time_limit(20);

        $image = @imagecreatefromjpeg($file);
        $new_file = str_replace("_o.jpg", $extension.".jpg", $file);
        
        if (imagesx($image) < $newWidth) { //if the image is smaller than it needs to be, do not scale up
            $newWidth = imagesx($image);
        }

        // Get new dimensions
        $ratio = imagesy($image) / imagesx($image);
        $newHeight = round($newWidth * $ratio);

        //Resize image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));

        // Sharpen Image
        if ($extension == "_s") {
            $resizedImage = sharpen($resizedImage);
        }

        // //Save image
        if (imagetypes() & IMG_JPG) {
            imagejpeg($resizedImage, $new_file, 90);
            imagedestroy($image);
            imagedestroy($resizedImage);
        }
                       
    }

	function sharpen($image) {
	    // define the sharpen matrix 

	    // quite good (tiny bit too sharp)
	    // $sharpen = array(
	    //     array(-1.2, -1, -1.2), 
	    //     array(-1, 20, -1), 
	    //     array(-1.2, -1, -1.2)
	    // );

	    // ~perfect
	    $sharpen = array( 
	        array(-0.5,-0.5,-0.5), 
	        array(-0.5,16,-0.5), 
	        array(-0.5,-0.5,-0.5)
	    );


	    // calculate the sharpen divisor
	    $divisor = array_sum(array_map('array_sum', $sharpen));

	    // apply the matrix
	    imageconvolution($image, $sharpen, $divisor, 0);

	    return $image;
	}


?>


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


	<h4>Main Image</h4>
	<img src='mainImage_s.jpg' />
	<form action="index.php" method="post" enctype="multipart/form-data">
	    Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="hidden" name="directory" id="directory" value="<?=getcwd()?>">
	    <input type="submit" value="Upload Image" name="submit">
	</form>        
<?php 
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