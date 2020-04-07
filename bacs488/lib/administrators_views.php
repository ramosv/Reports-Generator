<?php

    require_once 'auth.php';
    require_once 'views.php';
    require_once 'private.php';
    require_once 'db.php';


    function get_administrators($id) {
        global $db;
        try {
            $query = "SELECT * FROM administrators WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
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
    function list_administrators () {
        global $db;
       try {
            $query = "SELECT * FROM administrators";
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
        $id = filter_input(INPUT_POST, 'id');
        if (!empty($id)) {
            try {
                $query = "DELETE from administrators WHERE id = :id";
                global $db;
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id);
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
        $id = filter_input(INPUT_POST, 'id');
        $email = filter_input(INPUT_POST, 'email');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');

        if (!empty($id) && !empty($email) && !empty($firstName) && !empty($lastName)) {

            try {
                // Modify database row
                $query = "UPDATE administrators SET email=:email, firstName=:firstName, lastName=:lastName WHERE id = :id";
                $statement = $db->prepare($query);

                $statement->bindValue(':id', $id);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':firstName', $firstName);
                $statement->bindValue(':lastName', $lastName);

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
    function render_administrators($administrators) {
        $html = '';
        foreach($administrators as $row) {
            $title = $row['email'];
            $delete = "<a href='delete.php?id=$row[id]'>Delete Record</a>";
            $update = "<a href='delete.php?id=$row[id]'>Deletes for now</a>";
            $body = "
                <table class='table table-hover'>
                    <tr><td>Email:</td><td>$row[email]</td></tr>
                    <tr><td>First:</td><td>$row[firstName]</td></tr>
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
    function administrators_list_view($administrators) {
        $html = '';
        foreach($administrators as $row) {
            $html .= render_template('administrator.html', $row);
        }
        return $html;
    }


    // add_note_form -- Create an HTML form to add record.
    function add_administrator_view($administrators) {
        log_event('Note Add View');                   // Add View
        $page = $_SERVER['PHP_SELF'];
        require_login ($page);        
        return render_template('administrator_add.html', array());
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
            if (add_administrator()) {
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
            $list = list_administrators();
            return administrators_list_view($list);
        }
        if ($action == 'add') {
            return add_administrator_view();
        }
        if ($action == 'remove') {
            $id = filter_input(INPUT_GET, 'id');
            if (! empty($id)) {
                return delete_adminstrator_view(get_administrators($id));
            }
        }
        if ($action == 'edit') {
            $id = filter_input(INPUT_GET, 'id');
            if (! empty($id)) {
                return edit_administrator_view(get_administrators($id));
            }
        }
    }
    
?>
