<h1>Passing Data in the URL</h1>

<h2>Sender</h2>
<ul>
    <li><a href="index.php">Welcome no one</a></li>
    <li><a href="index.php?name=Mark.Seaman">Welcome Mark</a></li>
    <li><a href="index.php?name=Supervillain">Welcome Supervillain</a></li>
</ul>

<h2>Reciever</h2>
<?php

    // Extract the name from the URL
    $name = filter_input(INPUT_GET, 'name');
    if (!$name) {
        $name = 'No Name';
    }


    // Show the result
    echo "Welcome back, $name";

?>
