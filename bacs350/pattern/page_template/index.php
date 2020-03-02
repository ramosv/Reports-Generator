<?php

    /*
        Create page content with a template.
    */

    $site_title = 'UNC BACS 350';
    
    $page_title = 'Page Template Design Pattern';
    
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
    ';

    include 'page_template.php';

?>
