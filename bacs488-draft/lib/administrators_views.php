<?php

    require_once 'auth.php';
    require_once 'views.php';
    require_once 'db.php';
    require_once 'private.php';

    



    function get_administrators($id) {
        global $db;
        try {
            $query = "SELECT * FROM users WHERE UserID  = :UserID";
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $UserID);
            $statement->execute();
            $record = $statement->fetch();
            $statement->closeCursor();
            return $record;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
       
    }
       

    // Query for all superheros
    function list_administrator() {
        global $db;
       try {
            $query = "SELECT * FROM users";
            $statement = $db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }


    // Delete Database Record
    function delete_administrator() {        
        $UserID = filter_input(INPUT_POST, 'USER');
        if (!empty($UserID)) {
            try {
                $query = "DELETE from users WHERE UserID  = :UserID";
                global $db;
                $statement = $db->prepare($query);
                $statement->bindValue(':UserID', $UserID);
                $statement->execute();
                $statement->closeCursor();
                return true;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Error: $error_message</p>";
                die();
            }
        }
    }
    function update_administrator () {
        global $db;

        // Pick out the inputs
        $UserID = filter_input(INPUT_POST, 'USER');
        $Email = filter_input(INPUT_POST, 'Email');
        $InnName = filter_input(INPUT_POST, 'InnName');
        $UserTypeID = filter_input(INPUT_POST, 'UserTypeID');

        if (!empty($UserID) && !empty($Email) && !empty($InnName) && !empty($UserTypeID)) {

            try {
                // Modify database row
                $query = "UPDATE users SET Email=:Email, InnName=:InnName, UserTypeID=:UserTypeID WHERE UserID  = :UserID";
                $statement = $db->prepare($query);

                $statement->bindValue(':UserID', $UserID);
                $statement->bindValue(':Email', $Email);
                $statement->bindValue(':InnName', $InnName);
                $statement->bindValue(':UserTypeID', $UserTypeID);

                $statement->execute();
                $statement->closeCursor();

                log_event('administrator UPDATE');                     // UPDATE
                return true;
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo "<p>Error: $error_message</p>";
                die();
            }
        }
    }

    require_once 'views.php';
    #require_once 'db.php';


    // Create an HTML list on the output
    function render_administrators($users) {
        $html = '';
        foreach($users as $row) {
            $title = $row['Email'];
            $delete = "<a href='delete.php?id=$row[id]'>Delete Record</a>";
            $update = "<a href='delete.php?id=$row[id]'>Deletes for now</a>";
            $body = "
                <table class='table table-hover'>
                    <tr><td>Email:</td><td>$row[Email]</td></tr>
                    <tr><td>InnName:</td><td>$row[InnName]</td></tr>
                    <tr><td>Delete for now:</td><td>$update</td></tr>
                    <tr><td>Record $row[id]</td><td>$delete</td></tr>
                </table>";
            $html = $html . render_card($title, $body);
        }
        return $html;
    }
    /* ---------------------------
                V I E W
     --------------------------- */

    // Create an HTML list on the output
    function administrators_list_view($users) {
        $html = '';
        $html = '<h2>Editing Page (UC-3)</h2>
        <p>
        Add a New User
        </p>
        <p><a href="private.php?action=signup" class="button">Add User</a></p>';
        foreach($users as $row) {
            $html .= render_template('administrator.html', $row);
        }
        return $html;
    }


    // add_note_form -- Create an HTML form to add record.
    function add_administrator_view() {
        log_event('Note Add View');                   // Add View
        $page = $_SERVER['PHP_SELF'];
        require_login ($page);        
        return render_template('sign_up.html', array());
    }


    // Show form for adding a record
    function edit_administrator_view($record) {
        log_event('Note Edit View');                  // Edit View
        $page = $_SERVER['PHP_SELF'];
        require_login ($page); 
        return render_template('administrator_edit.html', $record);
    }


    // Show form for adding a record
    function delete_adminstrator_view($record) {
        log_event('Note Edit View');                  // Edit View
        $page = $_SERVER['PHP_SELF'];
        require_login ($page); 
        return render_template('administrator_delete.html', $record);
    }


    /* ---------------------------
         C O N T R O L L E R
     --------------------------- */

    // Handle all action verbs
    function handle_administrator_actions() {

        // POST
        $action = filter_input(INPUT_POST, 'action');
        if ($action == 'create') {
            if (register_user()) {
                header('Location: private.php');
            }
        }
        if ($action == 'update') {
            if (update_administrator()) {
                header('Location: private.php');
            }
        }
        if ($action == 'delete') {
            if (delete_administrator()) {
                header('Location: private.php');
            }
        }

        // GET
        $action = filter_input(INPUT_GET, 'action');
        if (empty($action)) {
            $list = list_administrator();
            return administrators_list_view($list);
        }
        if ($action == 'add') {
            return add_administrator_view();
        }
        if ($action == 'remove') {
            $UserID = filter_input(INPUT_GET, 'UserID');
            if (! empty($UserID)) {
                return delete_adminstrator_view(get_administrators($UserID));
            }
        }
        if ($action == 'edit') {
            $UserID = filter_input(INPUT_GET, 'UserID');
            if (! empty($UUserID)) {
                return edit_administrator_view(get_administrators($UserID));
            }
        }
    }
    
?>
