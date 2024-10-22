<?php
$con = mysqli_connect('localhost', 'root', '');
mysqli_select_db($con, 'project_1') or die('please check your database');

if (isset($_POST['submit'])) {
   
    $errors = array();

  
    if (empty($_POST['name']) || !preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
        $errors[] = "Name is required and should only contain letters and spaces";
    } else {
        $name = $_POST['name'];
    }


    if (empty($_POST['date'])) {
        $errors[] = "Date is required";
    } else {
        $date = $_POST['date'];
    }

  
    if (empty($_POST['number']) || !preg_match("/^[0-9]*$/", $_POST['number'])) {
        $errors[] = "Number is required and should only contain digits";
    } else {
        $number = $_POST['number'];
    }

  
    if (empty($_POST['movingFrom'])) {
        $errors[] = "Moving From is required";
    } else {
        $movingFrom = $_POST['movingFrom'];
    }

   
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is required and should be a valid email address";
    } else {
        $email = $_POST['email'];
    }


    if (empty($_POST['movingTo'])) {
        $errors[] = "Moving To is required";
    } else {
        $movingTo = $_POST['movingTo'];
    }

    if (empty($_POST['message'])) {
        $errors[] = "Message is required";
    } else {
        $message = $_POST['message'];
    }

    // If there are no errors, proceed with inserting data into the database
    if (empty($errors)) {
       
        $query = "INSERT INTO `detail_form`(`Name`, `Date`, `Number`, `Move_from`, `Email`, `Move_to`, `Message`) VALUES(?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $date, $number, $movingFrom, $email, $movingTo, $message);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Inserted";
        } else {
            echo "Not Inserted";
        }
    } 
}
?>

