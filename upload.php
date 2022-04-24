<?php 
$upload = 'err'; 
if(!empty($_FILES['file'])){ 
     
    // File upload configuration 
    $targetDir = "uploads/"; 
    // $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
     
    $fileName = rand(000000,999999).md5(basename($_FILES['file']['name'])).'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
    
    $targetFilePath = $targetDir.$fileName; 
     
    // Upload file to the server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
        $upload = 'ok'; 
    } 
} 
echo $fileName;
// echo 'ok'; 
?>