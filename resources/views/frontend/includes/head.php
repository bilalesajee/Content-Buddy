<?php
$segment = Request::segment(1);
$current_id = '';
$current_name = '';
$current_user = '';
$current_user_type = '';
$current_photo = asset('public/images/users/default.jpg');
$current_email = '';
$user_items = array();
if (Auth::user()) {
    $user = Auth::User();

    $user_items = $user->userItems;
    $current_id = $user->id;
    $current_email = $user->email;
    $current_user_name = $user->full_name;
    $current_user = $user;
    $current_user_type = $user->user_type;
    if ($user->image) {
        $current_photo = asset('public/'.$user->image);
    } else {
        $current_photo = asset('public/images/profile_images/user-placeholder.jpg');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contents Buddy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="expires" content="0">
        
        <link rel="shortcut icon" type="image/png" href="<?= asset("userasset/img/favicon.png") ?>"/>
        <link type="text/css" href="<?= asset('userasset'); ?>/css/bootstrap.min.css" rel="stylesheet" /> 
        <link type="text/css" href="<?= asset('userasset'); ?>/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="<?= asset('userasset'); ?>/css/nice-select.css" rel="stylesheet" />
        <link type="text/css" href="<?= asset('userasset'); ?>/css/all.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        
        <script>
            base_url = "<?= asset('/'); ?>";
        </script> 
    </head>
    <body>
