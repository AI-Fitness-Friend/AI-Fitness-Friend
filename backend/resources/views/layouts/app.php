<?php $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32)) ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>AI Fitness Friend</title>

    <!-- FAVICON-->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.ico">

    <meta charset="utf-8" />

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/css/app.css" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/notosanskr.css">
    <script type="text/javascript" src="/js/eon-chart.js"></script>
    <script type="text/javascript" src="https://pubnub.github.io/eon/v/eon/1.0.0/eon.js"></script>
    <link type="text/css" rel="stylesheet" href="https://pubnub.github.io/eon/v/eon/1.0.0/eon.css"/>
    
</head>

<body class="no-sidebar is-preload">
    <div id="page-wrapper">
        <div id="header">
            <section class="col-4 col-12-mobile">
                <header>
                    <h2 class="icon solid fa-dumbbell circled"><h1><?=ucfirst($view)?></h1></h2>
                </header>
            </section>

            <nav id="nav">		
                <ul>
                    <li><a href="/record">My Records</a></li>
                    <li><a href="/"><strong>Workout</strong></a></li>
                    <li><a href="/setting">Setting</a></li>
                    <li><a href="/contact"><strong>Contact</strong></a></li>
                </ul>
            </nav>
        </div>

		<?php require_once dirname(__DIR__, 1) . '/' . $view . '.php' ?>
    </div>


</body>
</html>
