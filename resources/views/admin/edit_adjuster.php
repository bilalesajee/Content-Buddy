<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User</h2>
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
                    <form action="<?= asset('add_user') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="first_name" value="<?= (old('first_name')) ? old('first_name') : (isset($result->first_name) ? $result->first_name : ''); ?>"></div>
                            <input type="hidden" name="edit_id" value="<?= isset($edit_id) ? $edit_id : ''; ?>"> 
                            <input type="hidden" name="clone" value="<?= Request::segment(3); ?>"> 

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="last_name" value="<?= (old('last_name')) ? old('last_name') : (isset($result->last_name) ? $result->last_name : ''); ?>"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="username" value="<?= (old('username')) ? old('username') : (isset($result->username) ? $result->username : ''); ?>" maxlength="50"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10"><input type="text"  class="form-control" name="email" value="<?= (old('email')) ? old('email') : (isset($result->email) ? $result->email : ''); ?>"></div>
                        </div>
                        <input type="hidden" name="type" value="adjuster">
                         
                        
                        <?php if (isset($edit_id) && Request::segment(3) == '') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Change Password</label>
                                <div class="col-sm-10"><input type="password"  class="form-control" name="change_password" value=""></div>
                            </div>

                        <?php } else { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10"><input type="password"  class="form-control" name="password" value=""></div>
                            </div>

                        <?php } ?>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">profile image</label>
                            <div class="col-sm-10">
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Select file</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" accept=".png, .jpg, .jpeg" name="image"/>
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div> 
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="<?= url('manage_users'); ?>" type="submit">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
