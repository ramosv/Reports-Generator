<?php
    
    require_once 'log.php';
    require_once 'views.php';
    require_once 'auth.php';
    #require_once 'db.php';
    require_once 'administrators_views.php';


    // Log the page load
    log_page();
    $list = render_administrators(list_administrators ($db));


    // Check on login
    $login = handle_auth_actions();
    if (empty($login)) {
        require_login('private.php');
        // Display the page content
        #$content = render_button('Other Demos', '..');
        #$content .= render_button('Show Log', 'pagelog.php');
        $content .= '<h2>Private Page</h2>
        <p>
            This solution demonstrates the use of authentication code.
            Visiting this page requires a login.
        </p>
        <p>
            This page shows a list of all administrators in the database
            
        </p>
        <p>
            <a href="index.php">Public Page</a>
        </p>';
        $content .= "$list";
        
    }
    else {
        $content = $login;
    }
    

    // Create main part of page content
    $settings = array(
        "site_title" => "Reports Generator",
        "page_title" => "Private Page (requires login)", 
        "logo"       => "Bear.png",
        "style"      => 'style.css',
        'user'       => user_info(),
        "content"    => $content);

    echo render_page($settings, $list);
?>
