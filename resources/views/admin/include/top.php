<head>
    <title><?= isset($title)?$title:'Rhythm App Dashboard';?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    
    <link rel="shortcut icon" type="image/png" href="<?= asset("userasset/img/favicon.png") ?>"/>
    <!--<link rel="icon" href="<?= asset("userasset/img/favicon.png") ?>" type="image/png" sizes="16x16">-->
 
    <link href="<?= asset('public/admin'); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset('public/admin'); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= asset('public/admin'); ?>/css/animate.css" rel="stylesheet">
    <link href="<?= asset('public/admin'); ?>/css/style.css" rel="stylesheet">
    <link href="<?= asset('public/admin'); ?>/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="<?= asset('public/admin'); ?>/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?= asset('public/admin'); ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!--
        <link href="<?= asset('public/admin'); ?>/css/plugins/summernote/summernote.css" rel="stylesheet">
        <link href="<?= asset('public/admin'); ?>/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">-->

    <link href="<?= asset('public/admin'); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= asset('public/admin'); ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="<?= asset('public/admin'); ?>/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="<?= asset('public/admin'); ?>/css/plugins/slick/slick-theme.css" rel="stylesheet">

    <script src="<?= asset('public/admin'); ?>/js/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.10.0/ckeditor.js"></script> 

    <!-- slick carousel-->
    <script src="<?= asset('public/admin'); ?>/js/plugins/slick/slick.min.js"></script>

    <link href="<?= asset('public/admin'); ?>/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    
 

    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <script> base_url = "<?= url('/'); ?>";</script>
    <style>
        .bootstrap-tagsinput{
            display: block !important;
        }
    </style>  
</head>


