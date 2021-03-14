<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Groups</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_users'); ?>">Users</a>
            </li> 
            <li>
                <a href="<?= isset($result->getUser->id) ?  url('manage_items/'.$result->getUser->id):'' ?>">Rooms</a>
            </li>
            <li class="active">
                <strong><?= $title; ?></strong>
            </li>
        </ol>
    </div> 
</div>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
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
                                    USER : <small><?= strtoupper($result->getUser->first_name) . ' ' . strtoupper($result->getUser->last_name )?></small>
                                </h2>
                                <h2 class="font-bold m-b-xs">
                                    TITLE : <small><?= strtoupper($result->title); ?></small>
                                </h2>
                                <hr>
                                <h4>Room's Content</h4>
                                <div class="cus_flex">
                                <?php
                                if (!$result->ItemAllPhotos->isEmpty()) {
                                    foreach ($result->ItemAllPhotos as $val) {
                                        ?>
                                <div class="col-lg-4" id="row_<?= $val->id; ?>" style="width: auto;">
                                            <div class="ibox">
                                                <div class="ibox-content product-box" style="padding: 30px 30px 0px 30px;">
                                                    <div class="product-imitation" style="padding: 0px 0 30px 0px;position: relative;"> 
                                                        <?php if ($val->type == '2') { ?>
                                                        <img title="Double click on image to view full image" id="img_<?= $val->id; ?>" onclick="viewModel(this.id)" class="cus_obj_fit cus_obj_fit_group" src="<?= asset('public/' . $val->image_path) ?>" alt="img">
                                                        <?php }else{ ?>
                                                            <img title="Double click on image to view full image" id="img_<?= $val->id; ?>" onclick="viewModel(this.id)" class="cus_obj_fit" src="<?= asset('public/' . $val->image_path) ?>" alt="img">
                                                        <?php } ?>
<!--
                                                    <div class="product-imitation" style="padding: 0px 0 30px 0px;position: relative;">
                                                        <?php if ($val->type == '2') { ?>
                                                        <figure class="view_fig_img" style="padding-bottom: 35%;background-image:url('<?= asset('public/' . $val->image_path) ?>');">
                                                        </figure>
                                                        
                                                            <?php }else{ ?>
                                                            <figure class="view_fig_img" style="background-image:url('<?= asset('public/' . $val->image_path) ?>');">
                                                            </figure>
                                                            <?php } ?>
-->
                                                        <?php if ($val->type == '0') { ?>
                                                            <?php if ($val->is_labeled) { ?>
                                                                <span class="label label-success" style="position: absolute;bottom: 5px;right: 5px;background: #fff;border-radius: 25px;color: #bababa;display: flex;align-items: center;padding: 2px 5px;font-size: 12px;border: 1px solid;"><i class="fa fa-info-circle" aria-hidden="true" style="color: #fe9832;padding-right: 4px;"></i> Info Added </span>
                                                            <?php } ?>
                                                        <?php } else if ($val->type == '1') { ?>
                                                            <?php if ($val->is_labeled) { ?>
                                                                <span class="label label-success" style="position: absolute;bottom: 5px;right: 5px;background: #fff;border-radius: 25px;color: #bababa;display: flex;align-items: center;padding: 2px 5px;font-size: 12px;border: 1px solid;"><span class="text text-warning"><?= $val->getLabel ? sizeof($val->getLabel) : '' ?></span><i class="fa fa-info-circle" aria-hidden="true" style="color: #fe9832;padding: 0px 4px;;"></i> Info Added </span>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if ($val->is_labeled) { ?>
                                                                <span class="label label-success" style="position: absolute;bottom: 5px;right: 5px;background: #fff;border-radius: 25px;color: #bababa;display: flex;align-items: center;padding: 2px 5px;font-size: 12px;border: 1px solid;"><i class="fa fa-info-circle" aria-hidden="true" style="color: #fe9832;padding-right: 4px;"></i> Info Added </span>
                                                            <?php } ?>
                                                            <span style="position: absolute;bottom: 2px;left: 5px;font-size: 15px;color: #717171;">
                                                                <?= $val->getGroup ? sizeof($val->getGroup->getGroupPhotos) : '' ?>
                                                                <img src="<?= asset('userasset/img/photos-icon.png') ?>" style="">
                                                            </span>
                                                                
                                                        <?php } ?>
                                                    </div>
                                                    <div class="product-desc" style="text-align : center;">
                                                        <?php if ($val->is_labeled) { ?>
                                                            <div class="m-t text-righ" style="display: inline-block;padding: 0px 5px;">
                                                                <?php if ($val->type == '2') { ?>
                                                                    <a href="<?= asset('admin_label_view').'?group_id='. $val->id ?>" class="btn btn-xs btn-outline btn-primary" data-id="<?= $val->id; ?>">Edit Label <i class="fa fa-edit"></i> </a>
                                                                <?php }else{ ?> 
                                                                    <a href="<?= asset('admin_label_view').'?photo_id='. $val->id ?>" class="btn btn-xs btn-outline btn-primary" data-id="<?= $val->id; ?>">Edit Label <i class="fa fa-edit"></i> </a>
                                                                <?php } ?> 
                                                            </div>
                                                        <?php }else{ ?>
                                                            <div class="m-t text-righ" style="display: inline-block;padding: 0px 5px;">
                                                                <a href="<?= asset('admin_label_view').'?photo_id='. $val->id ?>" class="btn btn-xs btn-outline btn-primary" data-id="<?= $val->id; ?>">Add Label <i class="fa fa-plus"></i> </a>
                                                            </div>
                                                        <?php } ?>
                                                        
                                                        <?php if ($val->type == '2') { ?>
                                                            <div class="m-t text-righ" style="display: inline-block;padding: 0px 5px;">
                                                                <a href="<?= url('view_group/' . $val->getGroup->id) ?>" class="btn btn-xs btn-outline btn-primary">View Group</a>
                                                            </div>
                                                        <div class="m-t text-righ" style="display: inline-block;padding: 0px 5px;display:block;">
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-outline btn-primary delet_photo" data-type="group" data-id="<?= $val->getGroup->id ?>">Delete <i class="fa fa-trash"></i> </a>
                                                        </div>
                                                        <?php }else{?> 
                                                        <div class="m-t text-righ" style="display: inline-block;padding: 0px 5px;">
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-outline btn-primary delet_photo" data-id="<?= $val->id; ?>">Delete <i class="fa fa-trash"></i> </a>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else { ?>
                                    No Data!
                                    <?php } ?>
                            </div>
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
    $('body').on('click', '.delet_photo', function () {
        $this = $(this);
        var id = $this.attr('data-id');
        var type = $this.attr('data-type');
        if(type != 'group'){
            type='photos';
        }
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
                data: {id: id, 'table': type,'_token' : '<?= csrf_token() ?>'},
                dataType: 'json',
//                beforeSend: function (request) {
//                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
//                },
                success: function (data) {
                    $('.web-alert').hide();
                    $('.ajax-msg').show();
                    $(".ajax-msg").removeClass("alert-danger");
                    $(".ajax-msg").addClass("alert-success");
                    $(".ajax-body").html(data.msg);
                    $('#row_' + id).remove();
                    swal.close();
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
    
    
    function viewModel(idss){
        //    alert(event.srcElement.id);
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById(event.srcElement.id);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
          modal.style.display = "none";
        }

    }
</script>