<!DOCTYPE html>
<html>
<head>
    <title> Content Buddy | Registration</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
</head>
<body style="margin:0 auto; font-family: 'Lato', sans-serif; max-width: 600px;" >
<table style="height:100%; margin: 0 auto;width: 600px;">
    <tr>
        <td>
            <table style="border-collapse:collapse; width:100%;">
                <tr style="background: #ff9832; text-align: center;">
                    <td style="padding: 13px 0px;">
                        <img src="https://i.ibb.co/51DKDBv/email-template-logo.png" alt="email-template-logo" border="0">
                    </td>
                </tr> 
            </table>
            <table style="border-collapse:collapse; width:100%;">
                <tr>
                    <td style="padding-top: 60px; text-align: center;"><h1 style="margin: 0; font-size: 30px;">Confirm your email address!</h1></td>
                </tr>
                <tr>
                    <td style="font-size: 16px; padding:20px 0px 0px 30px">Hello <?= $full_name ?>,</td>
                </tr>
                <tr>
                    <td style="font-size: 16px; padding: 12px 0px 0px 30px">Please click below button to confirm that <a style="color:black; font-weight: 600; text-decoration: none;" href="mailto:<?= $user_email ?>"><?= $user_email ?></a> is your email address.</td>
                </tr>
                <tr>
                    <td style="font-size: 16px; padding: 12px 0px 0px 30px">Click Below the button to confirm your email address!</td>
                </tr>
                <tr>
                    <td style="text-align:center; padding: 35px 0px 20px 0px;">
                        <?php if (isset($link)) { ?>
                            <a href="<?= $link ?>" style="background: #ff9832; padding: 16px 40px; border-radius: 3px;text-decoration: none; color:white; border: 0; font-size: 18px; cursor: pointer; text-transform: uppercase;font-size: 16px; font-weight: 600;">
                                Confirm email address
                            </a>
                        <?php } ?>
                    </td>
                </tr> 
                
                <tr>
                    <td style="font-size: 14px; padding: 0px 0px 0px 20px; text-align:center;">Support: <a href="mailto:support@contentbuddy.com" style="color:black; text-decoration: none;">support@contentbuddy.com</a></td>
                </tr>
            </table>
            <table style="width:100%; background: #f6f6f6; border-top:1px solid rgba(255, 152, 50, 0.5); margin-top:25px; padding: 15px 0px;">
            <tr>
                <td style="text-align:center; font-size: 12px; font-weight: 500;">Privacy Policy</td>    
            </tr>
            <tr>
                <td style="text-align:center; font-size: 12px; font-weight: 500; line-height: 0.8;">Terms & Conditions</td>    
            </tr>
            <tr>
                <td style="padding-top: 10px; text-align:center;">
                    <a href="https://facebook.com" target="_blank" style="margin-right: 12px"><img src="https://i.ibb.co/Z6dR87F/email-template-fb.png" alt="email-template-fb" border="0"></a>
                    <a href="https://twitter.com" target="_blank" style="margin-right: 12px"><img src="https://i.ibb.co/ChR6MvL/email-template-twitter.png" alt="email-template-twitter" border="0"></a>
                    <a href="https://instagram.com" target="_blank" style="margin-right: 12px"><img src="https://i.ibb.co/RNf76LR/email-template-instagram.png" alt="email-template-instagram" border="0"></a>
                    <a href="https://www.pinterest.com/" target="_blank"><img src="https://i.ibb.co/F8HJr87/email-template-pantest.png" alt="email-template-pantest" border="0"></a>
                </td>
            </tr>
            <tr>
                <td style="text-align:center; font-size: 12px; font-weight: 600">Copyright Contentbuddy, LLC 2019</td>    
            </tr>
            <tr>
                <td style="text-align:center; font-size: 12px; color:#353535;">Version 2.0</td>    
            </tr>
            </table>
        <td>
    </tr>
</table>
</body>