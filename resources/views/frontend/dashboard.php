<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>
        <div class="page-inside">
            <?php include resource_path('views/frontend/includes/messages.php'); ?> 
            <div class="heading-btn-sec">
                <h3>My Claimed Content</h3> 
                <a href="javascript:void(0)" data-toggle="modal" data-target="#addItemModal" class="cus-btn-green">+ Add New Room</a>
            </div>
            <?php if (!$items_deatil->isEmpty()) { ?>
                <div class="items-row">
                    <?php foreach ($items_deatil as $item) { ?>
                            <?php
                            $class_name = 'one_img_show';
                            if(count($item->ItemAllPhotos) == 1){
                                $class_name = 'one_img_show';
                            }
                            if(count($item->ItemAllPhotos) == 2){
                                $class_name = 'two_img_show';
                            }
                            if(count($item->ItemAllPhotos) == 3){
                                $class_name = 'three_img_show';
                            }
                            if(count($item->ItemAllPhotos) >= 4){
                                $class_name = '';
                            }
                            ?>
                        <div class="items-cus-col <?=$class_name?>">
                            <div class="cus-item-img">
                                <?php
                                $total_photos = $item->ItemAllPhotos->count();
                                $remaining_photos = $total_photos - 4;
                                if (!$item->ItemAllPhotos->isEmpty()) {
                                    $counter = 1;
                                    foreach ($item->ItemAllPhotos as $ItemPhotos) {
                                        if ($counter < 4) {
                                            ?>
                                <?php if($ItemPhotos->image_path == 'empty'){
                                    $ItemPhotos->image_path = 'images/profile_images/default.jpg';
                                }?>
                                <a class="img-click" href="<?= url('item_detail/' . encodeId($item->id)); ?>" style="background-image: url('<?= asset('public/'.$ItemPhotos->image_path); ?>')"></a>
                                        <?php } else { ?>
                                            <?php if ($counter == 4) { ?>
                                                <a href="<?= url('item_detail/' . encodeId($item->id)); ?>" class="img-click" style="background-image: url('<?= asset('public/'.$ItemPhotos->image_path);?>')">
                                                    <?php if ($total_photos > 4) { ?>
                                                        <span>+<?= $remaining_photos ?></span>
                                                    <?php } ?>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php
                                        $counter++;
                                    }
                                } else {
                                    ?>
                                    <a class="img-click" href="<?= url('item_detail/' . encodeId($item->id)); ?>"  style="background-image: url('<?= asset('public') ?>/images/users_image/default.jpg')"></a>
                                <?php } ?>
                            </div>
                            <div class="cus-item-details">
                                <input type="hidden" id="item_title<?= $item->id ?>" value="<?= $item->title ?>"/>
                                <input type="hidden" id="item_description<?= $item->id ?>" value="<?= $item->description ?>"/>
                                <h4 class="show_item_title"><?= $item->title ?></h4>
                                <div class="content-img-detail">
                                    <div class="img-with-text">
                                        <img src="<?= asset('userasset') ?>/img/group-icon.png" alt="icon" />
                                        <strong><?= $item->ItemGroups->count() ?></strong>
                                        <span>Groups</span>
                                    </div>
                                    <div class="img-with-text">
                                        <img src="<?= asset('userasset') ?>/img/photos-icon.png" alt="icon" />
                                        <strong><?= $item->ItemAllPhotos->count() ?></strong>
                                        <span>Photos</span>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" data-id="<?= $item->id ?>" class="edit_item"><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                <a href="javascript:void(0)" data-id="<?= $item->id ?>" class="del_item"><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="no-item-sec">
                    <img src="<?= asset('userasset') ?>/img/no-items.png" alt="No Items" />
                    <span>No Item has been added yet!</span>
                </div>
            <?php } ?>
        </div>

    </div>
</main>

<!--edit item model-->
<div class="modal fade" id="editItemModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="cus-form">
                    <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                    <h4>Add Item</h4>
                    <div class="cus-input-row">
                        <label>Item Title *</label>
                        <input type="text" id="edit_title" name="title" required=""/>
                    </div>
                    <div class="cus-input-row">
                        <label>Item Description *</label>
                        <textarea rows="5" class="form-control" id="edit_item_description" name="description" required=""></textarea>
                    </div>
                    <div class="cus-btn-main">
                        <input type="submit" id="edit_item_btn" value="Save" class="cus-btn" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').on('click', '.del_item', function () {
        $this = $(this);
        var id = $this.attr('data-id'); 
        $('.confirm_message').html('Are you sure that you want to delete this complete items?');
        $('#confirmModal').modal({
            backdrop: 'static',
            keyboard: false
        }).one('click', '#delete', function (e) {
            $.ajax({
                url: base_url + 'user_del_item',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: {'item_id': id, '_token': '<?= csrf_token() ?>'},
                success: function (data) {
                     window.location.reload();
                }
            });
//            window.location.reload();
        });
    });

    $('body').on('click', '.edit_item', function () {
        $this = $(this);
        var id = $this.attr('data-id');
        var title = $('#item_title' + id).val();
        var item_description = $('#item_description' + id).val();
        $('#edit_title').val(title);
        $('#edit_item_description').val(item_description);
        $('#editItemModal').modal({
            backdrop: 'static',
            keyboard: false
        }).one('click', '#edit_item_btn', function (e) {
            $('#editItemModal').modal('toggle');
            var new_title = $('#edit_title').val();
            var new_item_description = $('#edit_item_description').val();
            $.ajax({
                url: base_url + 'user_edit_item',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: {'item_id': id, 'title': new_title, 'description': new_item_description, '_token': '<?= csrf_token() ?>'},
                success: function (data) {
                    if (data.status) {
                        window.location.reload();

                    }
                }
            });
//            window.location.reload();
        });
    });
</script>