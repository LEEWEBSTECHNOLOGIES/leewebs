<?php

include('admin/security.php');


if (isset($_POST['contact_save'])) {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $subject = $_POST['subject'];
     $message = $_POST['message'];
 
     $query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
     $query_run = mysqli_query($connection, $query);
 
     if ($query_run) {
          $_SESSION['status'] = "Your message has been sent!";
          $_SESSION['status_code'] = "success";
          header('Location: contact.php');
          
     } else {
          $_SESSION['status'] = "Message not sent!";
          $_SESSION['status_code'] = "error";
          header('Location: contact.php');
     }
 }



 






?>