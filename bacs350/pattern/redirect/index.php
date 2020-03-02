<?php

    /*
        Redirect automatically to a different page.
    */

    $site_title = 'UNC BACS 350';

    $page_title = "Redirect Page";

    $content = '
        <p>
            <a href="js-redirect.html">Try Out Redirect Page</a>
        </p>
    ';

    include '../../views.php';

    echo render_page($site_title, $page_title, $content);

?>
