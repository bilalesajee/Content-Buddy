<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>
        <div class="page-inside">
            <div class="heading-btn-sec">
                <h3>Add Groups</h3>
                <a href="#" data-toggle="modal" data-target="#photoAddModal" class="cus-btn-green">+ Add Groups</a>
            </div>
            <div class="main-top-row">
                <div class="content-img-detail">
                    <div class="img-with-text">
                        <img src="<?= asset('userasset') ?>/img/group-icon.png" alt="icon">
                        <strong>Maange items</strong>
                        <span>items</span>
                    </div> 
                </div> 
            </div>
            <div class="sort-item-main-sec">
                <div class="sort-item-row list_view"> 
                    <div class="sort-detail-area-sec">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && !$result->isEmpty()) {
                                    foreach ($result as $key => $val) {
                                        ?> 
                                        <tr class="row">
                                            <td><?= $key + 1 ?></td>
                                            <td class="title"><?= $val->title; ?></td>
                                            <td>
                                                <a href="javascript:void(0)" data-id="<?= $val->id ?>" data-img-id="<?= $val->id; ?>" class="edit_label">
                                                    <img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon">
                                                </a>
                                                <a href="javascript:void(0)" data-id="<?= $val->id ?>" class="del_label"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>  
                        <div class="modal fade" id="photoAddModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                            <span class="ajax-label-body"></span>
                                        </div>
                                        <form action="<?= url('create_group'); ?>" method="post" class="image_frm" id="items_photo">
                                            <?= csrf_field(); ?>
                                            <div class="cus-form">
                                                <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                                <h4 class="form_title">Group Title.</h4>
                                                <div class="clone_div">
                                                    <div class="cus-input-row">
                                                        <label>Select Items *</label>
                                                        <select name="item_id">
                                                            <?php
                                                            if ($items_list) {
                                                               
                                                             foreach ($items_list as $item_val) { ?>
                                                            <option value="<?=$item_val->id?>"><?=$item_val->title?></option>
                                                              <?php  }
                                                            }
                                                            ?>
                                                        </select> 
                                                    </div> 
                                                </div> 
                                                <div class="clone_div">
                                                    <div class="cus-input-row">
                                                        <label>Group name *</label>
                                                        <input type="text" name="title" required/> 
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="cus-btn-main">
                                                <input type="button" value="Save Info" class="cus-btn save_items" />
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</main>   
<script>
    $(document).ready(function () {

        $('body').on('click', '.save_items', function () {
            $form = $(this).parents('form');
            //Form validation
            $form.validate({
                rules: {
                    title: "required",
                    title: {
                        required: true
                    }
                },
                messages: {
                    title: "Please enter title"

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
                    data: {'table': 'groups', 'id': id},
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

        //Edit button for label
        $('body').on('click', '.edit_label', function () {
            var id = $(this).attr('data-id');
            var title = $(this).parents('.row').find('.title').text();

            $('#photoAddModal').find('input[name=title]').val(title);
            $('#photoAddModal').find('input[name=edit_id]').val(id);

            $('#photoAddModal').modal('show');
        });

        $('#photoAddModal').on('hidden.bs.modal', function () {
            $('#items_photo')[0].reset();
        });

        $('body').on('click', '.add_more_info', function () {
            $(".clone_div").clone().appendTo("#append_frm");
        });
    });
</script>