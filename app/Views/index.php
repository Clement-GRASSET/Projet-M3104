<?= view('templates/html_open', ['styles'=>['accueil.css'], 'fontAwesome'=>true]) ?>
<?= view('templates/html_navbar.php') ?>

<section class="home" id="home">

    <form action="<?= base_url('/homes') ?>" method="get">

        <h3>Découvez votre Maison Parfaite</h3>
        <div class="inputBox">
            <input type="search" name="ville" placeholder="Ville" id="">
        </div>

        <input type="submit" value="Rechercher" class="btn">

    </form>



</section>

<section class="featured" id="featured">

    <h1 class="heading">Nos <span>Annonces</span></h1>

    <div class="box-container">

        <?php
        foreach ($annonces as $annonce) {
            ?>
            <div class="box">
                <div class="image-container">
                    <img src="<?= base_url('/images/homes/' . ((empty($annonce['A_photos'])) ? 'default.png' : $annonce['A_idannonce'].'/'.$annonce['A_photos'][0]['P_nom'])) ?>" alt="">

                    <?php if ($isLoggedIn) {
                        if ($annonce['A_proprietaire']['U_mail'] === $loggedUser['U_mail']) {
                            echo '<div class="info"><h3>Votre annonce</h3></div>';
                        }
                    } ?>

                    <div class="icons">
                        <div class="icon fas fa-camera">
                            <p><?= sizeof($annonce['A_photos']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="price">
                        <h3><?= ($annonce['A_cout_loyer']+$annonce['A_cout_charges']) ?>€ par mois</h3>
                    </div>
                    <div class="location">
                        <h3><?= $annonce['A_titre'] ?></h3>
                        <p><?= $annonce['A_description'] ?></p>
                    </div>
                    <div class="details">
                        <h3><i class="fas fa-expand"></i> <?= $annonce['A_superficie'] ?> m² </h3>
                        <h3><i class="fas fa-home"></i> <?= $annonce['A_typeMaison'] ?></h3>
                    </div>
                    <div class="buttons">
                        <a href="<?= base_url("/homes/".$annonce['A_idannonce']."/") ?>" class="btn">Voir l'annonce</a>
                        <?php if (!$isLoggedIn || $annonce['A_proprietaire']['U_mail'] !== $loggedUser['U_mail']) { ?>
                        <a href="<?= base_url("/homes/".$annonce['A_idannonce']."/contact") ?>" class="btn">Contacter le propriétaire</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<section class="services fond" id="services">

    <h1 class="heading"> Nos <span>Services</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="<?= base_url("/images/s-1.png") ?>" alt="">
            <h3>Louez votre maison</h3>
            <p>Accédez à votre espace personnel pour utiliser tous les services du site.</p>
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
            <img src="<?= base_url("/images/s-3.png") ?>" alt="">
            <h3>Découvrez la maison idéale</h3>
            <p>Découvrez toutes nos annonces.</p>
            <a href="<?= base_url("/homes") ?>" class="btn">Rechercher des maintenant</a>
        </div>

        <div class="box">
            <img src="<?= base_url("/images/s-3.png") ?>" alt="">
            <h3>Rencontrez vos futurs Locataires</h3>
            <p>Utilisez la messagerie pour communiquer avec les annonceurs.</p>
            <a href=
            <?php
                if ($isLoggedIn){
                    echo '"' .base_url("/account/messages").'" class="btn">Messagerie</a>';
                }
                else{
                    echo '"' .base_url("/login").'" class="btn">Je me connecte</a>';
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
                <a href="<?= base_url("/") ?>">Accueil</a>
                <a href="<?= base_url("/homes") ?>">Liste des logements</a>
            </div>

            <div class="box">
                <h3>Mon Profil</h3>
                <a href="<?= base_url("/account/messages") ?>">Ma messagerie</a>
                <a href="<?= base_url("/account/homes") ?>">Mes annonces</a>
                <a href="<?= base_url("/account/settings") ?>">Mon compte</a>
            </div>

            <div class="box">
                <h3>Suivez nous</h3>
                <a href="https://github.com/MargameOff">GitHub de Deleuil.M</a>
                <a href="https://github.com/Clement-GRASSET">GitHub de Grasset.C</a>
                <a href="https://github.com/Clement-GRASSET/Projet-M3104">GitHub du Projet</a>
            </div>

        </div>

        <div class="credit">Li Logement By <span>Clément Grasset</span> & <span>Marius Deleuil</span> | Tout Ratio Contré ! </div>

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

