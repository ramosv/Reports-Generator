<?php

    /*
        Set variables and use them.
    */

    $site_title = 'UNC BACS 350';
    $page_title = 'Page Constructor Demo - Step 2';
    $content = '<p> This is the plugin content that goes into the page</p>';
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <title><?php echo $site_title; ?></title>

        <link rel="icon" type="image/x-icon" href="http://shrinking-world.com/static/images/unc/favicon.ico">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://shrinking-world.com/static/css/unc.css">

    </head>
    <body>

        <header>

            <img src="Bear.png" alt="Bear Logo"/>
            <h1><?php echo $site_title; ?></h1>
            <h2><?php echo $page_title; ?></h2>

        </header>
        <main>

            <?php echo $content; ?>

        </main>
    </body>
</html>