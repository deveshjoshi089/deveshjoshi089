<?php
// session_start();
include("../ecomerce/include/head.php"); ?>

<!-- Start Header/Navigation -->
<?php include("../ecomerce/include/nav.php")  ?>
<!-- End Header/Navigation -->


<?php
include "connect.php";
$email_error = $password_error = "";
$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // email validation
    if (empty($email)) {
        $email_error = "Enter Your Email";
    }

    if (empty($password)) {
        $password_error = "Enter Your Password";
    }

    if(empty($email_error) && empty($password_error)){
        $sql="SELECT * FROM `user` WHERE email='$email'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            if(password_verify($password,$row['password'])){
                echo "login succefull";
            }else{
                echo "not login";
            }
        }else{
            echo "wrong data insert";
        }
    }else{
        echo "plzz fillup detail form";
    }



  
}



?>








<a href="index.php" class="btn btn-primary rounded-circle mb-5" style="padding: 0px 8px 1px 7px; float:right;margin-top: 10px;
  margin-right: 10px;"><i class="fas fa-times"></i></a>

<div class="form-container container">
    <form id="myForm" class="col-12" method="post" enctype="multipart/form-data" action="">

        <!-- Your form fields go here -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $email; ?>">

        </div>

        <div class="mb-3">
            <label for="password1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" id="exampleInputPassword1" value="<?php echo $password; ?>">

            <span class="input-group-text eye-icon col-1" onclick="togglePassword('password')" style="float: right;
  position: relative;
  top: -38px;
  right: -49px;
  background: none !important;
  border: none;">
                <i class="fas fa-eye"></i>
            </span>

        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
        <!-- Add a close button with a Font Awesome icon -->

    </form>

</div>






<div class="conatiner" style="margin-top: 100px;">
    <!-- includer footer and all links -->
    <?php include("../ecomerce/include/footer.php"); ?>
</div>