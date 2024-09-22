<?php
// include "includes/navBar.php";
include 'includes/connect.php';
?>
<?php
//CHECK IF FILE IS UPLOADED
if(isset($_POST['submit'])){
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    //CHECK IF THE FILE IS PDF AND LESS THAN 5MB
    if($fileType != "pdf" || $_FILES["pdfFile"]["size"] > 5000000){
        echo "Invalid file type or size";
    }else{
        //move uploaded file to uploads folder
        if(move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)){
            //Insert file information into database
            $fileName = $_FILES["pdfFile"]["name"];
            $folderPath = $targetDir;
            $timeStamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO file_upload(file_name, folder_path, time_stamp) VALUES ('$fileName', '$folderPath', '$timeStamp')"; 

            if($conn->query($sql)=== TRUE){
                echo "File uploaded successfully";
            }else{
                echo "Error: ". $sql . "<br>" . $conn->error;
            }

        }else{
            echo "Error uploading file";
        }
    } 
}

//close database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Upload PDF file:</h4>
            </div>
        <form enctype="multipart/form-data" method ="POST">
            <div class="form-group">
            <label for="pdfFile">Select PDF file:</label>
            <input type="file" name = "pdfFile" id = "pdf-file">
            </div>
                <button type = "submit" name = "submit" >Upload File</button>
                <button type = "reset" name = "submit" >Reset</button>
        </form>
        </div>
    </div>
   
</body>
</html>