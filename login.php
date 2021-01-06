 <?php 
include_once 'helpers/init.php'; 
include_once('config.php');

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
  header("location:admin");
}

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 { echo "tets";
  $access_token = $facebook_helper->getAccessToken();
echo $access_token; exit;
  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl($base_url.'/login.php', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
     <!-- add bootstrap css file -->

      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
 <div class="contact-form" id="login">
    <div class="container">
        <form id="login-form">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <h1>Login</h1> 
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 right">
                   <div class="form-group">
                     <input type="email" class="form-control form-control-lg" placeholder="YourEmail@email.com" name="email" required="">
                   </div>
                   <div class="form-group">
                      <input type="password" class="form-control form-control-lg" placeholder="Your Password" name="password" required="">
                   </div>
                   <input type="submit" class="btn btn-secondary btn-block" value="Send" name="">
                   <a class="btn btn-block btn-login" href="<?= $base_url ?>">Go back to home page</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
    <?php 
    if(isset($facebook_login_url))
    {
     echo $facebook_login_url;
    }
    else
    {
     echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
     echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
     echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
     echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
     echo '<h3><a href="logout.php">Logout</h3></div>';
    }
    ?>
   </div>
  </div>
</div>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="assets/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src='assets/js/main.js'></script>

</body>
</html>