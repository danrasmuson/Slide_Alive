<?php
/*
* SlideAlive - Automatic Presentation Generation Software
* --------------
* login/response.php - Renders a human readable login response.
* Created by William Teder using PHPstorm on 7/21/14 at 9:19 AM.
*/


class loginResponse {
    function fail($reason) {
        echo '<div class="container">';
        echo '<h1 class="roboto">Account activation failed.</h1>';
        echo '<h2 class="roboto">'.$reason.'</h2>';
        echo '</div>';
    }

    function succeed() {
        echo '<div class="container">';
        echo '<h1 class="roboto">You are now registered!</h1>';
        echo '<h2 class="roboto">We\'re exporting your presentation now, you\'ll get an email as soon as it\'s finished. Thanks for using SlideAlive!</h2>';
        echo '</div>';
    }
} 