<!DOCTYPE html>
<html>
<head>
    <title>Buddy Reset password email</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>
<body>
<table border="0" style="width:900px; margin:0 auto; font-family: 'Open Sans'; font-size:14px; ">
    <thead>

    </thead>
    <tbody>
    <tr>
        <td style="padding:10px 0 0; color:#20221f;">
            Hi <?=(isset($name) && $name !='') ? $name : 'Admin';   ?>,
        </td>
    </tr>
    <tr>
        <td style="padding:10px 0 0; color:#20221f;">
            Buddy-App has received a request to reset the password for your account.
            <strong style="display: block; margin-top: 10px;">
                
                <a href="<?php echo asset('changepassword'.'?'.'token'.'='.$token); ?>" style="background: #D3D3D3; display: inline-block; padding: 10px 15px; color: #2b2929; text-transform: uppercase; text-decoration: none; font-size: 12px; border-radius: 10px; letter-spacing: 1px;">Click here to create new password.</a>
            </strong>
        </td>
    </tr>
    <tr>
        <td style="padding:10px 0 0; color:#20221f;">
            If you did not request to reset your password, please ignore this email.
        </td>
    </tr>
       <tr>
        <td style="padding:10px 0 0; color:#20221f;">
            Thank You,
            The Buddy-App Team
        </td>
    </tr>
    <tr>
        <td><a href="#">Buddy-App.com</a></td>
    </tr>
    </tbody>
</table>
</body>
</html>