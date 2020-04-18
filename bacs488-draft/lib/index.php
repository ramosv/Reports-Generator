<?php
    
    //require_once 'log.php';
    require_once 'views.php';
    require_once 'auth.php';
    //require_once 'note.php';
    //require_once 'private.php';
    //require_once 'users_views.php';


    // Log the page load
    // log_page();


    // Display the page content

    // Dynamic UI
    //$notes = handle_notes_actions();


    // Text
    $text = '
    <h2>Index Page</h2>
    <p>
        This is our index page and it has no purpose thus far.
    </p>
    ';
    

    // Create main part of page content
    $settings = array(
        "site_title" => "MERG",
        "page_title" => "Private Page", 
        'user'       => user_info(),
        "content"    => $text);

    echo render_page($settings);

?>
