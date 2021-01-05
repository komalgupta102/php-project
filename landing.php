<?php include_once 'helpers/init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	 <!-- add bootstrap css file -->

      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
  <!-- navbar -->
<?php
session_start();
$isLoggedIn = 0;
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
	$isLoggedIn = 1;
}
?>
  <nav class="navbar navbar-expand-lg fixed-top ">
	  <a class="navbar-brand" href="#">Home</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse " id="navbarSupportedContent">
	    <ul class="navbar-nav mr-4">
	      
	      <li class="nav-item">
	        <a class="nav-link" data-value="about" href="javascript:;">About</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link " data-value="portfolio" href="javascript:;">Portfolio</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link " data-value="blog" href="javascript:;">Blog</a>
	      </li>
	      <li class="nav-item">
	      	<?php if($isLoggedIn){ ?>
				<a class="nav-link " data-value="contact" href="admin">Dashboard</a>
	      	<?php }else{ ?>
				<a class="nav-link " data-value="contact" href="javascript:;">Register</a>
	      	<?php } ?>
	      </li>
	      <?php if(!$isLoggedIn){ ?>
		  <li class="nav-item">
	        <a class="nav-link " data-value="blog" href="login.php">Login</a>
	      </li>
	      <?php } ?>
	    </ul>
	    
	  </div>
</nav>
<!-- header -->
<header class="header ">
  <div class="overlay"></div>
   <div class="container">
   	  <div class="description ">
  	<h1>
  		Hello ,Welcome To My official Website
  		<p>
  		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  		<button class="btn btn-outline-secondary btn-lg">See more</button>
  	</h1>
  </div>
   </div>
  
</header>

<!-- about section -->
<div class="about" id="about">
	<div class="container">
	  <h1 class="text-center">About Me</h1>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('komal.png')?>" class="img-fluid">
				<span class="text-justify">S.Software Engineer</span>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 desc">
			  
				<h3>Komal Gupta</h3>
				<p>
				   ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>
		</div>
	</div>
</div>

<!-- portfolio -->
<div class="portfolio" id="portfolio">
     <h1 class="text-center">Portfolio</h1>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<img src="<?php echo imageFile('port1.png')?>" class="img-fluid">
			</div>
		</div>
	</div>
</div>


<!-- Posts section -->
<div class="blog" id="blog">
	<div class="container">
	<h1 class="text-center">Blog</h1>
		<div class="row">
			<div class="col-md-4 col-lg-4 col-sm-12">
				<div class="card">
					<div class="card-img">
						<img src="<?php echo imageFile('blog.jpeg')?>" class="img-fluid">
					</div>
					
					<div class="card-body">
					<h4 class="card-title">Post Title</h4>
						<p class="card-text">
							
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>
					<div class="card-footer">
						<a href="" class="card-link">Read more</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-sm-12">
				<div class="card">
					<div class="card-img">
						<img src="<?php echo imageFile('blog.jpeg')?>" class="img-fluid">
					</div>
					
					<div class="card-body">
					   <h4 class="card-title">Post Title</h4>
						<p class="card-text">
							
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>
					<div class="card-footer">
						<a href="" class="card-link">Read more</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-sm-12">
				<div class="card">
					<div class="card-img">
						<img src="<?php echo imageFile('blog.jpeg')?>" class="img-fluid">
					</div>
					
					<div class="card-body">
					<h4 class="card-title">Post Title</h4>
						<p class="card-text">
							
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>
					<div class="card-footer">
						<a href="" class="card-link">Read more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contact form -->
<div class="contact-form" id="contact">
	<div class="container">
		<form id="register-form">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12">
				  <h1>Register Now</h1>	
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 right">
				   <div class="form-group">
				   	 <input type="text" class="form-control form-control-lg" placeholder="Your Name" name="name" required="">
				   </div>
				   <div class="form-group">
				   	 <input type="email" class="form-control form-control-lg" placeholder="YourEmail@email.com" name="email" required="">
				   </div>
				   <div class="form-group">
				   	  <input type="password" class="form-control form-control-lg" placeholder="Your Password" name="password" required="">
				   </div>
				   <input type="submit" class="btn btn-secondary btn-block" value="Send" name="">
				   <a class="btn btn-block btn-login" href="login.php">Already registered? Login</a>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- add Javasscript file from js file -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="assets/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src='assets/js/main.js'></script>

</body>
</html>