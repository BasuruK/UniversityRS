 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>University Resource Sheduler</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
      
      body
      {
        min-height:100vh;
               /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#53595e+0,28343b+67 */
        background: #53595e; /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover,  #53595e 0%, #28343b 67%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  #53595e 0%,#28343b 67%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  #53595e 0%,#28343b 67%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#53595e', endColorstr='#28343b',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

      }
        body {
            font-family: 'Lato';
            
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
<br><br><br><br><br>
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
