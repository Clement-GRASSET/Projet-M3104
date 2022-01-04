<header>

    <a href="#" class="logo">Li <span>Logement</span></a>

    <nav class="navbar">
        <a href="#home">Accueil</a>
        <a href="#services">Carte</a>
        <a href="#featured">Liste des Logements</a>
        <a href="#contact">contact</a>
    </nav>

    <div class="icons">
        <div id="menu-bars" class="fas fa-bars"></div>
        <?php
        if ($isLoggedIn){
            echo'<a href="'.base_url("/account/homes").'"><i class="fas fa-user"></i> '.$user['U_pseudo'].'</a>';

            if ($user['U_admin']){
                echo'<a href="'.base_url("/admin/users").'"><i class="fas fa-tools"></i> Admin</a>';
            }

            echo'<a href="'.base_url("/logout").'"><i class="fas fa-sign-out-alt"></i></a>';
        }
        else{
            echo'<a href="'.base_url("/login").'"><i class="fas fa-user"></i> Invité</a>';
        }
        ?>

    </div>

</header>
