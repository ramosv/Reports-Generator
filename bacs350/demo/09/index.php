<h1>Format as HTML</h1>

<?php
    include "ReadMe.txt";
?>

<h1>Format as preformatted HTML</h1>

<pre>
    <?php
        include "ReadMe.txt";
    ?>
</pre>


<h1>Read File Contents </h1>

<pre>
    no text should appear here.
    <?php
        $text = file_get_contents ("ReadMe.txt");
    ?>
</pre>


<h1>Display File Contents </h1>
<pre>
    <?php
        $text = file_get_contents ("ReadMe.txt");
        echo $text;
    ?>
</pre>


<h1>Execute PHP Source Code</h1>

<?php
    include("ReadMe.php");
?>

<h1>Show PHP Source Code</h1>

<?php
    $text = file_get_contents("ReadMe.php");
    echo '<pre>' . htmlspecialchars($text) . '</pre>';
?>


<h1>Show PHP Source Code</h1>

<?php
    $text = "<h2>Cat in the Hat</h2>
        <ul>
            <li>Thing 1</li>
            <li>Thing 2</li>
        </ul>";
    echo '<pre>' . htmlspecialchars($text) . '</pre>';
?>