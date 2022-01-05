<?= view('templates/html_connexion_open.php') ?>
<div class="limiter">
    <div class="container">
        <div class="wrap">
            <div class="pic">
                <img src="<?= base_url('/images/logo.png') ?>"
                     alt="Logo">
            </div>

            <form>
					<span class="form-title">
                        <?= $message?>
					</span>

                <div class="text-center p-t-65">
                    <a class="txt2" href="<?= base_url("/login") ?>">
                        Retour à la Connexion
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('templates/html_close.php') ?>
