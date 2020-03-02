<!doctype html>
<html lang="en">

<!--
    Demonstrate the Include Design Pattern
-->

<head>

    <meta charset="utf-8">
    <title>Include Design Pattern</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="http://shrinking-world.com/static/images/unc/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://shrinking-world.com/static/css/unc.css">

</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h1>UNC BACS 350</h1>
                    <h2>Include Design Pattern</h2>
                </div>
                <div class="logo col-sm-4">
                    <div class="pull-right">
                        <img class="img-rounded img-responsive" src="https://shrinking-world.com/static/images/unc/Bear.200.png" alt="UNC Bear" width="150px">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
        include 'template.html';
    ?>

    <footer>
        <a href="https://shrinking-world.com">
            <div class="logo-text">Copyright &copy; 2019 Shrinking World</div>
            <img class="img-rounded img-responsive" src="https://shrinking-world.com/static/images/SWS_Globe_small.jpg" alt="Shrinking World Solutions" width="150px">
        </a>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
