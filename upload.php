<?php
$target_dir = "../uploads/";
$fileName = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$embedHeight = $_POST["embedHeight"];
$embedWidth = $_POST["embedWidth"];
$baseURL = "http://ec2-52-1-90-185.compute-1.amazonaws.com/uploads/";
$finalURL= $baseURL . $fileName;
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	echo "The file <a href=\"{$finalURL}\">" .  basename($_FILES["fileToUpload"]["name"]) .  "</a> has been uploaded. To embed, copy and past the following code:<br>";
	echo "
		<form method=\"post\" enctype=\"multipart/form-data\">
		<input type=\"text\" name=\"embedCode\" value=\"<iframe height={$embedHeight}px width={$embedWidth}px src='{$finalURL}' seamless></iframe>\">
		</form>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
