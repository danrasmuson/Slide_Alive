<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a SlideAlive Presentation</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css\create.css">
    <script type="text/javascript" src="js/textArea.js"></script>
    <script src="js/bootstrap.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="content" class="row">
        <div class="col-md-8 col-md-offset-2">
            <table>
                <tr>
                    <td id="greyBackground" onkeyup="textAreaAdjust(this)">
                        <div id="logo"><img src="img/logoPNG.png" alt=""></div>
                        <div id="nullBox"></div>
                    </td>

                    <td width="100%">
                        <form class="form-inline" method="get" action="http://sa.lbsg.net/api.php">
                            <textarea onkeyup="textAreaAdjust(this)" name="input" style="overflow:hidden; width: 100%;" placeholder="Enter Text for the Slidshow"></textarea>
                            <input type="submit" value="done" class="button">
                        </form>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>