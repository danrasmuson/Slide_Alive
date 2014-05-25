<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.ico">

    <title>Results</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="grid.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <style>
	.chkcontainer { position: relative; width: 300px; float: left; margin-left: 10px; }
	.checkbox { position: absolute; bottom: 0px; right: 0px; }
	body {
		background:#6699FF !important;
	}
  </style>
  <body bgcolor="#6699FF">
    <div class="container">

      <div class="page-header">
        <h1>Here's what we found!</h1>
      </div>
	    <div class="row">
		  <?php
			function main() {
				global $inputText, $wordData;
				$required_parameters = array('input');
				foreach($required_parameters as $param) {
					if(!isset($_POST[$param])) {
						echo 'Was expecting a parameter of "'.$param.'", which was not set.';
						die();
					}
				}
				$inputText = $_POST['input'];
				decodeText();
			}
		?>
	</div>
</body>
</html>