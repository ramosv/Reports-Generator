<?php

    // Connect to Bluehost database 
    function subscriber_database($dbname, $username, $password) {
        try {
            $port = 'localhost';
            $db_connect = "mysql:host=$port;dbname=$dbname";
            return new PDO($db_connect, $username, $password);
            #echo '<h1>Success 1: Connect to database</h1>';
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }

    // Add a new record
    function add_subscriber($db, $name, $email) {
        try {
            $query = "INSERT INTO subscribers (name, email) VALUES (:name, :email);";
            $statement = $db->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }


    // Delete Database Record
    function delete_subscriber($db, $email) {
        try {
            $query = "DELETE from subscribers WHERE email = :email";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
    }


    // Lookup Record using ID
    function get_subscriber($db, $id) {
        try {
            $query = "SELECT * FROM subscribers WHERE id = :id";
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
       

    // Query for all subscribers
    function list_subscribers ($db) {
       try {
            $query = "SELECT * FROM subscribers";
            $statement = $db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Error: $error_message</p>";
            die();
        }
        
    }


    // Create a database connection
    $dbname = 'test';
    $username = 'root';
    $password = '';
    $db = subscriber_database($dbname, $username, $password);

?>
