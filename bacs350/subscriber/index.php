<?php

    // Code to define functions
    require_once 'views.php';
    require_once 'subscriber_views.php';
    require_once 'subscriber_db.php';


    // List subscriber records
    $list = render_subscribers(list_subscribers ($db));

    
    // Button to go to other views
    $add_button = '<a href="insert.php">Add Subscriber</a>';

    
    $intro = '
        <p>
            This email list gives you access to big ideas and deep thoughts.
        </p>
        <p>
            Visit the <a href="https://seamanslog.com">Seaman\'s Log</a> site now to start reading.
        </p>
    ';
    $content = "$intro $list $add_button";

    // Show the page
    echo render_page('UNC BACS 350', "Seaman's List Subscribers", $content);
?>
