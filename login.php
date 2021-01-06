 <?php 
include_once 'helpers/init.php'; 
include_once('config.php');

require 'vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
 'app_id'      => '424014284369520',
  'app_secret'     => '73c3c39a1dc533e48101276d898adbe6',
  'default_graph_version'  => 'v2.10',
]);

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''){
  header("location:admin");
}

// $facebook_output = '';

// $facebook_helper = $facebook->getRedirectLoginHelper();

// if(isset($_GET['code']))
// {
//  if(isset($_SESSION['access_token']))
//  {
//   $access_token = $_SESSION['access_token'];
//  }
//  else
//  {
//   $access_token = $facebook_helper->getAccessToken();

//   $_SESSION['access_token'] = $access_token;

//   $facebook->setDefaultAccessToken($_SESSION['access_token']);
//  }

//  $_SESSION['user_id'] = '';
//  $_SESSION['user_name'] = '';
//  $_SESSION['user_email_address'] = '';
//  $_SESSION['user_image'] = '';

//  $graph_response = $facebook->get("/me?fields=name,email", $access_token);

//  $facebook_user_info = $graph_response->getGraphUser();

//  if(!empty($facebook_user_info['id']))
//  {
//   $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
//  }

//  if(!empty($facebook_user_info['name']))
//  {
//   $_SESSION['user_name'] = $facebook_user_info['name'];
//  }

//  if(!empty($facebook_user_info['email']))
//  {
//   $_SESSION['user_email_address'] = $facebook_user_info['email'];
//  }
 
// }
// else
// {
//  // Get login url
//     $facebook_permissions = ['email']; // Optional permissions

//     $facebook_login_url = $facebook_helper->getLoginUrl($base_url.'/login.php', $facebook_permissions);
    
//     // Render Facebook login button
//     $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
// }


$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
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
header('Location: profile.php');
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
$loginUrl = $helper->getLoginUrl('https://phpstack-21306-56790-161818.cloudwaysapps.com', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
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