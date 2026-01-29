<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $university = $_POST['university'];
    $level = $_POST['level'];
    $topic = $_POST['topic'];
    $package = $_POST['package'];
    $paymentMethod = $_POST['paymentMethod'];

    // Handle file upload
    if(isset($_FILES['paymentProof'])){
        $errors= [];
        $file_name = $_FILES['paymentProof']['name'];
        $file_tmp = $_FILES['paymentProof']['tmp_name'];
        $file_ext = strtolower(end(explode('.', $_FILES['paymentProof']['name'])));
        $extensions= ["jpeg","jpg","png","pdf"];

        if(in_array($file_ext, $extensions) === false){
           $errors[]="Extension not allowed. Please upload JPEG, PNG or PDF.";
        }

        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"uploads/".$file_name);
        }else{
           print_r($errors);
           exit;
        }
    }

    // Save to database or send email
    // Example: send email
    $to = "your_email@example.com";
    $subject = "New Research Submission";
    $message = "Name: $fullname\nEmail: $email\nPhone: $phone\nUniversity: $university\nLevel: $level\nTopic: $topic\nPackage: $package\nPayment Method: $paymentMethod\nProof File: $file_name";
    mail($to,$subject,$message);

    echo "Submission successful! We will verify your payment shortly.";
}
?>
