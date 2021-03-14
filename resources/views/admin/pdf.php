<head>
    <title><?= isset($title) ? $title : 'Rhythm App Dashboard'; ?></title>
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
        .select-field {
            display: flex;
            background-color: #f3f3f3;
            padding: 20px 0;
        }
        .contentc h4,
        .contentc h5 span
        {
            color:#ff9832;
            font-size: 15px;
        }
        .contentc p{
            color:#000;
            font-size: 15px;
        }
        .contentc h5 span{
            margin-right: 10px;
        }
        .contentc h5{
            font-size: 15px;
            color:#000;
        }
        .content_img img {
            object-fit: cover;
            object-position: center;
            width: 100%;
        }
        .content-section{
            margin-top: 20px;
        }
        .pdf-content h3{
            color:#ff9832;
            font-size: 20px;
        }
        .content-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #cecece;
            /* padding-bottom: 20px; */
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .content-box h5{
            color:#777777;
            font-size: 15px;
        }
        .content-box p{margin: 0;color:#bcbcbc;}
        .content-section .row{
            display: flex;
            align-items: center;
        }
        .pdf-content .content-box:last-child {
            border-bottom: none;
        }
        .price{
            color:#069628;
            font-weight: 800;
        }
        .content-section .row {
            margin-bottom: 20px;
        }
    </style>  
</head>


<body style="background-color:#fff;">
    <div class="container">
        <div class="row text-center">
            <h1>PHOTO SHEET</h1>
        </div>
        <div class="row select-field">
            <div  class="container">
                <div class="col-md-6">
                    <div class="contentc">
                        <h4>Colonial Claims</h4>
                        <p>
                            2200 Bayshore Blvd.<br/>
                            Dunedin, FL. 3468
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contentc">
                        <h5><span>Insured :</span>Gary & Amy Leboeuf</h5>
                        <h5><span>Claim# :</span>227326</h5>
                        <h5><span>Policy# :</span>RL00046773</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content-section">
        <div class="container">
            <?php foreach ($contents as $content) { ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="content_img">
                            <?php if ($content->image_path) { ?>
                                <img src="<?= asset('public/' . $content->image_path); ?>"/>
                            <?php } else { ?>
                                <img src="<?= asset('images'); ?>/users_image/default.png"/>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($content->type != '2') { ?>
                        <div class="col-md-6">
                            <?php foreach ($content->getLabel as $content){ ?>
                            <div class="pdf-content">
                                <h3><?= $content->item_name ?></h3>
                                <div class="content-box">
                                    <h5>Brand/ Manufacture</h5>
                                    <p><?= $content->brand ?></p>
                                </div>
                                <div class="content-box">
                                    <h5>Model</h5>
                                    <p><?= $content->model ?> </p>
                                </div>
                                <div class="content-box">
                                    <h5>Serial Number</h5>
                                    <p><?= $content->serial_no ?></p>
                                </div>
                                <div class="content-box">
                                    <h5>Quantity Lost</h5>
                                    <p><?= $content->quantity ?></p>
                                </div>
                                <div class="content-box">
                                    <h5>Age</h5>
                                    <p><?= $content->age_in_years ?> years, <?= $content->age_in_months ?> months</p>
                                </div>
                                <div class="content-box">
                                    <h5>Cost to Replace (each) Pre Tax</h5>
                                    <p class="price">$<?= $content->cost_to_replace ?></p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-6">
                            <div class="pdf-content">
                                    <h3><?= $content->getGroup->getGroupLabel->item_name ?></h3>
                                    <div class="content-box">
                                        <h5>Brand/ Manufacture</h5>
                                        <p><?= $content->getGroup->getGroupLabel->brand ?></p>
                                    </div>
                                    <div class="content-box">
                                        <h5>Model</h5>
                                        <p><?= $content->getGroup->getGroupLabel->model ?> </p>
                                    </div>
                                    <div class="content-box">
                                        <h5>Serial Number</h5>
                                        <p><?= $content->getGroup->getGroupLabel->serial_no ?></p>
                                    </div>
                                    <div class="content-box">
                                        <h5>Quantity Lost</h5>
                                        <p><?= $content->getGroup->getGroupLabel->quantity ?></p>
                                    </div>
                                    <div class="content-box">
                                        <h5>Age</h5>
                                        <p><?= $content->getGroup->getGroupLabel->age_in_years ?> years, <?= $content->getGroup->getGroupLabel->age_in_months ?> months</p>
                                    </div>
                                    <div class="content-box">
                                        <h5>Cost to Replace (each) Pre Tax</h5>
                                        <p class="price">$<?= $content->getGroup->getGroupLabel->cost_to_replace ?></p>
                                    </div>
                                </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
</body>
</html>