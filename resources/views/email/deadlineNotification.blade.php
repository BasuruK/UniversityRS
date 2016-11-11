<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- jQuery 2.2.0 -->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <style>
        h1{
            background-color: slategray;
            color: white;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        body{
            background-color: lightgrey;
        }
        .colorwhite{
            background-color: whitesmoke;
        }
        h2{
            text-align: center;
        }
    </style>

</head>
<body>
    <div class="col-md-12">
        <h1>University<b>RS</b></h1>
    </div>
    <div class="col-md-12 colorwhite">
        <div class="col-md-12 center">
            <h2>Deadline Reminder !</h2>
            <hr>
        </div>

        <div class="col-md-4 col-md-offset-4">
            <p>This is to notify that the final date for requesting time slots for semester {{ $semester }} of Year {{ $year }} is due on {{ $date }}</p>
            <hr>
        </div>
    </div>
</body>
</html>