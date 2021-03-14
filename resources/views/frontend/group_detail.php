<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>
        <div class="page-inside">
            <div class="heading-btn-sec">
                <h3><?= $group->title ?></h3> 
            </div>
            <?php include resource_path('views/frontend/includes/messages.php'); ?> 
            <div class="main-top-row">
                <div class="content-img-detail"> 
                    <div class="img-with-text">
                        <img src="<?= asset('userasset') ?>/img/photos-icon.png" alt="icon">
                        <strong><?= $photos_count ? $photos_count : '0' ?></strong>
                        <span>Photos</span>
                    </div>
                </div>
                <div class="sort-btn-right">
                    <a href="#" id="add_more_image" data-toggle="modal" data-target="#photoAddModal" class="cus-btn-green cus-btn-image"><img src="<?= asset('userasset') ?>/img/c-group-icon.png" alt="icon"> Add More Photos</a>
                    <!--<a href="javascript:void(0)" class="cus-btn-green cus-btn-image"><img src="<?= asset('userasset') ?>/img/c-group-icon.png" alt="icon"> Select Photos</a>-->
                    <span class="sort-selected-total-txt grid_view_action" style="display: none"><span class="total_selectd">0</span></span> 
                    <a href="javascript:void(0)" class="cus-btn-red cus-btn-image del_check_images grid_view_action" style="display: none"><img src="<?= asset('userasset') ?>/img/del-icon-white.png" alt="icon"> Delete</a>
                    <a href="javascript:void(0)" class="cus-btn-white cus-btn-image cancel_selected grid_view_action" style="display: none">Cancel</a>

                </div>
            </div>
            <div class="group-info-sec"> 
                <?php  
                if ($group->getGroupLabel) { ?> 
                        <input type="hidden" id="room_id<?= $group->getGroupLabel->id ?>" value="<?= $group->getGroupLabel->room_id ?>">
                        <input type="hidden" id="item_name<?= $group->getGroupLabel->id ?>" value="<?= $group->getGroupLabel->item_name ?>">
                         <div class="group-info-col">
                            <div class="heading-btn-sec">
                                <h4>Group Info</h4>
                                <div>
                                    <a href="javascript:void(0)" data-id="<?= $group->getGroupLabel->id ?>" class="edit_label"> <img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                    <a href="javascript:void(0)" data-id="<?= $group->getGroupLabel->group_id ?>" class="del_group"> <img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                </div>
                            </div>
                            <div class="sort-bot-row">
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Room Name</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->room_name ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Item Name</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->item_name ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Brand/ Manufacture</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->brand ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Model</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->model ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Serial Number</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->serial_no ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Quantity Lost</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->quantity ?></span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Age</span>
                                    <span class="sort-bot-detail"><?= $group->getGroupLabel->age_in_years ?> years, <?= $group->getGroupLabel->age_in_months ?> months</span>
                                </div>
                                <div class="sort-bot-col">
                                    <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                    <span class="sort-bot-detail"><span class="green-txt">$<?= $group->getGroupLabel->cost_to_replace ? $group->getGroupLabel->cost_to_replace : '_' ?></span></span>
                                </div>
                            </div>
                        </div>
                        
                        <!--More info model-->
<div class="modal fade" id="edit_group_label" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <span class="ajax-label-body"></span>
                </div>
                <form action="<?= url('edit_label'); ?>" method="post" id="edit_label_frm">
                    <?= csrf_field(); ?>
                    <div class="cus-form">
                        <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                        <h4 class="form_title">Label info</h4>
<!--                        <div class="cus-input-row show_error">
                            <label>Room name *</label>
                            <select name="room_id" class="form-control">
                                <?php
                                if ($room_list) {
                                    foreach ($room_list as $room) {
                                        ?>
                                        <option value="<?= $room->id; ?>" <?= ($group->getGroupLabel->room_id == $room->id)?'selected':'';?>><?= $room->title; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <br>
                        </div>-->
                        <input type="hidden" name="label_id" value="<?= $group->getGroupLabel->id ?>"/>
                        <div class="cus-input-row">
                            <label>Room name *</label>
                            <input type="text" name="room_name"  class="cus-input-row" value="<?= $group->getGroupLabel->room_name ?>"  required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Item name *</label>
                            <input type="text" name="item_name"  class="cus-input-row" value="<?= $group->getGroupLabel->item_name ?>"  required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Brand/Manufacture *</label>
                            <input type="text" name="brand" placeholder="If no brand or manufacture name, enter ‘Unknown’"  class="cus-input-row" value="<?= $group->getGroupLabel->brand ?>" required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Model *</label>
                            <input type="text" name="model" placeholder="If no model name, enter ‘Unknown’" class="cus-input-row" value="<?= $group->getGroupLabel->model ?>" required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Serial Number *</label>
                            <input type="text" name="serial_no" placeholder="If no serial number, enter ‘Unknown’" class="cus-input-row" value="<?= $group->getGroupLabel->serial_no ?>" required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Quantity Lost *</label>
                            <input type="number" name="quantity" class="cus-input-row"  min="1" onkeypress="return event.charCode != 45"  value="<?= $group->getGroupLabel->quantity ?>" required/>
                        </div>
                        <div class="cus-input-row">
                            <label>Cost to replace *</label>
                            <input type="number" name="cost_to_replace" min="1"  class="cus-input-row"  onkeypress="return event.charCode != 45"  value="<?= $group->getGroupLabel->cost_to_replace; ?>" required/>
                        </div>
                        <div class="cus-input-row-double">
                            <div class="cus-input-row">
                                <label>Age (years) *</label>
                                <input type="number" name="age_in_years" min="0"  class="cus-input-row"  onkeypress="return event.charCode != 45"  value="<?= $group->getGroupLabel->age_in_years ?>" required/>
                            </div>
                            <div class="cus-input-row">
                                <label>Age (months) *</label>
                                <input type="number" name="age_in_months" min="1"  class="cus-input-row"  onkeypress="return event.charCode != 45" value="<?= $group->getGroupLabel->age_in_months ?>" required/>
                            </div>
                        </div>
                        <div class="cus-btn-main">
                            <input type="submit" value="Update Info" class="cus-btn save_label" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End More info model-->
                         
                <?php } ?>
                <div class="sort-item-thumb-row">
                    <?php
                    if (!$group->getGroupPhotos->isEmpty()) {
                        foreach ($group->getGroupPhotos as $GroupPhoto) {
                            $item_image_path = asset('public/images/users_image/default.jpg');
                            if ($GroupPhoto->image_path != 'empty') {
                                $item_image_path = asset('public/'.$GroupPhoto->image_path);
                            }
                            ?>
                            <div class="sort-item-thumb-col">
                                <input class="checkbox-click" type="checkbox" name="photos[]" id="group_photo<?= $GroupPhoto->id ?>" value="<?= $GroupPhoto->id ?>" />
                                <label for="group_photo<?= $GroupPhoto->id ?>" style="background-image: url('<?= $item_image_path; ?>')">
                                    <span class="sort-checked-box"><img src="<?= asset('userasset') ?>/img/tick-fill-white.png" alt="icon"></span>
                                </label>
                                <a class="group-image-view-fancy" href="<?= $item_image_path; ?>" data-fancybox="gallery"><i class="fa fa-expand" aria-hidden="true"></i></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Select photo model-->
            <div class="modal fade" id="photoAddModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                <span class="ajax-label-body"></span>
                            </div>
                            <form action="<?= url('upload_group_photos'); ?>" method="post" class="upload_img" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="cus-form">
                                    <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                    <h4 class="form_title">Group Images</h4>

                                    <div class="clone_div">
                                        <div class="cus-input-row">
                                            <label>Select photos *</label>
<!--                                            <input type="file" name="group_image[]" accept="image/*" required multiple="" onchange="readFile(this);"/>  -->
                                             <input type="file" class="form-control" name="group_image[]" id="photo" accept=".png, .jpg, .jpeg" onchange="readFile(this);" multiple>
                                            <input type="hidden" name="item_id" value="<?=$group->item_id;?>"/> 
                                            <input type="hidden" name="group_id" value="<?=$group->id;?>"/> 
                                        </div> 
                                    </div> 
                                    <div class="row">
                                    <div id="photos"></div>
                                        </div>
                                </div>
                                <div class="cus-btn-main">
                                    <input type="submit" value="Save Info" class="cus-btn save_items" />
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End select photo model-->

        </div>
    </div>
</main>
<script>    
    $(document).ready(function () {  
        $(".group-image-view-fancy").fancybox({
            loop: true
        });
       
        $('#edit_label_frm').validate({
                rules: {
                    group_id: "required",
                    group_image: "required",
                    rood_id: "required",
                   quantity: {
                            required: true,
                            specialChars: true
                        },
                    age_in_years: {
                            required: true,
                            specialChars: true
                        },
                    age_in_months: {
                            required: true,
                            specialChars: true
                        },
                    brand: {
                            required: true,
                            specialChars: true
                        },
                    model: {
                            required: true 
                        },
                    item_name: {
                            required: true,
                            specialChars: true
                        },
                    cost_to_replace: {
                            required: true,
                            specialChars: true
                        },
                },
                messages:{
                    image: "Please upload images"
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("help-block"); 
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
        
        $('.upload_img').validate({
                rules: {
                    image: "required",
                },
                messages:{
                    image: "Please upload images"
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("help-block"); 
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
            
        $('body').on('click', '.checkbox-click', function () {
            
            var chLen = $("input[name='photos[]']:checked").length;
            if(chLen == 1){
                $('.total_selectd').text(chLen+' Item Selected');
            }
            if(chLen > 1){
                $('.total_selectd').text(chLen+' Items Selected');
            }
            
            if (chLen > 0) {
                var searchIDs = $(".grid_view input:checkbox:checked").map(function () {
                    return $(this).val();
                }).get();            
                $('.grid_view_action').show();
                $('#add_more_image').hide();
            } else {
                $('.grid_view_action').hide();
                $('#add_more_image').show();
            }
        });

        $('body').on('click', '.cancel_selected', function () {
            $(".sort-item-thumb-row input:checkbox:checked").trigger('click');
        });

        $('body').on('click', '.del_check_images', function () {
            var searchIDs = $(".sort-item-thumb-row input:checkbox:checked").map(function () {
                return $(this).val();
            }).get();
            var id = JSON.stringify({
                id: searchIDs
            });

            var total_items = searchIDs.length;
            $('.confirm_message').html('Are you sure to delete ' + total_items + ' selected images?');
            $('#confirmModal').modal({
                backdrop: 'static',
                keyboard: false
            }).one('click', '#delete', function (e) {
                $.ajax({
                    url: base_url + 'delete_record',
                    type: 'POST',
                    dataType: 'json',
                    data: {'table': 'multi_label', 'id': id},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.ajax-msg').show();
                            $(".ajax-msg").removeClass("alert-danger");
                            $(".ajax-msg").addClass("alert-success");
                            $(".ajax-body").html(data.message);
                            $('html').animate({scrollTop: 0}, 1000);
                            setTimeout(function () {
                                window.location.reload();
                            }, 200);
                        } else {
                            $('.ajax-msg').show();
                            $(".ajax-msg").removeClass("alert-danger");
                            $(".ajax-msg").addClass("alert-success");
                            $(".ajax-body").html(data.message);
                        }
                    }
                });
            });
        });
    });
//Edit button for label
    $('body').on('click', '.edit_label', function () { 
        $('#edit_group_label').modal('show');
    });

    //Delete group
    $('body').on('click', '.del_group', function () {
        var id = $(this).attr('data-id');
        $('.confirm_message').html('Are you sure to delete this group and contents?');
        $('#confirmModal').modal({
            backdrop: 'static',
            keyboard: false
        }).one('click', '#delete', function (e) {
            $.ajax({
                url: base_url + 'delete_record',
                type: 'POST',
                dataType: 'json',
                data: {'table': 'groups_photos', 'id': id},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                },
                success: function (data) {
                    if (data.success) {
                        $('.ajax-msg').show();
                        $(".ajax-msg").removeClass("alert-danger");
                        $(".ajax-msg").addClass("alert-success");
                        $(".ajax-body").html(data.message);
                        $('html').animate({scrollTop: 0}, 1000);
                        setTimeout(function () { 
                            window.location.href = base_url+'item_detail/<?= encodeId($group->item_id)?>';
                        }, 200);
                    } else {
                        $('.ajax-msg').show();
                        $(".ajax-msg").removeClass("alert-danger");
                        $(".ajax-msg").addClass("alert-success");
                        $(".ajax-body").html(data.message);
                    }
                }
            });
        });
    });
     
</script>
<script>
	function readFile(input) {
  	$("#status").html('Processing...');
    counter = input.files.length;
		for(x = 0; x<counter; x++){
			if (input.files && input.files[x]) {

				var reader = new FileReader();

				reader.onload = function (e) {
                    console.log(e.target.result);
        	$("#photos").append('<div class="col-md-3 col-sm-3 col-xs-3"><div class="imagess" style="background-image:url('+e.target.result+');"></div></div>');
				};

				reader.readAsDataURL(input.files[x]);
			}
    }
    if(counter == x){$("#status").html('');}
  }
  $('body').on('click', '.save_items', function () {
      
            var $fileUpload = $("input[type='file']");
            if (parseInt($fileUpload.get(0).files.length)>20){
                alert("You can only upload a maximum of 20 files at a time");
                $('#photo').val('');
                $('#photos').html('');
                return false;
            }else{
                return true;
            }
        });
</script>