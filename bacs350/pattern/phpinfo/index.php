<?php

    /*
        Display PHP Information about Web Server
    */


    $page_title = "Display PHP Information";

    $site_title = 'UNC BACS 350';

    $content = '
        <p>
            Display PHP Information about Web Server
        </p>
        <ul>
            <li>
                <a href="..">Other Design Patterns</a>
            </li>
            <li>
                <a href="info.php">Display PHP and Web Server Information</a>
            </li>
        </ul>
    ';

    include '../../views.php';

    echo render_page($site_title, $page_title, $content);

?>
