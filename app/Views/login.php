<?= view('templates/html_connexion_open.php') ?>
<div class="limiter">
    <div class="container">
        <div class="wrap">
            <div class="pic">
                <img src="https://media.discordapp.net/attachments/912817562306359356/912821861644107826/nazi_gay.png" alt="Logo">
            </div>

            <form class="form" action="" method="post">
					<span class="form-title">
						Login Page
					</span>

                <?php var_dump($errors); ?>

                <div class="wrap-input100">
                    <input class="input100" type="text" id="email" name="email" placeholder="Email"  required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password" required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-form-btn">
                    <button class="form-btn" type="submit" name="submit">
                        Connexion
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <a class="txt2" href="#">
                        Mot de passe oublié ?
                    </a>
                </div>

                <div class="text-center p-t-65">
                    <a class="txt2" href="<?= base_url("/register") ?>">
                        Créer son Compte
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('templates/html_close.php') ?>
