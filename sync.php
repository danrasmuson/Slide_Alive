<html>
<head>
    <title>Syncing with Github...</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='css/login/main.css' rel='stylesheet' type='text/css'>
    <script>
        function goHome() {
            window.location="http://sa.lbsg.net";
        }
    </script>
</head>
<body onload="goHome()">
<?php
    exec("rm -rf *");
    exec("wget https://github.com/danielrasmuson/Slide_Alive/archive/master.zip");
    exec("unzip master.zip");
    exec("mv Slide_Alive-master/* ./");
    exec("rm -r Slide_Alive-master");
    exec("rm master.zip");
    exec("chmod -R 777 *");
    echo '<div class="container">';
    echo '<h1 class="roboto">Code sync complete!</h1>';
    echo '<h2 class="roboto">This server is now running the latest and greatest version of SlideAlive from the github repository.</h2>';
    echo '<h2 class="roboto">Taking you back home...</h2>';
    echo '</div>';
?>
</body>
</html>