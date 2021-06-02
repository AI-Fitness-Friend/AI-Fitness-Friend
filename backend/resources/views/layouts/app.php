<?php $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32)) ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>AI Fitness Friend</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="/css/app.css" />
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
