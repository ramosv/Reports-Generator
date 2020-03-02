<?php

    // Bring in the Markdown library
    require_once 'Parsedown.php';
    require_once 'views.php';


    // Read Markdown Text from file
    $path = "markdown.md";
    $markdown = file_get_contents($path);


    // Convert the Markdown into HTML
    $Parsedown = new Parsedown();
    $content = $Parsedown->text($markdown);


    // Display the HTML in the page
//    echo $content;
    echo render_page('UNC BACS 350', "Markdown Document", $content);
?>
