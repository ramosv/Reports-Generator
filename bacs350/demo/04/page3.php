<?php

    /*
        Create page content with PHP echo statement.
    */

    $site_title = 'UNC BACS 350';
    $page_title = 'Page Constructor Demo - Step 3';
    $content = '<p> This is the plugin content that goes into the page</p>';

    echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>

                <meta charset="UTF-8">
                <title>' . $page_title . '</title>

                <link rel="icon" type="image/x-icon" href="http://shrinking-world.com/static/images/unc/favicon.ico">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://shrinking-world.com/static/css/unc.css">

            </head>
            <body>

                <header>

                    <img src="Bear.png" alt="Bear Logo"/>
                    <h1>' . $site_title . '</h1>
                    <h2>' . $page_title . '</h2>

                </header>
                <main>

                    ' . $content . '

                </main>
            </body>
        </html>
    ';

?>

