<main class="form-bg">
    <div class="cus-form-main">
        <div class="logo">
            <a href="<?= url('register'); ?>"><img src="<?= asset('userasset'); ?>/img/logo.png" alt="Logo" /></a>
        </div>
        <h2 class="text-center">Change your password?</h2> 
        <div class="panel-body">
            <?php include resource_path('views/frontend/includes/messages.php'); ?>    
            <form action="<?= asset('/reset_password/'); ?>" id="register-form" role="form" autocomplete="off" class="form" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                        <input name="password" placeholder="New Password" class="form-control"  type="password" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                        <input name="password_confirmation" placeholder="Confirm password" class="form-control"  type="password" required="">
                    </div>
                </div>
                <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                </div>
                <input name="email_token" type="hidden" value="<?= $token ?>">
            </form>
        </div>
    </div>
</main>