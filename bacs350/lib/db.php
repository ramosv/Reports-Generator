<?php

/*
    General database connection.  This design works for either local or remote
    database connections.  It automatically determines which is needed at
    execution time.

    Usage:
        require_once 'db.php';
        $db can be used for CRUD operations
*/

/* -------------------------------
        CRUD OPERATIONS
    ------------------------------- */

    // Add a new record
    function add_administrator($db, $email, $password, $firstName, $lastName) {
        try {
            $query = "INSERT INTO administrators (email, password, firstName, lastName) 
                      VALUES (:email, :password, :firstName, :lastName);";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':fistName', $fistName);
            $statement->bindValue(':lastName', $lastName);
            $statement->execute();
            $statement->closeCursor();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            // die();
        }
    }


     // Lookup Record using ID
    function get_superhero($db, $id) {
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
    function list_administrators ($db) {
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
    function delete_administrator($db, $id) {
        try {
            $query = "DELETE from administrators WHERE id = :id";
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
    function edit_administrator () {
        global $db;

        // Pick out the inputs
        $id = filter_input(INPUT_POST, 'id');
        $email = filter_input(INPUT_POST, 'email');
        $fist = filter_input(INPUT_POST, 'fistName');
        $last = filter_input(INPUT_POST, 'lastName');

        if (!empty($id) && !empty($email) && !empty($fist) && !empty($last)) {

            try {
                // Modify database row
                $query = "UPDATE administrators SET email=:email, fistName=:fistName, lastName=:lastName WHERE id = :id";
                $statement = $db->prepare($query);

                $statement->bindValue(':id', $id);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':fistName', $first);
                $statement->bindValue(':lastName', $last);

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




    // Connect to the remote database
    function remote_connect() {
        // Set up .gitignore to prevent this file in git repo
        require_once 'secret_settings.php';

        $db_connect = "mysql:host=$host:$port;dbname=$dbname";
        return db_connect($db_connect, $username, $password);
    }


    // Local Host Database settings
    function local_connect() {
        $host = 'localhost';
        $dbname = 'bacs488';
        $username = 'root';
        $password = '';
        $db_connect = "mysql:host=$host;dbname=$dbname";
        return db_connect($db_connect, $username, $password);
    }


    // Open the database or die
    function db_connect($db_connect, $username, $password) {
        // Enable these echo statements to debug the connection.
          #echo "<h2>DB Connection</h2><p>Connect String:  $db_connect, $username, $password</p>";
        try {
            $db = new PDO($db_connect, $username, $password);
            #echo '<p><b>Successful Connection</b></p>';
            return $db;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }


    // Open the database or die
    function connect_database() {
        $local = ($_SERVER['SERVER_NAME'] == 'localhost');
        if ($local) {
            return local_connect();
        }
        else {
            return remote_connect();
        }
    }


    // Create a connection
    $db = connect_database();
?>
