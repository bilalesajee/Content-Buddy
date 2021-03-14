<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>

        <div class="page-inside">
            <?php include resource_path('views/frontend/includes/messages.php'); ?> 
            <div class="heading-btn-sec">
                <h3><?= $result->getItems->title ? $result->getItems->title:'' ?></h3> 
                <a href="#" data-toggle="modal" data-target="#myModal<?= $result->id; ?>" class="cus-btn-orange cus-btn-image">Label Multiple Items in This Photo</a>
            </div> 

            <div class="main-top-row">
                <div class="content-img-detail">
                </div>
                <div class="sort-btn-right">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadPhoto" class="cus-btn-green cus-btn-image">
                        <img src="<?= asset('userasset/img/c-group-icon.png') ?>" alt="icon"> Change Photo</a>
                </div>
            </div>

            <div class="group-info-sec">


                <div class="group-info-col group-info-new">
                    <?php
                    if ($result->getLabel) {
                        foreach ($result->getLabel as $val) {
                            ?>          
                            <div class="group_info_content">
                                <div class="heading-btn-sec">
                                    <h4 class="label_title"><?= $val->item_name ?></h4>
                                    <div> 
                                        <a href="javascript:void(0)" data-id="<?= $val->id ?>" data-img-id="<?= $result->id; ?>" class="edit_label">
                                            <img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon">
                                        </a>
                                        <a href="javascript:void(0)" data-id="<?= $result->id ?>" class="del_label"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a> 
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Room Name</span>
                                        <span class="sort-bot-detail label_brand"><?= $val->room_name ?></span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span style="display: none" class="label_room_id"><?= $val->room_id ?></span>
                                        <span class="sort-bot-detail label_brand"><?= $val->brand ?></span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model</span>
                                        <span class="sort-bot-detail label_model"><?= $val->model ?></span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Serial Number</span>
                                        <span class="sort-bot-detail label_model"><?= $val->serial_no ?></span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail label_quantity"><?= $val->quantity ?></span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="label_age_year" style="display: none;"><?= $val->age_in_years ?></span>
                                        <span class="label_age_month" style="display: none;"><?= $val->age_in_months ?></span>

                                        <span class="sort-bot-detail"><?= $val->age_in_years ?> years, <?= $val->age_in_months ?> months</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="label_cost_to_replace" style="display: none;"><?= $val->cost_to_replace ?></span>
                                        <span class="sort-bot-detail"><span class="green-txt">$<?= $val->cost_to_replace ?></span></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="sort-item-thumb-row multi_items_image">
                    <?php
                    $img_path = asset('public/images/users_image/default.jpg');
                    if ($result->image_path != 'empty') {
                        $img_path = asset('public/'.$result->image_path);
                    }
                    ?>
                    <?php /* <figure style="background-image: url('<?= $img_path ?>')"></figure> */ ?>
                    <a href="<?= $img_path ?>" class="data-fancy-big" data-fancybox="gallery" style="background-image: url('<?= $img_path ?>')"></a>
                </div>
            </div>
        </div>
        <!-- Add multiple info model -->
        <!--More info model-->
        <div class="modal fade" id="myModal<?= $result->id; ?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <span class="ajax-label-body"></span>
                        </div>
                        <form action="<?= url('add_item_label'); ?>" method="post" class="label_frm">
                            <?= csrf_field(); ?>
                            <div class="cus-form">
                                <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                <h4 class="form_title">Label info</h4>
<!--                                <div class="cus-input-row show_error">
                                    <label>Room name *</label>
                                    <select name="room_id" required>
                                        <?php
                                        if ($room_list) {
                                            foreach ($room_list as $room) {
                                                ?>
                                                <option value="<?= $room->id; ?>"><?= $room->title; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden"  name="type_item" value=""/>
                                    <input type="hidden" class="hidden_val" name="edit_id" value=""/>
                                    <input type="hidden" name="image_id" value="<?= $result->id; ?>" />
                                    <br>
                                </div>-->
                                <div class="cus-input-row">
                                    <label>Room name *</label>
                                    <input type="text" name="room_name" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>Item name *</label>
                                    <input type="text" name="item_name" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>Brand/Manufacture *</label>
                                    <input type="text" name="brand" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>Model*</label>
                                    <input type="text" name="model" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>S/N *</label>
                                    <input type="text" name="serial_no" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>Quantity Lost *</label>
                                    <input type="number" min="1" onkeypress="return event.charCode != 45" name="quantity" required/>
                                </div>
                                <div class="cus-input-row">
                                    <label>Cost to replace *</label>
                                    <input type="number" min="1" onkeypress="return event.charCode != 45" name="cost_to_replace" required/>
                                </div>
                                <div class="cus-input-row-double">
                                    <div class="cus-input-row">
                                        <label>Age (years) *</label>
                                        <input type="number" min="0" onkeypress="return event.charCode != 45" name="age_in_years" required/>
                                    </div>
                                    <div class="cus-input-row">
                                        <label>Age (months) *</label>
                                        <input type="number" min="1" onkeypress="return event.charCode != 45" name="age_in_months" required/>
                                    </div>
                                </div>
                                <div class="cus-btn-main">
                                    <input type="button" value="Save Info" class="cus-btn save_label" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="uploadPhoto" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <span class="ajax-label-body"></span>
                        </div>
                        <form action="<?= url('upload_item_photos'); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="cus-form">
                                <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                <h4 class="form_title">Change item photo</h4> 
                                <div class="cus-input-row">
                                    <label>Select image *</label>
                                    <input type="file" name="image" accept="image/*" required/>
                                    <input type="hidden" name="edit_id" value="<?= $result->id; ?>" /> 
                                </div>  
                                <div class="cus-btn-main">
                                    <input type="submit" value="Save" class="cus-btn" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End More info model-->
        <!-- End Add multiple info model -->
    </div>
</main>

<script>
    $(document).ready(function () {
        $('body').on('click', '.checkbox-click', function () {
            var chLen = $("input[name='ungroup_photos[]']:checked").length;
            $('.total_selectd').text(chLen);
            if (chLen > 0) {
                var searchIDs = $(".grid_view input:checkbox:checked").map(function () {
                    return $(this).val();
                }).get();
                var id = JSON.stringify(searchIDs);
                $('#addToModal .label_frm').find("input[name='items_ids']").val(id);
                $('.grid_view_action').show();
            } else {
                $('.grid_view_action').hide();
            }
        });
        $('body').on('click', '.cancel_selected', function () {
            $(".grid_view input:checkbox:checked").trigger('click');
        });

        $('body').on('click', '.save_label', function () {
            $form = $(this).parents('form');
            //Form validation
            $form.validate({
                rules: {
                    rood_id: "required",
                    quantity: "required",
                    age_in_years: "required",
                    age_in_months: "required",
                    brand: {
                        required: true,
                        minlength: 2
                    },
                    model: {
                        required: true,
                        minlength: 2
                    },
                    item_name: {
                        required: true,
                        minlength: 2
                    },
                    cost_to_replace: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    quantity: "Please enter quantity",
                    age_in_years: "Please enter age in years",
                    age_in_months: "Please enter age in months",
                    brand: "Please enter brand",
                    model: "Please enter model",
                    item_name: "Please enter item name",
                    cost_to_replace: "Please enter cost to replace"
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
            if ($form.valid()) {
                var formData = new FormData($form[0]);
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                            $('html .modal').animate({scrollTop: 0}, 1000);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('.ajax-label').show();
                        var response = $.parseJSON(data.responseText);
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                    }
                });
            }
        }); //End save label function

        $('body').on('click', '.save_photos', function () {
            $form = $(this).parents('form');
            var type = $form.find("input[name='type']");
            if (type == 'single') {
                var validation_rule = {
                    image: {
                            required: true 
                        },
                    rood_id: {
                            required: true 
                        },
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
                            required: true,
                            specialChars: true
                        },
                    item_name: {
                            required: true,
                            specialChars: true
                        },
                    cost_to_replace: {
                            required: true,
                            specialChars: true
                        },
                };
            } else if (type == 'multi') {
                var validation_rule = {
                    group_image: "required",
                };
            } else {
                var validation_rule = {
                    group_id: "required",
                    group_image: "required",
                    rood_id: "required",
                    quantity: "required",
                    age_in_years: "required",
                    age_in_months: "required",
                    brand: "required",
                    model: "required",
                    item_name: "required",
                    cost_to_replace: "required",
                };
            }
            $form.validate({
                rules: validation_rule,
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
            if ($form.valid()) { 
                var formData = new FormData($form[0]);
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                            $('html .modal').animate({scrollTop: 0}, 1000);
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else { 
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $('.ajax-label').show();
                        var response = $.parseJSON(data.responseText);
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                    }
                });
            }
        }); //End save label function

        $('body').on('click', '.del_label', function () {
            var id = $(this).attr('data-id');
            $('.confirm_message').html('Are you sure to delete this label?');
            $('#confirmModal').modal({
                backdrop: 'static',
                keyboard: false
            }).one('click', '#delete', function (e) { 
                $.ajax({
                    url: base_url + 'delete_record',
                    type: 'POST',
                    dataType: 'json',
                    data: {'table': 'label', 'id': id},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.ajax-msg').show();
                            $(".ajax-msg").removeClass("alert-danger");
                            $(".ajax-msg").addClass("alert-success");
                            $(".ajax-body").html(data.message);
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
        //Edit button for label
        $('body').on('click', '.edit_label', function () {
            var id = $(this).attr('data-id');
            var img_id = $(this).attr('data-img-id');
            var type = $(this).attr('data-type');
            var group_id = $(this).attr('data-group-id');


            var label_room_id = $(this).parents('.group_info_content').find('.label_room_id').text();
            var label_title = $(this).parents('.group_info_content').find('.label_title').text();
            var brand = $(this).parents('.group_info_content').find('.label_brand').text();
            var model = $(this).parents('.group_info_content').find('.label_model').text();
            var quantity = $(this).parents('.group_info_content').find('.label_quantity').text();
            var age_year = $(this).parents('.group_info_content').find('.label_age_year').text();
            var age_month = $(this).parents('.group_info_content').find('.label_age_month').text();
            var age_year = $(this).parents('.group_info_content').find('.label_age_year').text();
            var cost_to_repair = $(this).parents('.group_info_content').find('.label_cost_to_replace').text();
            $('#myModal' + img_id).find('select').val(label_room_id);
            $('select').niceSelect('update');

            $('#myModal' + img_id).find('input[name=edit_id]').val(id);
            if (typeof group_id != 'undefined' && group_id != '') {
                //There will be group id in img_id
                $('#myModal' + img_id).find('input[name=type_item]').val('group');
                $('#myModal' + img_id).find('input[name=edit_id]').val(group_id);
            }
            $('#myModal' + img_id).find('input[name=item_name]').val(label_title);
            $('#myModal' + img_id).find('input[name=brand]').val(brand);
            $('#myModal' + img_id).find('input[name=model]').val(model);
            $('#myModal' + img_id).find('input[name=quantity]').val(quantity);
            $('#myModal' + img_id).find('input[name=cost_to_replace]').val(cost_to_repair);
            $('#myModal' + img_id).find('input[name=age_in_years]').val(age_year);
            $('#myModal' + img_id).find('input[name=age_in_months]').val(age_month);

            $('#myModal' + img_id).modal('show');
        });

        $('.modal').on('hidden.bs.modal', function () {
            $('.label_frm')[0].reset();
            $('.hidden_val').val('');
        });
    });
</script>