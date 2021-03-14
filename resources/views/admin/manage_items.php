<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Items</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li>  
            <li>
                <a href="<?= url('manage_users'); ?>">Users</a>
            </li>
            <li class="active">
                <strong> Rooms</strong>
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
                            <div class="col-lg-12">
                                <a href="<?= url($user_id ? 'add_item/' . $user_id : ''); ?>" class="btn btn-success cus_font">Add New Room</a>
                                <!--<a href="<?= url('download/' . $user_id) ?>" class="btn btn-success pull-right">Download</a>-->
                                <button type="button" class="btn btn-success pull-right cus_font" data-toggle="modal" data-target="#myModal">Download</button>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog"> 
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Download Contents Spreadsheets and Photo Report</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= url('download') ?>" method="post"> 
                                                    <?= csrf_field(); ?>
                                                    <div class="form-group">
                                                        <label for="cn">Claim Number:</label>
                                                        <input type="text" name="claim_no" class="form-control" id="cn">
                                                        <input type="hidden" name="id" value="<?= $user_id ?>">
                                                        <input type="hidden" name="download_type" id="download_type">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="cn">Policy Number:</label>
                                                        <input type="text" name="policy_no" class="form-control" id="cn">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="st">State:</label>
                                                        <input type="text" name="state" class="form-control" id="st">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ii">Important Information:</label>
                                                        <textarea class="form-control" name="information" id="ii"></textarea>
                                                    </div> 
                                                    <label>Chose Type:</label>
                                                    <div class="form-group">
                                                        <input type="radio" name="type" id="xact" value="xact" style="vertical-align: sub;"> <label for="xact">Download Xact Spreadsheet</label>
                                                    </div> 
                                                    <div class="form-group">
                                                        <input type="radio" name="type" id="simsol" value="simsol" style="vertical-align: sub;"> <label for="simsol">Download Simsol Spreadsheet</label>
                                                    </div> 
                                                    <div class="form-group">
                                                        <input type="radio" name="type" id="photo" value="photo" style="vertical-align: sub;"> <label for="photo">Download Photo Report</label>
                                                    </div> 
                                                    <!--<button type="submit" class="btn btn-success" id="xact_btn">Download Xact Spreadsheet</button>-->
<!--                                                    <button type="submit" class="btn btn-warning" id="simsol_btn">Download Simsol Spreadsheet</button>
                                                    <button type="submit" class="btn btn-info" id="pdf_btn">Download Photo Report</button>-->
                                                    <div class="form-group" style="text-align: center;" >
                                                        <button type="submit" class="btn btn-success" >Download</button>
                                                    </div>
                                                </form>
                                            </div>
<!--                                            <div class="modal-footer" style="text-align : center;">
                                                
                                                    <button type="submit" class="btn btn-success">Download</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>-->
                                        </div>

                                    </div>
                                </div>
                                <!--End Model-->
                            </div><br>
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <h4>All Rooms</h4>
                                <hr>
                                <?php
                                if (!$result->isEmpty()) {
                                    foreach ($result as $val) {
                                        ?>
                                        <a href="<?= url('view_item/' . $val->id); ?>" style="font-size : 20px;" >

                                            <div class="col-md-3" id="row_<?= $val->id; ?>">
                                                <div class="ibox">
                                                    <div class="ibox-content product-box cus-height" style="padding: 30px 30px 30px 30px;">
                                                        <div class="product-imitation cus_four_img" style="padding : 0px">
                                                            <?php
                                                            $total_photos = $val->ItemAllPhotos->count();
                                                            $remaining_photos = $total_photos - 4;
                                                            if (!$val->ItemAllPhotos->isEmpty()) {
                                                                $counter = 1;
                                                                
                                                                foreach ($val->ItemAllPhotos as $ItemPhotos) {
                                                                    
                                                                    if ($counter < 4) {
                                                                        ?>
                                                                        <?php
                                                                        if ($ItemPhotos->image_path == 'empty') {
                                                                            $ItemPhotos->image_path = 'images/profile_images/default.jpg';
                                                                        }
                                                                        ?>
                                                            <?php if($total_photos == 1){ ?>
                                                                <figure class="cus_fig_style cus_one_img" style="background-image:url('<?= asset('public/' . $ItemPhotos->image_path) ?>')"></figure>
                                                            <?php }else if($total_photos == 2){ ?>
                                                                <figure class="cus_fig_style cus_two_img" style="background-image:url('<?= asset('public/' . $ItemPhotos->image_path) ?>')"></figure>
                                                            <?php }else if($total_photos == 3){ ?>
                                                                <figure class="cus_fig_style cus_three_img" style="background-image:url('<?= asset('public/' . $ItemPhotos->image_path) ?>')"></figure>
                                                            <?php }else{ ?>
                                                                        <figure class="cus_fig_style" style="background-image:url('<?= asset('public/' . $ItemPhotos->image_path) ?>')"></figure>
                                                            <?php } ?>
                                                                        <!--<figure style="background-image: url('<?= asset('public/' . $ItemPhotos->image_path); ?>')"></figure>-->
                                                                    <?php } else { ?>
                                                                        <?php if ($counter == 4) { ?>
                                                                            <figure class="cus_fig_style" style="background-image:url('<?= asset('public/' . $ItemPhotos->image_path) ?>')"></figure>
                                                                          

                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    <?php
                                                                    $counter++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <figure class="cus_img_style" style="background-image:url('<?= asset('public/images/users_image/default.jpg') ?>')"> 
                                                                </figure>
                                                            <?php } ?>
                                                        </div>
                                                        <div style="padding: 5px 0px 5px 0px;text-align: center;">
                                                            <span><?= $val->title ?></span>
                                                        </div>
                                                        <div style="text-align : center ;">
                                                            <span class="label label-info" style="font-size: 12px;margin-right : 10px;">Group - <?= $val->ItemGroups ? sizeof($val->ItemGroups) : '' ?> </span>
                                                            <span class="label label-info" style="font-size: 12px;margin-right : 10px;">Photos - <?= $val->ItemAllPhotos ? sizeof($val->ItemAllPhotos) : '' ?></span>
                                                            <p>
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-outline btn-primary del_item del_item_margin" data-id="<?= $val->id; ?>" >Delete <i class="fa fa-trash"></i> </a>
                                                                <!--<a href="<?= url('admin_delete_item' . '/' . $val->user_id . '/' . $val->id); ?>" class="btn btn-xs btn-outline btn-primary delet_photo" style="position: absolute;bottom: 30px;left: 117px;" >Delete <i class="fa fa-trash"></i> </a>-->
                                                                <a href="<?= url('add_item' . '/' . $val->user_id . '/' . $val->id); ?>" class="btn btn-xs btn-outline btn-primary"  >Edit Item <i class="fa fa-edit"></i> </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                } else {
                                    echo 'No Rooms Found!';
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

    $(document).ready(function () {
        $('#posts').DataTable();

        $('body').on('click', '.del_item', function () {
            
        }
        $('body').on('click', '.del_item', function () {
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
                    data: {id: id, 'table': 'item'},
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

        $('body').on('change', '.filter_items', function () {
            var id = $(this).val();
            window.location.href = base_url + '/manage_items/' + id;
        });

    });

</script>