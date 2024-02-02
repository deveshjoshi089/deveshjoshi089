<?php
session_start();
$_SERVER['SCRIPT_NAME']; //CRUNT FILE KO DEKH SAKTE HAI (/ECOMERCE/INDEX.php)
basename($_SERVER['SCRIPT_NAME']); // last file dekhne ke liye (index.php)
$crunt_file = basename($_SERVER['SCRIPT_NAME']);




?>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

	<div class="container">
		<a class="navbar-brand" href="index.php">Furni<span>.</span></a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsFurni">
			<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">


				<li class="<?php echo ($crunt_file == "index.php" ? 'active nav-item' : 'nav-item') ?>">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="<?php echo ($crunt_file == "shop.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="shop.php">Shop</a></li>
				<li class="<?php echo ($crunt_file == "about.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="about.php">About us</a></li>
				<li class="<?php echo ($crunt_file == "services.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="services.php">Services</a></li>
				<li class="<?php echo ($crunt_file == "blog.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="blog.php">Blog</a></li>
				<li class="<?php echo ($crunt_file == "contact.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="contact.php">Contact us</a></li>

				<?php if (empty($_SESSION['user_name'])) { ?>
					<li class="<?php echo ($crunt_file == "sign.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="sign.php"><i class="fa-solid fa-right-to-bracket"></i></a></li>
					<li class="<?php echo ($crunt_file == "login.php" ? 'active nav-item' : 'nav-item') ?>"><a class="nav-link" href="login.php"><i class="fa-solid fa-download"></i> </a></li>
				<?php    } else {    ?>
					<li><?php echo $_SESSION['user_name'];   ?></li>
					<li><a href="logout.php"><button>Logout</button></a></li>

				<?php  }   ?>




			</ul>

			<!-- <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
				<li><a class="btn btn-secondary" href=""><?php
															/* session_start();
															if (isset($_SESSION)) {
																echo $_SESSION['name'];
															}


															*/ ?></a></li>
				<li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
				<li><a class="nav-link" href="cartphp"><img src="images/cart.svg"></a></li>
			</ul> -->
		</div>
	</div>

</nav>