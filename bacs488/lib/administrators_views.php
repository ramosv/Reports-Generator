<?php

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
    
?>
