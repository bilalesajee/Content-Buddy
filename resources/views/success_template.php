<!DOCTYPE html>
<html lang="en">
    <?php include 'frontend/includes/head.php'; ?>
<body>
	<style type="text/css">
.success-text{
	font-size: 25px;
	padding: 25px 0;
}
</style>
<main>
    <section class="login-panel" style="margin-top : 50px;">
        <div class="login-form text-center">
             <!--<img src="<?=asset('public')?>/svg/check-mark.svg" width="200px" class="img-responsive center-block">-->
            <div style="font-size:120px;color:#ff9832;"><i class="fa fa-check"></i></div>
            <h4 style="color : #ff9832;"><?= $message; ?></h4>
            <a class="cus-btn" style="display: inline-block;margin-top: 25px;" href="<?=url('/login');?>"> Back to webiste</a> 
        </div>
    </section>
</main> 
</body>
</html>
