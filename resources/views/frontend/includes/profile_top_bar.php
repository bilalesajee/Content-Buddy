 <!--header start-->
                <header>
                    <div class="head-left">
                        <span class="bread-heading">You are in:</span>
                        <ul class="cus-bread">
                            <li><a href="<?= url('user_dashboard') ?>">Home</a><?php if(isset($group_name)) { ?> <a href="<?= url('item_detail/' . encodeId($item_id)); ?>"><?php } ?><span> <?= isset($item_name) ? $item_name : '' ?> </span> <?php if(isset($group_name)) { ?> </a> <?php } ?> <?php if(isset($group_name)) { ?><span><?= $group_name ?></span><?php } ?></li>
                        </ul>
                        <div class="menu-icon">
                            <a href="#"><img src="<?= asset('userasset') ?>/img/menu-icon.png" alt="Icon" /></a>
                        </div>
                        <div class="logo">
                            <a href="<?= url('user_dashboard') ?>"><img src="<?= asset('userasset') ?>/img/logo.png" alt="Logo" /></a>
                        </div>
                    </div>
                    <div class="head-right">
                        <div class="cus-pro-main">
                            <a class="pro-drop-main" href="#">
                                <figure style="background-image: url('<?= isset($current_photo) ? $current_photo : '' ?>')"></figure>
                                <span class="pro-text"><?= isset($current_user_name) ? $current_user_name:'' ?></span>
                                <span class="drop-icon"><img src="<?= asset('userasset') ?>/img/orange-bot-icon.png" alt="icon" /></span>
                            </a>
                            <ul class="cus-pro-drop">
                                <li><a href="<?= url('edit_profile') ?>">Edit Profile</a></li>
                                <li><a href="<?= url('user_change_password') ?>">Change Password</a></li>
                                <li><a href="<?= url('logout') ?>">Log Out</a></li>
                            </ul> 
                        </div>
                    </div>
                </header>
                <!--header end-->