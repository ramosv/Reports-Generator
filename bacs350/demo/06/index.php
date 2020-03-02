<?php

    $page_title = 'Lesson 6 - Configure the web server';

    $site_title = 'UNC BACS 350';

    $content = '
        <p>
            Lesson 6 is about getting your local computer configured for PHP code development.
        </p>
        <ul>
            <li>
                <a href="https://shrinking-world.com/unc/bacs350/lesson/06">Lesson #6 - Setup Apache, MySQL, PHP</a>
            </li>
            <li>
                <a href="https://github.com/Mark-Seaman/UNC-BACS350-2019-Fall/tree/master/public_html/bacs350/demo/06">Github - Demo #6</a>
            </li>
            <li>
                <a href="info.php">Show PHP info</a>
            </li>
            <li>
                <a href="/">Server Root Page "/"</a>
            </li>
            <li>
                <a href="../../pattern">Design Patterns</a>
            </li>
            <li>
                <a href="..">Other Demos</a>
            </li>
            <li>
                <a href="../../project">My Projects</a>
            </li>
        </ul>
    ';

    include '../../views.php';

    echo render_page($site_title, $page_title, $content);

?>
