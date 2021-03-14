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
                <?php if ($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors->all() as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="main-heading">
                    <h2>Sign Up</h2>
                </div>
                <form action="<?= url('register'); ?>" method="post" id="register">


                    <?= csrf_field(); ?>
                    <div class="cus-input-main">
                        <input type="text" placeholder="First name" name="first_name" value="<?= old('first_name'); ?>" class="cus-input" required />
                    </div>
                    <div class="cus-input-main">
                        <input type="text" placeholder="Last name" name="last_name" class="cus-input" value="<?= old('last_name'); ?>" />
                    </div>
                    <div class="cus-input-main">
                        <input type="email" placeholder="Email" name="email" class="cus-input" value="<?= old('email'); ?>" />
                    </div>
                    <div class="cus-input-main">
                        <input type="text" placeholder="Street Address" name="address" class="cus-input" value="<?= old('address'); ?>" />
                    </div>
                    <div class="cus-input-main">
                        <input type="text" placeholder="City" name="city" class="cus-input" value="<?= old('city'); ?>" />
                    </div>
                    <div class="cus-input-two">
                        <div class="cus-input-main">
                            <input type="text" placeholder="State" name="state" class="cus-input" value="<?= old('state'); ?>" />
                        </div>
                        <div class="cus-input-main">
                            <input type="text" placeholder="Zipcode" onkeypress="return event.charCode != 45" name="zipcode" class="cus-input" value="<?= old('zipcode'); ?>" />
                        </div>
                    </div>
                    <div class="cus-input-main">
                        <input type="text" placeholder="Phone number" name="phone_no" id="phone_no" minlength="5" maxlength="15" class="cus-input" value="<?= old('phone_no'); ?>" />
                    </div>
                    <div class="cus-input-main">
                        <input type="password" placeholder="Password" name="password"  id="password" class="cus-input"/>
                    </div>
                    <div class="cus-input-main">
                        <input type="password" placeholder="Repeat Password" name="password_confirmation" class="cus-input" />
                    </div>
                    <div class="cus-btn-main">
                        <input type="submit" value="Sign up" class="cus-btn" />
                    </div>
                </form>
                <div class="shadow-area">
                    <span>Already Member?</span>
                    <div class="cus-signBtn-main">
                        <a href="<?= url('login'); ?>" class="cus-btn-transparent">Sign In</a>
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

                var testPattern = new RegExp("^(\\+)?(\\d+)$");

                $('#phone_no').on('keyup', function () {
                    if ($(this).val().length == 1)
                        $(this).val('+');
                    else {
                        var res = chkInput();
                        if (!res)
                            $(this).val($(this).val().slice(0, -1));
                    }
                });
                function chkInput() {
                    var v = $('#phone_no').val().charAt($('#phone_no').val().length - 1);
                    return testPattern.test(v);
                } 
                $('#register').validate({
                    rules: {
                        first_name: {
                            required: true,
                            specialChars: true
                        },
                        last_name: {
                            required: true,
                            specialChars: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        address: {
                            required: true
                        },
                        city: {
                            required: true,
                            specialChars: true
                        },
                        state: {
                            required: true,
                            specialChars: true
                        },
                        zipcode: {
                            required: true,
                            specialChars: true
                        },
                        phone_no: {
                            required: true
                        },
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