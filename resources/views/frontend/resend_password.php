<!DOCTYPE html>
<html>
    <head>
        <title>Contents Buddy | <?= $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico" type="<?= asset('userasset'); ?>/image/x-icon" sizes="16x16">
        <link type="text/css" href="<?= asset('userasset'); ?>/css/bootstrap.min.css" rel="stylesheet" /> 
        <link type="text/css" href="<?= asset('userasset'); ?>/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="<?= asset('userasset'); ?>/css/all.css" rel="stylesheet" />
    <style>
            .has-error .cus-input{
                border: 1px solid red;
            }
        </style>
    </head>
    <body>
        <main class="form-bg">
            <div class="cus-form-main">

                <div class="logo">
                    <a href="<?= url('register') ?>"><img src="<?= asset('userasset'); ?>/img/logo.png" alt="Logo" /></a>
                </div>
                <form action="<?= url('sendforget'); ?>" method="post" id="signin_form">
                    <?php include resource_path('views/frontend/includes/messages.php'); ?>
                    <?= csrf_field(); ?>
                    <div class="cus-input-main">
                        <input type="email" placeholder="Email" name="email" class="cus-input" required/>
                    </div>
                    
                    <div class="cus-forgot-main">
                        <a href="<?= url('login'); ?>">Login here?</a>
                    </div>
                    <div class="cus-btn-main">
                        <input type="submit" value="Submit" class="cus-btn" />
                    </div>
                </form>
                <div class="shadow-area">
                    <span>Don't have an account?</span>
                    <div class="cus-signBtn-main">
                        <a href="<?= url('register') ?>" class="cus-btn-transparent">Sign Up</a>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?= asset('userasset'); ?>/js/bootstrap.min.js"></script> 
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="<?= asset('userasset'); ?>/js/regix.js"></script> 
        <script>
            $(document).ready(function () {
                $('header .pro-drop-main').click(function () {
                    $('.cus-pro-drop').slideToggle();
                });
                $('.menu-icon').click(function () {
                    $('.cus-sidebar').toggleClass('cus-sidebar-view');
                });
                
                 $('#signin_form').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: "required"
                    },
                    errorElement: "em",
                    errorPlacement: function (error, element) {
                        error.addClass("help-block");
                    }
                    ,
                    highlight: function (element, errorClass, validClass) {
                        $(element).parents(".cus-input-main").addClass("has-error").removeClass("has-success");
                    }
                    ,
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parents(".cus-input-main").addClass("has-success").removeClass("has-error");
                    }
                }
                );
            });
        </script>
    </body>
</html>