<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a SlideAlive Presentation</title>

    <script src="js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.10/angular.min.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css\review.css">


    <script>
        function TodoCtrl($scope) {
            $scope.slides = [
                {sentance:'This is a pizza', number:"one", image:"http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg"},
                {sentance:'This is a dog', number:"two", image:"http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg"},
                {sentance:'This is a dog', number:"three", image:"http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg"}];
            $scope.backup = {};
            $scope.backup["one"] = ["http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg","http://www.nataliescoalfiredpizza.com/wp-content/uploads/2013/11/Slider-Pizza1.jpg","http://upload.wikimedia.org/wikipedia/commons/8/88/HotPizza.jpg"];
            $scope.backup["two"] = ["http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg","http://www.nataliescoalfiredpizza.com/wp-content/uploads/2013/11/Slider-Pizza1.jpg","http://upload.wikimedia.org/wikipedia/commons/8/88/HotPizza.jpg"];
            $scope.backup["three"] = ["http://www.aerogrils.ru/netcat_files/Image/pizza2.jpg","http://www.nataliescoalfiredpizza.com/wp-content/uploads/2013/11/Slider-Pizza1.jpg","http://upload.wikimedia.org/wikipedia/commons/8/88/HotPizza.jpg"];
            

            $scope.download = function(){
                var urlArray = [];
                for (var i = 0; i < $scope.slides.length; i++){
                    urlArray.push($scope.slides[i].image);
                }
                alert(urlArray);
            }
        } 
    </script>


</head>

<body ng-app>
<div ng-controller="TodoCtrl">
       <div id="signIn">
        <div class="row">
            <div id="forms">
                <form class="form-signin" role="form" _lpchecked="1" style="padding-top: 5px;">
                    <h2 class="form-signin-heading">sign in</h2>
                    <input type="email" class="form-control" placeholder="email address" required="" autofocus="" autocomplete="off">
                    <input type="password" class="form-control" placeholder="password" required="" autocomplete="off">
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" ng-click="download()" type="submit">download</button>
                </form>
                <form class="form-signin" role="form" _lpchecked="1">
                    <h2 class="form-signin-heading">sign up</h2>
                    <input type="name" class="form-control" placeholder="first name" required="" autofocus="" autocomplete="off">
                    <input type="name" class="form-control" placeholder="last name" required="" autofocus="" autocomplete="off">
                    <input type="email" class="form-control" placeholder="email address" required="" autofocus="" autocomplete="off">
                    <input type="password" class="form-control" placeholder="password" required="" autocomplete="off">
                    <br>
                </form>
            </div>
            <div id="download">
                <button class="btn btn-lg btn-primary btn-block" ng-click="download()" type="submit">download</button>
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
                    <span class="sentance">{{slide.sentance}}</span>
                </div>
            </div>
            <div class="row">
                <div ng-repeat="image in backup[slide.number]" class="col-md-4">
                    <span ng-class="{dark: image !== slide.image}" ng-click="slide.image = image"><img src={{image}} alt=""></span>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>
