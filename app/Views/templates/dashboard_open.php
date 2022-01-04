
<div class="Absolute-Center fond">
    <div class="dashbaord">

        <div class="links">

            <?php
            echo '<p class="title">'.$type.'</p>';
            foreach ($links as $link) {
                $active = substr( current_url(), 0, strlen(base_url($link['url'])) ) === base_url($link['url']);
                echo '<a class="link ' . (($active) ? 'active' : '') . '" href="' . base_url($link['url']) . '">' . $link['name'] . '</a>';

            }
            echo '<a class="link" href="" id="bottom"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>';
            ?>

        </div>

        <div class="content">

