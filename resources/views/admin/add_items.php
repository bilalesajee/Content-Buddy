<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Items</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= url('dashboard'); ?>">Home</a>
            </li> 
            <li>
                <a href="<?= url('manage_users'); ?>">User</a>
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
                    <form action="<?= asset('add_item') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Room Name</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="title" value="<?= (old('title')) ? old('title') : (isset($result->title) ? $result->title : ''); ?>"></div>
                            <input type="hidden" name="edit_id" value="<?= isset($edit_id) ? $edit_id : ''; ?>"> 
                            <input type="hidden" name="clone" value="<?= Request::segment(3); ?>"> 
                        </div> 
 
<!--                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea  class="form-control" name="description"><?= (old('description')) ? old('description') : (isset($result->description) ? $result->description : ''); ?></textarea>
                            </div>
                        </div> -->
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="<?= url('manage_items/'.$user_id ); ?>">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
