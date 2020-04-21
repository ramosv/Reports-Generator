<?php
    
    require_once 'log.php';
    require_once 'views.php';
    require_once 'auth.php';
    require_once 'note.php';
    require_once 'administrators_views.php';


    // Log the page load
    log_page();


    // Display the page content
    $buttonbar = '<div><p>' . 
        #render_button('Other Demos', '..') .
        #render_button('Show Log', 'pagelog.php') .
        render_button('Add Note', 'index.php?action=add') . 
        '</p></div>';


    // Dynamic UI
    $notes = handle_notes_actions();
    $user  = handle_auth_actions();


    // Text
    $text = '
    <h2>Update User Page (UC-5)</h2>
    <p>
        This solution demonstrates the notes application with 
        both the MVC design pattern and  authentication code.
    </p>
    ';
    

    // Create main part of page content
    $settings = array(
        "site_title" => "MERG",
        "page_title" => "Private Page", 
        'user'       => user_info(),
        "content"    => $text . $buttonbar . $notes . $user);

    echo render_page($settings);

?>
