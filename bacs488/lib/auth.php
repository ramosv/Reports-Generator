<?php
 
/*
    API for Authentication
    
    usage: 
        require_once 'auth.php';    // Setup auth code
        user_info();                // Show the login info
        handle_auth_actions();      // Run the Auth Controller 
        
        Actions:
        
        GET - signup, login, logout
        POST - register, validate
        
*/

    require_once 'log.php';
    require_once 'db.php';


    session_start ();

    /* ---------------------------
             M O D E L
     --------------------------- */


    // Check to see that the Password in OK
    function is_valid_login ($Email, $Password) {
        $query = 'SELECT Password FROM Users WHERE Email = :Email';
        global $db;
        $statement = $db->prepare($query);
        $statement->bindValue(':Email', $Email);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = $row['Password'];
        //log_event("User login check: $Email, $hash");
        return password_verify($Password, $hash);
    }


    // Set the Password into the administrator table
    function register_user() {
        // Read form values
        $UserTypeID  = filter_input(INPUT_POST, 'UserTypeID');
        $InnName  = filter_input(INPUT_POST, 'InnName');
        $Password = filter_input(INPUT_POST, 'Password');
        $Email    = filter_input(INPUT_POST, 'Email');
        $ViewID     = filter_input(INPUT_POST, 'ViewID');
        
        //log_event("$Email, $InnName, $UserTypeID");
        $hash = password_hash($Password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO Users (UserID, UserTypeID, InnName, Password, ViewID, Email) 
            VALUES (NULL, :UserTypeID, :InnName, :Password, :ViewID, :Email);';
        
        global $db;
        $statement = $db->prepare($query);
        
        $statement->bindValue(':UserTypeID', $UserTypeID);
        $statement->bindValue(':InnName', $InnName);
        $statement->bindValue(':Password', $hash);
        $statement->bindValue(':Email', $Email);
        $statement->bindValue(':ViewID', $ViewID);
        
        $statement->execute();
        $statement->closeCursor();
    }


    /* ---------------------------
                V I E W
     --------------------------- */

    // Show the login
    function login_form($page) {
        log_event("Show Login Form");
        $settings = array('next' => $page);
        return render_template('login.html', $settings);
    }


     // Show the sign up
    function sign_up_form($page) {
        log_event("Show Sign Up Form");
        $settings = array('next' => $page);
        return render_template('sign_up.html', $settings);
    }


    // Show the logged in user
    function user_info() {
        if (logged_in ()) {
            return render_button("Logged in as $_SESSION[USER]", 'private.php?action=logout');
        }
        else {
            return render_button('Login', 'private.php?action=login');
}
    }

    
    // Test if password is valid or not
    function validate() {
        $Email    = filter_input(INPUT_POST, 'Email');
        $Password = filter_input(INPUT_POST, 'Password');    
        log_event("Validate: $Email, $Password");
        if (is_valid_login ($Email, $Password)) {
            $_SESSION['USER'] = $Email;
        }
    }


    /* ---------------------------
         C O N T R O L L E R
     --------------------------- */

   // Do a login if needed
    function require_login ($page){
        if (! logged_in ()) {
            header("Location: $page?action=login");
        }
    }


    // Check to see if user is already authenticated
    function logged_in () {
        log_event("logged_in: isset=" . isset($_SESSION['USER']));
        if (isset($_SESSION['USER'])) {
            log_event("logged_in: logged_in=" . $_SESSION['USER']);
        }
        return (isset($_SESSION['USER']) and ! empty($_SESSION['USER'])) ;
    }


    // Cancel the login
    function logout ($page) {
        unset($_SESSION['USER']);
        header("Location: $page");
    }


    // Controller for user authentication
    function handle_auth_actions() {   
        
        // POST
        $action = filter_input(INPUT_POST, 'action');
        if ($action == 'register') {
            return register_user();
        }
        if ($action == 'validate') {
            return validate();
        }

        // GET
        $action = filter_input(INPUT_GET, 'action');
        $page = $_SERVER['PHP_SELF'];
        
        if ($action == 'signup') {
            return sign_up_form($page);
        }
        if ($action == 'login') {
            return login_form($page);
        }
        if ($action == 'logout') {
            return logout($page . '?action=login');
        }
    }
  
?>
