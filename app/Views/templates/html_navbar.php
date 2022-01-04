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
        <a href="#" class="fas fa-heart"></a>
        <?php
        if ($isLoggedIn){
            echo'<a href="'.base_url("/account/homes").'" class="fas fa-user"> '.$user['U_pseudo'].'</a>';
            echo'<a href="'.base_url("/logout").'" class="fas fa-sign-out-alt"></a>';

            if ($user['U_admin']){
                echo'<a href="'.base_url("/admin/users").'" class="fas fa-tools"> Admin</a>';
            }
        }
        else{
            echo'<a href="'.base_url("/login").'" class="fas fa-user"> Invité</a>';
        }
        ?>

    </div>


</header>
