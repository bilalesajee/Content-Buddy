<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_users'); ?>">Users</a>
            </li> 
            <li>
                <a href="<?= url('manage_items/'.$result->getUser->id); ?>">Rooms</a>
            </li>
            <li>
                <a href="<?= url('view_item/'.$result->item_id); ?>">View Room</a>
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
                            <h2 class="font-bold m-b-xs" style="margin-bottom: 10px;">
                                User Name : <small><?= strtoupper($result->getUser->first_name . ' ' . $result->getUser->last_name) ?></small>
                                <br>
                                Group Title : <small><?= strtoupper($result->title); ?></small>
                            </h2>
                            <hr>
                            <h4>Info</h4>
                            <?php
                            if ($result->getLabel) {
                                foreach ($result->getLabel as $val) {
                                    ?>
                                    <div class="row">
                                        <div class="ibox">
                                            <div class="ibox-content product-box">
                                                <div class="col-md-12" style="margin-bottom: 20px;">
                                                    <div class="col-md-3">
                                                        <strong>Room Name </strong>
                                                        <p> <?= $val->room_name ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Item name </strong>
                                                        <p> <?= $val->item_name ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Brand</strong>
                                                        <p> <?= $val->brand ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Model</strong>
                                                        <p> <?= $val->model ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 20px;">
                                                    <div class="col-md-3">
                                                        <strong>Quantity</strong>
                                                        <p> <?= $val->quantity ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Age in years </strong>
                                                        <p> <?= $val->age_in_years ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Age in months </strong>
                                                        <p> <?= $val->age_in_months ?></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Cost to replace</strong>
                                                        <p> <?= $val->cost_to_replace ?></p>
                                                    </div>
                                                </div>
<!--                                                <div class="m-t text-righ">
                                                    <a href="javascript:void(0)" class="btn btn-xs btn-outline btn-primary del_label" data-id="<?= $val->id; ?>">Delete <i class="fa fa-trash"></i> </a>
                                                </div> -->
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
    <div class="wrapper wrapper-content animated fadeInRight" style="padding: 0px 10px 40px;">
        <div class="ibox product-detail">
            <div class="ibox-content">
                <div class="row">
                    <?php
                    if (!$result->getGroupPhotos->isEmpty()) {
                        foreach ($result->getGroupPhotos as $val) {
                            ?>
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box" style="padding: 30px 30px 30px 30px;">
                                        <div class="product-imitation" style="background: url('<?= asset('public/' . $val->image_path) ?>');background-position : center;background-size : cover;background-repeat : no-repeat;">
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