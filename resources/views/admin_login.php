<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Content Buddy Admin | Login</title>
    <link rel="shortcut icon" type="image/png" href="<?= asset("userasset/img/favicon.png") ?>"/>
    <link href="<?= asset('public/admin');?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset('public/admin');?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= asset('public/admin');?>/css/animate.css" rel="stylesheet">
    <link href="<?= asset('public/admin');?>/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                  <img src="<?php echo asset('public/images/logo.png') ?>" style="width:200px;" alt="imga">

            </div> 
            <?php if ($errors->any()): ?>
            <?php echo implode('', $errors->all('<p class="text-danger">:message</p>')) ?>
            <?php endif;?>

             <?php if(Session::has('success')){ ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                    <?php echo Session::get('success') ?>
                </div>
                <?php } ?>
             <?php if(Session::has('error')){ ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                    <?php echo Session::get('error') ?>
                </div>
                <?php } ?>
            
             <?php if(Session::has('notfound')){ ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                    <?php echo Session::get('notfound') ?>
                </div>
                <?php } ?>
            
             
            

            <form action="<?php echo asset('/admin_login')?>" method="post" class="login-form" <?php if ((Session::has('forgetemail'))) { ?> style="display:none" <?php }?> <?php if ((Session::has('notfound'))) { ?> style="display:none;" <?php }?> >
                <h3>Welcome to Content Buddy</h3>
               <?php echo csrf_field();?>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Username" value="" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" value="" required="">
                </div> 
               <div class="form-actions">
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    <label class="rememberme check"> 
                    <a href="javascript:void(0);" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
            </form>
            
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="<?= asset('forgetpswrd');?>" method="post"  <?php if ((!Session::has('forgetemail'))) : ?> style="display:none;" <?php endif;?>  >
                <?php echo csrf_field();?>
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" required=""/> 
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
                    <a href="javascript:void(0);" id="back-btn">Login here?</a> 
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM --> 
             
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= asset('public/admin');?>/js/jquery-3.1.1.min.js"></script>
    <script src="<?= asset('public/admin');?>/js/bootstrap.min.js"></script>
    <script>
    $('body').on('click','.forget-password',function(){
//        var data= $('#forgetemail').val();
//        if(data == 'Email error')
//        {   
//            $('.login-form').hide();
//            $('.forget-form').show();
//            debugger;
//        }
//        
        $('.forget-form').show();
        $('.login-form').hide();
    });
    $('body').on('click','#back-btn',function(){
        
        $('.login-form').show();
        $('.forget-form').hide();
    });
    
    
    </script>
</body>

</html>
