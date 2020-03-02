<?php

    /*
        Render a Card View within a Page
    */

    include 'views.php';

    $page_title = "Card View Pattern";
    $site_title = 'UNC BACS 350';

    $card1 = render_card("CARD 1", "Body Text 1");
    $card2 = render_card("CARD 2", "Body Text 2");

    $content =  '
        <div class="container-fluid">
            <div class="row">

                ' . $card1 . $card2 . '

            </div>
        </div>
    ';

    echo render_page($site_title, $page_title, $content);

?>