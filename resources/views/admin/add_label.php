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
            <li>
                <a href="<?= url('manage_items/'.$user_id); ?>">Items</a>
            </li>
            <li>
                <a href="<?= url('view_item').'/'.$item_id; ?>">View Item</a>
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
        <?php include resource_path('views/admin/include/messages.php'); ?>
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
                <?php if(isset($label) && !$label->isEmpty()) {
                    $counter = 1;
                    foreach ($label as $lbl) {
                        ?>
                        <div class="ibox-content"> 
                <strong><?= $counter ?></strong>
                    <form action="<?= asset('admin_add_label') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?= isset($user_id) ? $user_id:'' ?>">
                        <input type="hidden" name="photo_id" value="<?= isset($photo_id) ? $photo_id:'' ?>">
                        <input type="hidden" name="group_id" value="<?= isset($group_id) ? $group_id:'' ?>">
                        <input type="hidden" name="edit_label" value="<?= isset($edit_label) ? $edit_label:'' ?>">
                        <input type="hidden" name="label_id" value="<?= $lbl->id ?>">
<!--                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rooms</label>
                            <div class="col-sm-10">
                                <select name="room_id" class="form-control">
                                    <option value="">Select Room</option>
                                    <?php
                                    if ($rooms) {
                                        foreach ($rooms as $room) {
                                            ?>
                                            <option value="<?= $room->id ?>" <?php if(isset($lbl)){ ?> <?= ($room->id == $lbl->room_id) ? 'selected' : '' ?>  <?php }else{ ?> <?= ($room->id == old('room_id')) ? 'selected' : '' ?> <?php }?> > <?= $room->title ?> </option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Room Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="room_name" value="<?= isset($lbl) ? $lbl->room_name :old('room_name') ?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="item_name" value="<?= isset($lbl) ? $lbl->item_name :old('item_name') ?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’"  class="form-control" name="brand" value="<?= isset($lbl) ? $lbl->brand : old('brand') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Model</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="model" value="<?= isset($lbl) ? $lbl->model : old('model') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Serial Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="serial_no" value="<?= isset($lbl) ? $lbl->serial_no : old('serial_no') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" onkeypress="return event charCode != 45"  class="form-control" name="quantity" value="<?= isset($lbl) ? $lbl->quantity : old('quantity') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Age In years</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" onkeypress="return event charCode != 45"  class="form-control" name="age_in_years" value="<?= isset($lbl) ? $lbl->age_in_years : old('age_in_years') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Age in Months</label>
                            <div class="col-sm-10">
                                <input type="number"  min="1" onkeypress="return event charCode != 45" class="form-control" name="age_in_months" value="<?= isset($lbl) ? $lbl->age_in_months : old('age_in_months') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cost To Replace</label>
                            <div class="col-sm-10">
                                <input type="number"  min="1" onkeypress="return event charCode != 45" class="form-control" name="cost_to_replace" value="<?= isset($lbl) ? $lbl->cost_to_replace : old('cost_to_replace') ?>"></div>
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
                                <a class="btn btn-white" href="<?= url('view_item/'. $item_id); ?>">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php $counter++; } }else{ ?>
                                        <div class="ibox-content"> 
                    <?php include resource_path('views/admin/include/messages.php'); ?>
                    <form action="<?= asset('admin_add_label') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?= isset($user_id) ? $user_id:'' ?>">
                        <input type="hidden" name="photo_id" value="<?= isset($photo_id) ? $photo_id:'' ?>">
                        <input type="hidden" name="group_id" value="<?= isset($group_id) ? $group_id:'' ?>">
                        <input type="hidden" name="edit_label" value="<?= isset($edit_label) ? $edit_label:'' ?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rooms</label>
                            <div class="col-sm-10">
                                <select name="room_id" class="form-control">
                                    <option value="">Select Room</option>
                                    <?php
                                    if ($rooms) {
                                        foreach ($rooms as $room) {
                                            ?>
                                            <option value="<?= $room->id ?>" <?php if(isset($lbl)){ ?> <?= ($room->id == $lbl->room_id) ? 'selected' : '' ?>  <?php }else{ ?> <?= ($room->id == old('room_id')) ? 'selected' : '' ?> <?php }?> > <?= $room->title ?> </option> 
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="item_name" value="<?= isset($lbl) ? $lbl->item_name :old('item_name') ?>">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’" class="form-control" name="brand" value="<?= isset($lbl) ? $lbl->brand : old('brand') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Model</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="model" value="<?= isset($lbl) ? $lbl->model : old('model') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" name="quantity" value="<?= isset($lbl) ? $lbl->quantity : old('quantity') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Age In years</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" name="age_in_years" value="<?= isset($lbl) ? $lbl->age_in_years : old('age_in_years') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Age in Months</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" name="age_in_months" value="<?= isset($lbl) ? $lbl->age_in_months : old('age_in_months') ?>"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cost To Replace</label>
                            <div class="col-sm-10">
                                <input type="number"  class="form-control" name="cost_to_replace" value="<?= isset($lbl) ? $lbl->cost_to_replace : old('cost_to_replace') ?>"></div>
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
                                <a class="btn btn-white" href="<?= url('view_item/'. $item_id); ?>">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
