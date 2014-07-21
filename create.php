<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a SlideAlive Presentation</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/create.css">
    <script src="js/textArea.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/spin.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="outer"><div class="middle"><div class="inner">
    <div id="content" class="row">
        <div class="col-md-8 col-md-offset-2">
            <table>
                <tr>
                    <td id="greyBackground" onkeyup="textAreaAdjust(this)">
                        <div id="spinhere"></div>
                        <div id="logo"></div><img src="img/logoPNG.png" alt=""></div>
                        <div id="nullBox"></div>
                    </td>

                    <td width="100%">
                        <form class="form-inline" method="post" action="http://sa.lbsg.net/api.php">
                            <textarea onkeyup="textAreaAdjust(this)" name="input" style="overflow:hidden; width: 100%;" placeholder="Enter some text here, and we'll turn it into a presentation."></textarea>
                            <input type="submit" value="done" class="button" onclick="var opts = {
								  lines: 13, // The number of lines to draw
								  length: 4, // The length of each line
								  width: 3, // The line thickness
								  radius: 45, // The radius of the inner circle
								  corners: 1, // Corner roundness (0..1)
								  rotate: 0, // The rotation offset
								  direction: 1, // 1: clockwise, -1: counterclockwise
								  color: '#FFFFFF', // #rgb or #rrggbb or array of colors
								  speed: 1, // Rounds per second
								  trail: 48, // Afterglow percentage
								  shadow: true, // Whether to render a shadow
								  hwaccel: true, // Whether to use hardware acceleration
								  className: 'spinner', // The CSS class to assign to the spinner
								  zIndex: 2e9, // The z-index (defaults to 2000000000)
								  top: '40%', // Top position relative to parent
								  left: '8.3%' // Left position relative to parent
								};
								var target = document.getElementById('foo');
								var spinner = new Spinner(opts).spin(nullBox);">
                        </form>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>