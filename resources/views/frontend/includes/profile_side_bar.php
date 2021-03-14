<!--sidebar start-->
<div class="cus-sidebar">
    <div class="logo">
        <a href="<?= url('user_dashboard') ?>"><img src="<?= asset('userasset') ?>/img/logo.png" alt="Logo" /></a>
    </div> 
    <div class="side-list">
        <h4><a href="<?= url('claim_my_content/'.$current_id); ?>" style="color: #ff9832;border: 1px solid;padding: 12px 24px;border-radius: 20px;margin-bottom: 20px;">Submit</a></h4>
        <h4><a href="<?= url('user_dashboard'); ?>">My Claimed Contents <span><?= claimedContentsCount(); ?></span></a></h4>
        
        <ul>
            <?php
            if ($user_items) {
                foreach ($user_items as $key => $items) {
                    ?>
                    <li><a class="<?= (encodeId($items->id) == Request::segment(2)) ? 'active' : '' ?>" href="<?= url('item_detail/' . encodeId($items->id)); ?>"><?= $key + 1 ?> - <?= $items->title; ?> <span><img src="<?= asset('userasset') ?>/img/white-right-icon.png" alt="icon" /></span></a></li>
                    <?php
                }
            }
            ?>
            <!--<li><a class="<?= (Request::segment(1) == 'mange_group') ? 'active' : '' ?>" href="<?= url('mange_group/'); ?>">Manage Groups<span><img src="<?= asset('userasset') ?>/img/white-right-icon.png" alt="icon" /></span></a></li>-->

        </ul>
        <div class="add-list"><a href="javascript:void(0)" data-toggle="modal" data-target="#addItemModal">Add New Room</a></div>
    </div>
</div>
<!--sidebar end-->