<?php

    // Bring in the Markdown library
    require_once 'Parsedown.php';


    // Read Markdown Text from file
    $path = "markdown.md";
    $markdown = file_get_contents($path);


    // Convert the Markdown into HTML
    $Parsedown = new Parsedown();
    $content = $Parsedown->text($markdown);


    // Display the HTML in the page
    echo $content;

?>
