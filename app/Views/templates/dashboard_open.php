<div class="Absolute-Center">

    <div class="dashbaord">

        <div class="links">
            <?php

            foreach ($links as $link) {
                $active = substr( current_url(), 0, strlen(base_url($link['url'])) ) === base_url($link['url']);
                echo '<a class="link ' . (($active) ? 'active' : '') . '" href="' . base_url($link['url']) . '">' . $link['name'] . '</a>';
            }

            ?>
        </div>

        <div class="content">