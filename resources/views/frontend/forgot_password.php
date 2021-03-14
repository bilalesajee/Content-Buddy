<!DOCTYPE html>
<html>
    <head>
        <title>Contents Buddy | <?= $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="<?= asset("userasset/img/favicon.png") ?>"/>
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
                <form action="<?= url('reset_password'); ?>" method="post" id="reset_frm">
                    <?php include resource_path('views/frontend/includes/messages.php'); ?>
                    <?= csrf_field(); ?>
                    <input type="hidden" value="<?= $token ?>" name="token"/>
                   
                    <div class="cus-input-main">
                        <input type="password" name="password" placeholder="New password" id="password" class="cus-input" required="">
                    </div>
                    
                   <div class="cus-input-main">
                        <input type="password" class="cus-input"  placeholder="Confirm password" name="password_confirmation">
                    </div>
                    <div class="cus-btn-main">
                        <input type="submit" value="Submit" class="cus-btn" />
                    </div>
                </form>
            </div>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?= asset('userasset'); ?>/js/bootstrap.min.js"></script> 
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function () {
                $('header .pro-drop-main').click(function () {
                    $('.cus-pro-drop').slideToggle();
                });
                $('.menu-icon').click(function () {
                    $('.cus-sidebar').toggleClass('cus-sidebar-view');
                });
                
                 $('#reset_frm').validate({
                    rules: {  
                        password: "required",
                        password_confirmation: {
                            equalTo: "#password"
                        }
                    },
                    errorElement: "em",
                    errorPlacement: function (error, element) {
                        error.addClass("help-block");
                    }
                    ,
                    highlight: function (element, errorClass, validClass) {
                        $(element).parents(".cus-input-main").addClass("has-error").removeClass("has-success");
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parents(".cus-input-main").addClass("has-success").removeClass("has-error");
                    }
                }
                );
            });
        </script>
    </body>
</html>


