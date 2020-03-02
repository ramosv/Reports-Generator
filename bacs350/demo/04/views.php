<?php

    /*
        begin_page -- Create the HTML for the beginning of a page.  Add a page title and headline.
    */

    function begin_page($site_title, $page_title) {

        echo '
            <!DOCTYPE html>
            <html lang="en">
                <head>

                    <meta charset="UTF-8">
                    <title>' . $page_title . '</title>

                    <link rel="stylesheet" href="style.css">

                </head>
                <body>

                    <header>
                        <img src="Bear.png" alt="Bear Logo"/>
                        <h1>' . $site_title . '</h1>
                        <h2>' . $page_title . '</h2>
                    </header>
                    <main>
        ';
    }


    /*
        end_page -- Create the HTML for the end of a page.
    */

    function end_page() {

        echo '
                    </main>
                </body>
            </html>
        ';

    }


    /*
        build a page
    */

    begin_page("UNC BACS 350", "Page Constructor Demo");

    echo "<p> This is the plugin content that goes into the page</p>";

    end_page();


?>