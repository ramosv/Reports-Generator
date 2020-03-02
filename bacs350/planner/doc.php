<?php

    // Get the parameter off the URL
    // URL = http://localhost/bacs350/planner/doc.php?doc=ToDo.md
    // Doc = ToDo.md

    $doc = $_GET['doc'];
    $page = $_SERVER['REQUEST_URI'];
    $doc_label = "<div class=orange>Reading document  DOC: $doc. Loading page URL: $page.</div>";


    // Use the views code
    require_once 'views.php';


    // Read Markdown Text from file
    $content = render_markdown($doc);
    $panel = '<div class="panel">' . $content . '</div>';


    // Display the HTML in the page
    echo render_page('UNC BACS 350', "Project #4 - Project Design Review", $doc_label . $panel);

?>
