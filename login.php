<?php 
include_once 'helpers/init.php'; 
include_once('config.php');

if((isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') || $_SESSION['fb_id']){
  header("location:admin");
}

$fb = $facebook;
$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];
$permissions = ['email']; // optional
$loginUrl = '';
try {
if (isset($_SESSION['facebook_access_token'])) {
$accessToken = $_SESSION['facebook_access_token'];
} else {
  $accessToken = $helper->getAccessToken();
}
} catch(Facebook\Exceptions\facebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
if (isset($accessToken)) {
if (isset($_SESSION['facebook_access_token'])) {
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
} else {
// getting short-lived access token
$_SESSION['facebook_access_token'] = (string) $accessToken;
  // OAuth 2.0 client handler
$oAuth2Client = $fb->getOAuth2Client();
// Exchanges a short-lived access token for a long-lived one
$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
// setting default access token to be used in script
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
}
// redirect the user to the profile page if it has "code" GET variable
if (isset($_GET['code'])) {
//echo "<pre>"; print_r($_SESSION); exit;
  //header("location:admin");
 // echo "<pre>"; print_r($_SESSION); exit;
}
// getting basic info about user
try {
$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
$requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
$picture = $requestPicture->getGraphUser();
$profile = $profile_request->getGraphUser();
$fbid = $profile->getProperty('id');           // To Get Facebook ID
$fbfullname = $profile->getProperty('name');   // To Get Facebook full name
$fbemail = $profile->getProperty('email');    //  To Get Facebook email
$fbpic = "<img src='".$picture['url']."' class='img-rounded'/>";
# save the user nformation in session variable
$_SESSION['fb_id'] = $fbid.'</br>';
$_SESSION['fb_name'] = $fbfullname.'</br>';
$_SESSION['fb_email'] = $fbemail.'</br>';
$_SESSION['fb_pic'] = $fbpic.'</br>';
} catch(Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
session_destroy();
// redirecting user back to app login page
header("Location: ./");
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}
} else {
// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
$loginUrl = $helper->getLoginUrl($base_url.'/login.php', $permissions);
}

echo "<pre>"; print_r($_SESSION); exit;
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
                   <?php if($loginUrl){ ?>
                      <a class="btn btn-block btn-login" href="<?= $loginUrl ?>">Log in with Facebook!</a>
                   <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="assets/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src='assets/js/main.js'></script>

</body>
</html>