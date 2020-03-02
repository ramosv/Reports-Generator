<?php

    /*
        Create page content by rendering a template.
    */

    $site_title = 'UNC BACS 350';
    
    $page_title = 'Render Page Design Pattern';
    
    $content = '
        <p> 
            This page is a demonstration of the pattern in use.
        </p>
        <p> 
            Create a reusable HTML template that contains custom data.
        </p>
        <p> 
            Define the custom data as variables and include the template.
        </p>
        <p> 
            Call a function that returns HTML with the custom data passed as parameters.
        </p>
    ';

    include 'views.php';
    
    echo render_page($site_title, $page_title, $content);

?>
