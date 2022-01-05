<?= view('templates/html_connexion_open.php') ?>
<div class="limiter">
    <div class="container">
        <div class="wrap">
            <div class="pic">
                <img src="<?= base_url('/images/logo.png') ?>" alt="Logo">
            </div>

            <form class="form" action="" method="post">
					<span class="form-title">
						Login Page
					</span>
                <div class="wrap-input100 <?php if (isset($errors['email'])){echo 'alert-validate';}?>">
                    <input class="input100" type="text" id="email" name="email" placeholder="Email"  required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 <?php if (isset($errors['password'])){echo 'alert-validate';}?>">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password" required="required">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <?php
                if (!empty($errors)){
                    echo '<p class="validation_error">
						'.$errors['email'].'
					</p>';
                }?>
                <div class="container-form-btn">
                    <button class="form-btn" type="submit" name="submit">
                        Connexion
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <a class="txt2" href="<?= base_url("/recovery") ?>">
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
