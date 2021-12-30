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
        <a href="#agents">XXX (jsp quoi mettre)</a>
        <a href="#contact">contact</a>
    </nav>

    <div class="icons">
        <div id="menu-bars" class="fas fa-bars"></div>
        <a href="#" class="fas fa-heart"></a>
        <a href="<?= base_url("/login") ?>" class="fas fa-user"> Invité</a>
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

        <div class="box">
            <div class="image-container">
                <img src="https://www.lepoint.fr/images/2015/03/28/3143741-675779-jpg_2791013_600x314.jpg" alt="">
                <div class="info">
                    <h3>il y a 3h</h3>
                </div>
                <div class="icons">
                    <a href="#" class="fas fa-film"><h3>1</h3></a>
                    <a href="#" class="fas fa-camera"><h3>4</h3></a>
                </div>
            </div>
            <div class="content">
                <div class="price">
                    <h3>25,000€/mo</h3>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-envelope"></a>
                    <a href="#" class="fas fa-phone"></a>
                </div>
                <div class="location">
                    <h3>Poubelle de Luxe</h3>
                    <p>idéale pour la mere de evan</p>
                </div>
                <div class="details">
                    <h3> <i class="fas fa-expand"></i> 3500 m² </h3>
                    <h3> <i class="fas fa-bed"></i> 3 lits </h3>
                    <h3> <i class="fas fa-bath"></i> 2 salle de bains </h3>
                </div>
                <div class="buttons">
                    <a href="#" class="btn">Contacter le Propriétaire</a>
                    <a href="#" class="btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="image-container">
                <img src="https://www.lepoint.fr/images/2015/03/28/3143741-675779-jpg_2791013_600x314.jpg" alt="">
                <div class="info">
                    <h3>il y a 3h</h3>
                </div>
                <div class="icons">
                    <a href="#" class="fas fa-film"><h3>1</h3></a>
                    <a href="#" class="fas fa-camera"><h3>4</h3></a>
                </div>
            </div>
            <div class="content">
                <div class="price">
                    <h3>25,000€/mo</h3>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-envelope"></a>
                    <a href="#" class="fas fa-phone"></a>
                </div>
                <div class="location">
                    <h3>Poubelle de Luxe</h3>
                    <p>idéale pour la mere de evan</p>
                </div>
                <div class="details">
                    <h3> <i class="fas fa-expand"></i> 3500 m² </h3>
                    <h3> <i class="fas fa-bed"></i> 3 lits </h3>
                    <h3> <i class="fas fa-bath"></i> 2 salle de bains </h3>
                </div>
                <div class="buttons">
                    <a href="#" class="btn">Contacter le Propriétaire</a>
                    <a href="#" class="btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="image-container">
                <img src="https://www.lepoint.fr/images/2015/03/28/3143741-675779-jpg_2791013_600x314.jpg" alt="">
                <div class="info">
                    <h3>il y a 3h</h3>
                </div>
                <div class="icons">
                    <a href="#" class="fas fa-film"><h3>1</h3></a>
                    <a href="#" class="fas fa-camera"><h3>4</h3></a>
                </div>
            </div>
            <div class="content">
                <div class="price">
                    <h3>25,000€/mo</h3>
                    <a href="#" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-envelope"></a>
                    <a href="#" class="fas fa-phone"></a>
                </div>
                <div class="location">
                    <h3>Poubelle de Luxe</h3>
                    <p>idéale pour la mere de evan</p>
                </div>
                <div class="details">
                    <h3> <i class="fas fa-expand"></i> 3500 m² </h3>
                    <h3> <i class="fas fa-bed"></i> 3 lits </h3>
                    <h3> <i class="fas fa-bath"></i> 2 salle de bains </h3>
                </div>
                <div class="buttons">
                    <a href="#" class="btn">Contacter le Propriétaire</a>
                    <a href="#" class="btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services fond" id="services">

    <h1 class="heading"> Nos <span>Services</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="ressources/images/s-1.png" alt="">
            <h3>Louez votre Maison</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam distinctio ipsa ab cum error quas fuga ad? Perspiciatis, autem officiis?</p>
            <a href="#" class="btn">J'y vais</a>
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
            <a href="#" class="btn">Messagerie</a>
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

