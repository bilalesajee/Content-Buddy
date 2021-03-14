<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Rooms</h2>
        
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_rooms'); ?>">Rooms</a>
            </li>
            <li class="active">
                <strong><?= $title; ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    <?php include resource_path('views/admin/include/messages.php'); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="posts" data-page-size="15">
                            <thead>
                                <tr>
                                    <th class="footable-visible footable-first-column footable-sortable text_center pad_right">Id<span class="footable-sort-indicator"></span></th> 
                                    <th class="footable-sortable">Title<span class="footable-sort-indicator"></span></th>
                                    <th class="footable-sortable">Created At<span class="footable-sort-indicator"></span></th>
                                    <th class="text-right footable-visible text_center pad_right" data-sort-ignore="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                
                                    foreach ($result as $key=>$val) {
                                        $edit = url('add_room', $val->id); 

                                        $id = $val->id;
                                        $title = $val->title; 
                                        $created_at = date('j M Y h:i a', strtotime($val->created_at));
                                        $options = "&emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>  
                                          &emsp;<a href='javascript:void(0)' class='del_item' data-id='{$val->id}' title='DELETE' ><span class='glyphicon glyphicon-trash'></span></a>";
                                        ?>
                                        <tr id="row_<?= $id; ?>">
                                            <td class="text_center"><?= $key+1; ?></td>   
                                            <td><?= $title; ?></td>
                                            <td><?= $created_at; ?></td>
                                            <td class="text_center"><?= $options; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
                    data: {id: id, 'table': 'room'},
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
    });

</script>