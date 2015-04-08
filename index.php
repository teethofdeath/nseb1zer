<?php

session_start();

require "vendor/autoload.php";

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

const APPID = "662050003940490";
const APPSECRET = "157067a54d1cf720aa4a524b04f55eb3";

FacebookSession::setDefaultApplication(APPID, APPSECRET);

$helper = new FacebookRedirectLoginHelper('https://localhost');
$loginUrl = $helper->getLoginUrl();
$session = $helper->getSessionFromRedirect();

?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <title></title>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '<?php echo APPID; ?>',
                xfbml: true,
                version: 'v2.3'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/fr_FR/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>
<body>

<div class="fb-like"
     data-share="true"
     data-width="450"
     data-show-faces="true">
</div>

<hr>

<?php
if (isset($session) && isset($_SESSION['fb_token'])) {
    $session = new FacebookSession($_SESSION['fb_token']);
} else {
    var_dump($session);
    var_dump($_SESSION['fb_token']);
    ?>
    <a href="<?php echo $loginUrl; ?>">Se connecter</a>
    <?php
}
?>

</body>
</html>