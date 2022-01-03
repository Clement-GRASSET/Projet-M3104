<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Li Logement - Accueil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/accueil.css">

</head>
<body>
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

<section class="home" id="home">

    <form action="">

        <h3>Découvez votre Maison Parfaite</h3>
        <div class="inputBox">
            <input type="search" name="" placeholder="Ville" id="">
            <select name="" id="">
                <option value="" disabled hidden selected>Type de logement</option>
                <option value="Appartement">Appartement</option>
                <option value="Maison">Maison</option>
                <option value="Manoir">Manoir</option>
                <option value="Poubelle">Poubelle</option>
                <option value="Evan">Mere de Evan</option>
            </select>
        </div>

        <input type="submit" value="Rechercher" class="btn">

    </form>

</section>

<section class="featured" id="featured">

    <h1 class="heading">Nos <span>Annonces</span></h1>

    <div class="box-container">

        <?php
        foreach ($annonces as $annonce) {
            echo '<div class="box">
            <div class="image-container">
                <img src="' . '/images/homes/' . ((empty($annonce['A_photos'])) ? 'default.png' : $annonce['A_idannonce'].'/'.$annonce['A_photos'][0]['P_nom']) . '" alt="">
                ';
            if ($isLoggedIn) {
                if ($annonce['A_proprietaire'] == $user['U_mail']) {
                    echo '<div class="info"><h3>Votre annonce</h3></div>';
                }
            }

                echo '
                <div class="icons">
                    <a href="#" class="fas fa-camera"><h3>'. sizeof($annonce['A_photos']) .'</h3></a>
                </div>
            </div>
            <div class="content">
                <div class="price">
                    <h3>'.($annonce['A_cout_loyer']+$annonce['A_cout_charges']).'€ par mois TCC</h3>
                    <a href="#" class="fas fa-heart"></a>
                </div>
                <div class="location">
                    <h3>'.$annonce['A_titre'].'</h3>
                    <p>'.$annonce['A_description'].'</p>
                </div>
                <div class="details">
                    <h3> <i class="fas fa-expand"></i> '.$annonce['A_superficie'].' m² </h3>
                    <h3> <i class="fas fa-money-bill-wave"></i> '.
                    $annonce['A_cout_charges'].'€ de charges</h3>
                </div>
                <div class="buttons">
                    <a href="'.
                base_url("/homes/".$annonce['A_idannonce']."/contact").
                '" class="btn">Contacter le Propriétaire</a>
                    <a href="'.
                base_url("/homes/".$annonce['A_idannonce']."/").
                '" class="btn">Voir l\'annonce</a>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>
</section>

<section class="services fond" id="services">

    <h1 class="heading"> Nos <span>Services</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="ressources/images/s-1.png" alt="">
            <h3>Louez votre Maison</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio ipsa ab cum error quas fuga ad? Perspiciatis, autem officiis?</p>
            <a href="
            <?php
            if ($isLoggedIn){
                echo base_url("/account/homes").'" class="btn">J\'y vais</a>';
            }
            else{
                echo base_url("/login").'" class="btn">Je me connecte</a>';
            }
            ?>
        </div>

        <div class="box">
            <img src="ressources/images/s-2.png" alt="">
            <h3>Découvrez la Maison Idéale</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio ipsa ab cum error quas fuga ad? Perspiciatis, autem officiis?</p>
            <a href="<?= base_url("/homes") ?>" class="btn">Rechercher des maintenant</a>
        </div>

        <div class="box">
            <img src="ressources/images/s-3.png" alt="">
            <h3>rencontrez vos futurs Locataires</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio ipsa ab cum error quas fuga ad? Perspiciatis, autem officiis?</p>
            <a href="
            <?php
                if ($isLoggedIn){
                    echo base_url("/account/messages").'" class="btn">Messagerie</a>';
                }
                else{
                    echo base_url("/login").'" class="btn">Je me connecte</a>';
                }
            ?>
        </div>

    </div>

</section>

<section class="footer">

    <div class="footer-container">

        <div class="box-container">

            <div class="box">
                <h3>Liens rapides</h3>
                <a href="#">Accueil</a>
                <a href="#">Carte</a>
                <a href="<?= base_url("/homes") ?>">Liste des logements</a>
                <a href="#">XXX</a>
                <a href="#">Contact</a>
            </div>

            <div class="box">
                <h3>Mon Profil</h3>
                <a href="#">mon compte</a>
                <a href="#">mes favoris</a>
                <a href="#">mes annonces</a>
                <a href="#">ma messagerie</a>
            </div>

            <div class="box">
                <h3>Suivez nous</h3>
                <a href="https://github.com/">GitHub de Deleuil.M</a>
                <a href="https://github.com/">GitHub de Grasset.C</a>
                <a href="https://github.com/">GitHub du Projet</a>
                <a href="https://nekos.life/lewd">👀</a>
            </div>

        </div>

        <div class="credit">Li Logement by <span>Li Suitche</span> & <span>Li ZiDraw++</span> | tout ratio contré ! </div>

    </div>

</section>
<script>

    let menu = document.querySelector('#menu-bars');
    let navbar = document.querySelector('.navbar');

    menu.onclick = () =>{
        navbar.classList.toggle('active');
        menu.classList.toggle('fa-times');
    }

    window.onscroll = () =>{
        navbar.classList.remove('active');
        menu.classList.remove('fa-times');
    }

</script>

<?= view('templates/html_close.php') ?>

