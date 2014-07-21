<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a SlideAlive Presentation</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css\review.css">
</head>

<body ng-app>
<div ng-controller="TodoCtrl">
    <div id="signIn">
        <div class="row">
            <div id="forms">
                <form class="form-signin" action="processLogin.php?action=login" method="post" role="form" _lpchecked="1" style="padding-top: 5px;">
                    <h2 class="form-signin-heading">sign in</h2>
                    <input type="email" class="form-control" placeholder="email address" required="" name="email" autofocus="" autocomplete="off">
                    <input type="password" class="form-control" placeholder="password" required="" name="password" autocomplete="off">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">download</button>
                </form>
                <form class="form-signin" action="processLogin.php?action=register" method="post" role="form" _lpchecked="1">
                    <h2 class="form-signin-heading">sign up</h2>
                    <input type="email" class="form-control" placeholder="email address" name="email" required="" autofocus="" autocomplete="off">
                    <input type="password" class="form-control" placeholder="password" name="password" required="" autocomplete="off">
                    <br>
                </form>
            </div>
            <div id="download">
                <button class="btn btn-lg btn-primary btn-block" type="submit">download</button>
            </div>
        </div>
    </div>
        <div class="container" ng-repeat="slide in slides">
            <div class="row">
                <div class="col-md-12">
                    <span class="slideTitle">change slide {{slide.number}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span class="sentance" ng-bind-html="renderHtml(slide.sentance)"></span>
                </div>
            </div>
            <div class="row">
                <div ng-repeat="image in backup[slide.number]" class="col-md-4">
                    <span ng-class="{dark: image !== slide.image}" ng-click="slide.image = image"><img src="{{image}}" alt=""></span>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.10/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.10/angular-sanitize.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
  
        function TodoCtrl($scope, $sce) {
            $scope.slides = <?php
					require_once('flickr.php');
					require_once('decode.php');
					$required_parameters = array('input');
					foreach($required_parameters as $param) {
						if(!isset($_POST[$param])) {
							echo 'Was expecting a parameter of "'.$param.'", which was not set.';
							die();
						}
					}
					$inputText = $_POST['input'];
					decodeText();
					foreach($output1 as $line) {
						echo $line;
					}
				?>;
				console.log($scope.slides);
			$scope.backup = {};
				<?php
					foreach($output2 as $line) {
						echo $line."\n";
					}
				?>
				console.log($scope.backup);
            $scope.download = function(){
                var urlArray = [];
				var sentenceArray = [];
                for (var i = 0; i < $scope.slides.length; i++){
                    urlArray.push($scope.slides[i].image);
					sentenceArray.push($scope.slides[i].sentance);
                }
                window.location = "http://sa.lbsg.net/doConvert.php?args=" + JSON.stringify(urlArray) + "&sentences=" + JSON.stringify(sentenceArray);
            }
			$scope.renderHtml = function(htmlCode) {
			  return $sce.trustAsHtml(htmlCode);
			};
        } 
    </script>
	
</html>