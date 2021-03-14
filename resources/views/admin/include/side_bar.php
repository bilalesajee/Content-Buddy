<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header"> 
                <div class="dropdown profile-element">
                    <span>
                        <a href="<?= url('dashboard'); ?>">
                            <?php if ($data->photo) {
                                ?>
                                <img alt="image" class="img-circle" src="<?= asset('public') . '/' . $data->photo ?>" />
                            <?php } else { ?>
                                <img alt="image" class="img-circle" src="<?= asset('public/admin'); ?>/profile_images/profile_small.jpg" />
                            <?php } ?>
                        </a>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $data->first_name . ' ' . $data->last_name ?></strong>
                            </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= url('profile'); ?>">Profile</a></li>
                        <li><a href="<?= url('change_password'); ?>">Change Password</a></li> 
                        <li class="divider"></li>
                        <li><a href="<?= url('admin_logout'); ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    CB+
                </div>
            </li>  
            
            <li class="<?= ($tab == 'user' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?= ($title == 'Add User') ? 'active' : '' ?>"><a href="<?= url('add_user') ?>">Create New</a></li>
                    <li class="<?= ($title == 'Manage Users') ? 'active' : '' ?>"><a href="<?= url('manage_users'); ?>">All Users</a></li>
                    <li class="<?= ($title == 'Active Users') ? 'active' : '' ?>"><a href="<?= url('manage_users/active'); ?>">Active Users</a></li>
                    <li class="<?= ($title == 'Inactive Users') ? 'active' : '' ?>"><a href="<?= url('manage_users/inactive'); ?>">Pending Users</a></li>
                    <li class="<?= ($title == 'Blocked Users') ? 'active' : '' ?>"><a href="<?= url('manage_users/blocked'); ?>">Blocked Users</a></li>
                    <!--<li class="<?= ($title == 'Manage Adjuster') ? 'active' : '' ?>"><a href="<?= url('manage_adjuster'); ?>">Manage Adjuster</a></li>-->
                </ul>
            </li>   

<!--            <li class="<?= ($tab == 'items' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Items</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse"> 
                    <li class="<?= ($title == 'Add Item') ? 'active' : '' ?>">
                        <a href="<?= url('add_item'); ?>">Add Items</a>
                    </li>
                    <li class="<?= ($title == 'Manage Items' || $title == 'View Item') ? 'active' : '' ?>">
                        <a href="<?= url('manage_items'); ?>">Manage Items</a>
                    </li>
                </ul>
            </li>   -->

<!--            <li class="<?= ($tab == 'photo' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-camera"></i> 
                    <span class="nav-label">Photos</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse"> 
                    <li class="<?= ($title == 'Manage Photos' || $title == 'View Photos') ? 'active' : '' ?>">
                        <a href="<?= url('manage_photos'); ?>">Manage Photos</a>
                    </li>
                </ul>
            </li>   -->
            
<!--            <li class="<?= ($tab == 'label' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-tags"></i> <span class="nav-label">Labels</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse"> 
                    <li class="<?= ($title == 'Add Label') ? 'active' : '' ?>">
                        <a href="<?= url('admin_label_view'); ?>">Add Label</a>
                    </li>
                </ul>
            </li>  -->

<!--            <li class="<?= ($tab == 'group' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Groups</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse"> 
                    <li class="<?= ($title == 'Add Group') ? 'active' : '' ?>">
                        <a href="<?= url('add_group'); ?>">Add Group</a>
                    </li>
                    <li class="<?= ($title == 'Manage Group') ? 'active' : '' ?>">
                        <a href="<?= url('manage_groups'); ?>">Manage Groups</a>
                    </li>
                </ul>
            </li>   -->

<!--            <li class="<?= ($tab == 'room' ? 'active' : '') ?>">
                <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Rooms</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?= ($title == 'Add Room') ? 'active' : '' ?>"><a href="<?= url('add_room') ?>">Create Room</a></li>
                    <li class="<?= ($title == 'Manage Room') ? 'active' : '' ?>"><a href="<?= url('manage_rooms'); ?>">Manage Room</a></li>
                  </ul>
            </li> -->

        </ul>

    </div>
</nav>
