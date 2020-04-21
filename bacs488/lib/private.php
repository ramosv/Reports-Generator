<?php
    
    require_once 'log.php';
    require_once 'views.php';
    require_once 'auth.php';
    //require_once 'note.php';
    //require_once 'db.php';
    require_once 'administrators_views.php';


    // Log the page load
    log_page();
    //$list = render_administrators(list_administrators ($db));

    $users = handle_administrator_actions();
    #$user  = handle_auth_actions();


    // Check on login
    $login = handle_auth_actions();
    if (empty($login)) {
        require_login('private.php');
        // Display the page content
        #$content = render_button('Other Demos', '..');
        #$content .= render_button('Show Log', 'pagelog.php');
        $content = '';
        #$content .= "$list";
        
    }
    else {
        $content = $login;
    }


    // Dynamic UI
    

    // Create main part of page content
    $settings = array(
        "site_title" => "MERG",
        "page_title" => "Private Page", 
        "logo"       => "Bear.png",
        "style"      => 'style.css',
        'user'       => user_info(),
        "content"    => $content . $users);

    echo render_page($settings);
?>
