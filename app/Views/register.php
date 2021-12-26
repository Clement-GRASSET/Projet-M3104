<?= view('templates/html_connexion_open.php') ?>
<div class="limiter">
    <div class="container">
        <div class="wrap">
            <div class="pic p-t-120">
                <img src="https://media.discordapp.net/attachments/912817562306359356/912821861644107826/nazi_gay.png" alt="Logo">
            </div>

            <form class="form" action="" method="post">
					<span class="form-title">
						Register
					</span>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="email" placeholder="Email" id="email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="pseudo" placeholder="Pseudo" id="pseudo">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="nom" placeholder="Nom" id="nom">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="prenom" placeholder="Prenom" id="prenom">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="password" name="pass" placeholder="Password" id="password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="password" name="password2" placeholder="Confirm Password" id="password2">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-form-btn">
                    <button class="form-btn">
                        Créer un Compte
                    </button>
                </div>

                <div class="text-center p-t-5 p-b-35">
                    <a class="txt2" href="<?= base_url("/login") ?>">
                        Deja un Compte ?
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('templates/html_close.php') ?>
