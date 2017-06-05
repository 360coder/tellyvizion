<?php

//require '/vendor/autoload.php';
use Aws\S3\Exception\S3Exception;
require_once 'app/start.php';
require_once 'vendor/autoload.php';
//use Aws\S3\S3Client;

// Instantiate an Amazon S3 client.
if(isset($_FILES['file'])){
	
	$file = $_FILES['file'];
	
	$name = $file['name'];
	$tmp_name = $file['tmp_name'];
	$extension = explode('.',$name);
	$extension = strtolower(end($extension));
	var_dump($extension);
	//Temp details
	$key = md5(uniqid());
	$tmp_file_name = "{$key}.{$extension}";
	echo "<pre>"; print_r($tmp_file_name); 
	//$tmp_file_path = 'C:/xampp/htdocs/aws/'. "files/{$tmp_file_name}";
	$tmp_file_path = dirname(__FILE__) .'/'. "files/{$tmp_file_name}";
	echo "<pre>"; print_r($tmp_file_path );
	
	
	move_uploaded_file($tmp_name,$tmp_file_path);
	
	try {
    $s3->putObject([
        //'Bucket' => 'tellyvizion',
        'Bucket' => $config['s3']['bucket'],
        'Key'    => 'uploads/{$name}',
        'Body'   => fopen($tmp_file_path, 'rb'),	
        'ACL'    => 'public-read',
    ]);
} catch (Aws\S3\Exception\S3Exception $e)
 //catch (S3Exception $e)
 {
    echo "There was an error uploading the file.\n";
}
	
}


?>

<html>
<head>

</head>
<body>
<form name="" method="POST" action="index.php" enctype="multipart/form-data">

<input type="file" value="Upload" name="file">
<input type="submit" name="submit" value="Upload"> 

</form>

<h1>All uploaded files</h1>
<?php
	// Get the contents of our bucket
	/* $contents = $s3->getBucket("tellyvizion");
	foreach ($contents as $file){
	
		$fname = $file['name'];
		$furl = "http://tellyvizion.s3.amazonaws.com/".$fname;
		
		//output a link to the file
		echo "<a href=\"$furl\">$fname</a><br />";
	}  */
?>



</body>
</html>




