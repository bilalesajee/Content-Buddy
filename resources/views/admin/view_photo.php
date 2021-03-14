<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Groups</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_groups'); ?>">Groups</a>
            </li>
            <li class="active">
                <strong><?= $title; ?></strong>
            </li>
        </ol>
    </div> 
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <?php include resource_path('views/admin/include/messages.php'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox product-detail">
                <div class="ibox-content">
                    <div class="row">                       
                        <div class="col-md-12">
                            <div class="wrapper wrapper-content animated fadeInRight">
                            <h2 class="font-bold m-b-xs">
                                <?= $result->title; ?>
                            </h2>
                            <small><?= $result->getUser->first_name . ' ' . $result->getUser->last_name ?></small>
                            <hr>
                            <h4>Items Photo</h4>
                            <?php
                            if ($result->ItemPhotos) {
//                                dd($result->ItemPhotos);
                                foreach ($result->ItemPhotos as $val) {
                                    ?>
                                    <div class="col-md-3">
                                        <div class="ibox">
                                            <div class="ibox-content product-box">
                                                <div class="product-imitation">
                                                    <img src="<?=asset('public/images/'.$val->image_path)?>">
                                                </div>
                                                <div class="product-desc">                                                    
                                                    <small class="text-muted">Category</small>
                                                    <a href="#" class="product-name"> Product</a>
                                                    <div class="small m-t-xs">
                                                        Many desktop publishing packages and web page editors now.
                                                    </div>
                                                    <div class="m-t text-righ">
                                                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    </div>

                </div> 
            </div>

        </div>
    </div>

</div>
<!-- Page-Level Scripts -->
<script>
    $('body').on('click', '.del_label', function () {
        $this = $(this);
        var id = $this.attr('data-id');
        swal({
            title: "Are you sure?",
            text: "you want to delete this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type: "POST",
                url: base_url + "/delete_item",
                data: {id: id, 'table': 'label'},
                dataType: 'json',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (data) {
                    $('.web-alert').hide();
                    $('.ajax-msg').show();
                    $(".ajax-msg").removeClass("alert-danger");
                    $(".ajax-msg").addClass("alert-success");
                    $(".ajax-body").html(data.msg);
                    $('#row_' + id).remove();
                    swal.close()
                },
                error: function (data) {
                    $('.ajax-msg').show();
                    var response = $.parseJSON(data.responseText);
                    $(".ajax-msg").addClass("alert-danger");
                    $(".ajax-msg").removeClass("alert-success");
                    $(".ajax-msg").html(response.errorMessage);
                }
            });
        });
    });
</script>