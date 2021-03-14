<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Groupsa</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_groups'); ?>">Group</a>
            </li>
            <li class="active">
                <strong><?= $title ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $title ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div> 
                <div class="ibox-content"> 
                    <?php include resource_path('views/admin/include/messages.php'); ?>
                    <form action="<?= asset('add_group') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">User</label>
                            <div class="col-sm-10">
                                <?php
                                $old_user_id = (old('user_id')) ? old('user_id') : (isset($result->getUser->id) ? $result->getUser->id : '');
                                ?>
                                <select name="user_id" class="form-control user_list">
                                    <option value="">Select user</option>
                                    <?php
                                    if ($users) {
                                        foreach ($users as $user) {
                                            ?>
                                            <option value="<?= $user->id ?>" <?= ($user->id == $old_user_id) ? 'selected' : '' ?>><?= $user->first_name . ' ' . $user->last_name ?></option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Items</label>
                            <div class="col-sm-10">
                                <?php
                                $old_val = (old('item_id')) ? old('item_id') : (isset($result->item_id) ? $result->item_id : '');
                                ?>
                                <select name="item_id" class="form-control">
                                    <option value="">Select Items</option>
                                    <?php
                                    if ($users) {
                                        foreach ($users as $user_list) {
                                            ?>
                                            <optgroup label="<?= $user_list->first_name . ' ' . $user_list->last_name ?>" class="all_groups user_<?= $user_list->id; ?>" <?=($user_list->id != $old_user_id) ? 'style="display: none"' :''; ?>> 
                                                <?php
                                                if ($user_list->userItems) {
                                                    foreach ($user_list->userItems as $item) {
                                                        ?> 

                                                        <option class="options" value="<?= $item->id ?>" <?= ($item->id == $old_val) ? 'selected' : '' ?>><?= $item->title ?></option> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </optgroup>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="title" value="<?= (old('title')) ? old('title') : (isset($result->title) ? $result->title : ''); ?>"></div>
                            <input type="hidden" name="edit_id" value="<?= isset($edit_id) ? $edit_id : ''; ?>"> 
                            <input type="hidden" name="clone" value="<?= Request::segment(3); ?>"> 

                        </div>   
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="<?= url('manage_groups'); ?>" type="submit">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('body').on('change', '.user_list', function () {
            var id = $(this).val();
            $('.all_groups').hide();
            $('.user_' + id).show();
        });
    });
</script>
