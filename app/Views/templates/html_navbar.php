<header>

    <a href="<?= base_url("/") ?>" class="logo">Li <span>Logement</span></a>

    <nav class="navbar">
        <a href="<?= base_url("/") ?>">Accueil</a>
        <a href="<?= base_url("/homes") ?>">Liste des Logements</a>
    </nav>

    <div class="icons">
        <div id="menu-bars" class="fas fa-bars"></div>
        <?php
        if ($isLoggedIn){
            echo'<a href="'.base_url("/account").'"><i class="fas fa-user"></i> '.$loggedUser['U_pseudo'].'</a>';

            if ($loggedUser['U_admin']){
                echo'<a href="'.base_url("/admin").'"><i class="fas fa-tools"></i> Admin</a>';
            }

            echo'<a href="'.base_url("/logout").'"><i class="fas fa-sign-out-alt"></i></a>';
        }
        else{
            echo'<a href="'.base_url("/login").'"><i class="fas fa-user"></i> Invité</a>';
        }
        ?>

    </div>

</header>
