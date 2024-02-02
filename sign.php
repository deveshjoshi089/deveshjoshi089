<?php include("../ecomerce/include/head.php"); ?>

<!-- Start Header/Navigation -->
<?php include("../ecomerce/include/nav.php")  ?>
<!-- End Header/Navigation -->

<!-- <button href="index.php" type="button" id="closeButton" class="btn btn-primary rounded-circle mb-5" style="padding: 0px 8px 1px 7px; float:right;margin-top: 10px;
  margin-right: 10px;">
    <i class="fas fa-times"></i>
</button> -->
<a href="index.php" class="btn btn-primary rounded-circle mb-5" style="padding: 0px 8px 1px 7px; float:right;margin-top: 10px;
  margin-right: 10px;"><i class="fas fa-times"></i></a>




<?php
require_once "connect.php";




$name_error = $email_error = $phone_error = $password_error = $com_password_error = $file_error = "";
$name = $email = $phone = $password = $com_password = $file = "";



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // NAME,EMAIL,phone,password,com_password 
    $name = htmlspecialchars($_POST['name']);
    $email = $_POST['email'];
    $file = $_FILES['file']['name'];
    $phone = $_POST['phone'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $password=$_POST['password'];





    // name validtion
    if (empty($name)) {
        $name_error = "Please Enter Your name";
    } else {
        // Validate name with regex (allowing letters, spaces, and hyphens)
        if (!preg_match("/^[a-zA-z\s]{3,}+$/", $name)) {
            $name_error = "Fill up a write Info (Minimum value 3)";
        }
    }


    // email validation
    if (empty($email)) {
        $email_error = "Please Enter Your Email";
    } else {
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail.com+$/", $email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email";
        } else {
            // user dont use already exist email 
            $checkemail = "select * from user where Email = '$email'";
            $result = $conn->query($checkemail);
            if ($result->num_rows > 0) {
                $email_error = "This email already exist";
            }
        }
    }

    // password validation
    if (empty($password)) {
        $password_error = "Please Enter Your Password";
    } else {
        if (!preg_match("/[a-zA-z]*[0-9]*$/", $password)) {
            $password_error = "password de ";
        }
    }





    // phone number Validation
    if (empty($phone)) {
        $phone_error = "please Enter Phone Number";
    } else {
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phone_error = "Invalid Phone Number";
        } else {
            // user dont use already exist phone number
            $checkphone = "select * from user where Phone='$phone'";
            $result = $conn->query($checkphone);
            if ($result->num_rows > 0) {
                $phone_error = "This Phone number already Exist";
            }
        }
    }


    // Validate file upload
    //   file move in another folder
    // 1MB=1024KB=1024000B
    $file = $_FILES['file']['name'];

    // ek folder se nikalne ke liye ../ iska se karge
    $target_dir = 'img/'; //select folder to move file
    $target_file = $target_dir . $file; // select folder with file kis name se save hovgi in folder
    $temp_file = $_FILES['file']['tmp_name'];  //file temp name save
    $file_info = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //file ka type janane ke liye like:-jpg,png,jpeg etc...

    // files exist karti hai ya nahi 
    if (file_exists($target_file)) {
        $file_error = "already file exist";
    }

    // check file size validation (file size in B)
    if ($_FILES['file']['size'] > 1024000 * 1) {
        $file_error = "Image size Should be less than 1MB";
    } else {
        if ($file_info == 'jpg' || $file_info == 'jpeg' || $file_info == 'png') {
            move_uploaded_file($temp_file, $target_file); //ab file move hogyi hai img move
        } else {
            $file_error = "Only upload jpg,jpeg,png file Formate";
        }
    }








    if (empty($name_error) && empty($email_error) && empty($file_error) && empty($phone_error) && empty($password_error) && empty($com_password_error)) {


        // Insert data into the database
        


        $sql = "INSERT INTO `user`(`name`, `email`, `file`, `phone`, `password`) 
VALUES ('$name','$email','$file','$phone','$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";

            header("location:login.php");
        } else {
            echo "Error: New Record Create Unsuccefull ";
            header("location:login.php");
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>



    <div class="container mt-5">
        <form method="post" action="" enctype="multipart/form-data">



            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id= "name" value="<?php echo $name; ?>">
                <span class="bg-warning"><?php echo $name_error; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                <span class="bg-warning"><?php echo $email_error; ?></span>
            </div>

            <div class="form-group">
                <label for="file">Upload:</label>
                <input type="file" class="form-control" name="file" id="file" value="<?php echo $file; ?>">
                <span class="bg-warning"><?php echo $file_error; ?></span>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>">
                <span class="bg-warning"><?php echo $phone_error; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>">
                <span class="bg-warning"><?php echo $password_error; ?></span>

                <span class="input-group-text eye-icon col-1" onclick="togglePassword('password')" style="float: right;
                                 position: relative;
                                 top: -33px;
                                right: -49px;
                                background: none !important;
                                border: none;">
                    <i class="fas fa-eye"></i>
                </span>
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional, for certain Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>



<div class="conatiner" style="margin-top: 100px;">
    <!-- Start Footer Section -->



    <!-- includer footer and all links -->
    <?php include("../ecomerce/include/footer.php"); ?>
</div>