<main class="full-page">
     <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
     <div class="cus-section">
          <?php
          $showView = '';
          if (isset($_GET['view']) && $_GET['view'] != '') {
               $showView = $_GET['view'];
          }
          ?>
          <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>
          <div class="page-inside">
               <div class="heading-btn-sec">
                    <h3><?= $item_detail->title; ?></h3>
                    <a href="#" data-toggle="modal" data-target="#photoAddModal" class="cus-btn-green">+ Add Photos</a>
                    <a href="javascript:void(0)" class="create_grp_btn cus-btn-orange cus-btn-image grid_view_btn" style="position: absolute;right: 170px;">Create Group</a>
               </div>
               <div class="main-top-row">
                    <div class="content-img-detail">
                         <div class="img-with-text">
                              <img src="<?= asset('userasset') ?>/img/group-icon.png" alt="icon">
                              <strong><?= $tota_group; ?></strong>
                              <span>Groups</span>
                         </div>
                         <div class="img-with-text">
                              <img src="<?= asset('userasset') ?>/img/photos-icon.png" alt="icon">
                              <strong><?= $tota_photos; ?></strong>
                              <span>Photos</span>
                         </div>
                    </div>
                    <div class="sort-btn-right"> 
                        <!--<a href="javascript:void(0)" class="cus-btn-green cus-btn-image selectMultiImg"><img src="<?= asset('userasset') ?>/img/c-group-icon.png" alt="icon"> Select Photos</a>-->
                         <span class="sort-selected-total-txt grid_view_action" style="display: none"><span class="total_selectd">0</span> Items selected</span>
                         <a href="#" data-toggle="modal" data-target="#addToModal" class="cus-btn-orange cus-btn-image grid_view_action create_grp_btn_action" style="display: none">Create Group</a>
                         <a href="javascript:void(0)" class="cus-btn-red cus-btn-image del_check_items grid_view_action" style="display: none">
                              <img src="<?= asset('userasset') ?>/img/del-icon-white.png" alt="icon"> Delete</a>
                         <a href="javascript:void(0)" class="cus-btn-white cus-btn-image cancel_selected grid_view_action" style="display: none">Cancel</a>


                         <a href="javascript:void(0)" class="bg-sort-color list_view_btn"><img src="<?= asset('userasset') ?>/img/list-view-icon.png" alt="icon"></a>
                         <a href="javascript:void(0)" class="bg-sort-color grid_view_btn"><img src="<?= asset('userasset') ?>/img/thumb-view-icon.png" alt="icon"></a>

                         <?php $sort_by = isset($sort_by) ? $sort_by : ''; ?>
                         <select name="sort_by" class="sort_by">
                              <option disabled="">Sort By</option>
                              <option value="all" <?= ($sort_by == 'all') ? 'selected' : ''; ?>>All</option>
                              <option value="no_labeled" <?= ($sort_by == 'no_labeled') ? 'selected' : ''; ?>>Sort by items not Labeled</option>
                              <option value="labeled" <?= ($sort_by == 'labeled') ? 'selected' : ''; ?>>Sort by items Labeled</option>
                              <option value="group" <?= ($sort_by == 'group') ? 'selected' : ''; ?>>Sort by Group</option>
                              <option value="photos" <?= ($sort_by == 'photos') ? 'selected' : ''; ?>>Sort by Photos</option>
                         </select> 
                    </div>
<<<<<<< HEAD
                </div>
                <div class="sort-btn-right"> 
                    <!--<a href="javascript:void(0)" class="cus-btn-green cus-btn-image selectMultiImg"><img src="<?= asset('userasset') ?>/img/c-group-icon.png" alt="icon"> Select Photos</a>-->
                    <span class="sort-selected-total-txt grid_view_action" style="display: none"><span class="total_selectd">0</span> Items selected</span>
                    <a href="#" data-toggle="modal" data-target="#addToModal" class="cus-btn-orange cus-btn-image grid_view_action" style="display: none">Create Group</a>
                    <a href="javascript:void(0)" class="cus-btn-red cus-btn-image del_check_items grid_view_action" style="display: none">
                        <img src="<?= asset('userasset') ?>/img/del-icon-white.png" alt="icon"> Delete</a>
                    <a href="javascript:void(0)" class="cus-btn-white cus-btn-image cancel_selected grid_view_action" style="display: none">Cancel</a>


                    <a href="javascript:void(0)" class="bg-sort-color list_view_btn"><img src="<?= asset('userasset') ?>/img/list-view-icon.png" alt="icon"></a>
                    <a href="javascript:void(0)" class="bg-sort-color grid_view_btn"><img src="<?= asset('userasset') ?>/img/thumb-view-icon.png" alt="icon"></a>
                    <?php $sort_by = isset($sort_by) ? $sort_by : ''; ?>
                    <select name="sort_by" class="sort_by">
                        <option disabled="">Sort By</option>
                        <option value="all" <?= ($sort_by == 'all') ? 'selected' : ''; ?>>All</option>
                        <option value="no_labeled" <?= ($sort_by == 'no_labeled') ? 'selected' : ''; ?>>Sort by items not Labeled</option>
                        <option value="labeled" <?= ($sort_by == 'labeled') ? 'selected' : ''; ?>>Sort by items Labeled</option>
                        <option value="group" <?= ($sort_by == 'group') ? 'selected' : ''; ?>>Sort by Group</option>
                        <option value="photos" <?= ($sort_by == 'photos') ? 'selected' : ''; ?>>Sort by Photos</option>
                    </select> 
                </div>
            </div>
            <div class="sort-item-main-sec">
                <?php
                include resource_path('views/frontend/includes/messages.php');
                $show_view = '';
                if (isset($_GET['view']) && $_GET['view'] != '') {
                    $show_view = $_GET['view'] . 'This is val';
                }
                ?> 
                <?php
                if ($result && !$result->isEmpty()) {
                    foreach ($result as $val) {
                        $item_image_path = asset('public/images/users_image/default.jpg');
                        if ($val->image_path) {
                            $item_image_path = asset('public/' . $val->image_path);
                        }
                        ?>
                        <div class="sort-item-row list_view" style="display: <?= ($showView == 'GridView') ? 'none' : '' ?>">  
                            <a class="image-view-fancy" href="<?= $item_image_path; ?>" data-fancybox="gallery" style="background-image: url('<?= $item_image_path; ?>')"></a>
                            <div class="sort-detail-area-sec"> 

                                <div class="box-tools pull-right">
                                    <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu all-view-list"> 
                                        <li><a href="javascript:void(0" data-id="<?= $val->id ?>" class="del_list">Delete</a></li>
                                     </ul>
                                </div>

<!--                                <a href="javascript:void(0)" class="menu-view-drop"><i class="fa fa-ellipsis-v"></i></a>
                                <ul class="all-view-list">
                                    <li><a href="javascript:void(0)" data-id="<?= $val->id ?>" class="del_list btn btn-primary">Delete</a></li>
                                </ul>-->

                                <?php
                                if ($val->getLabel && !$val->getLabel->isEmpty()) {
                                    foreach ($val->getLabel as $key => $labels) {
                                        ?> 
                                        <div style="margin-top: 15px" class="label_div row_<?=$labels->id?>">
                                            <div class="sort-top-row">
                                                <div class="sort-top-col"> 
                                                    <h4><?= $key + 1 ?>. <?= $labels->item_name ?></h4>
                                                    <span style="display: none" class="label_title"><?= $labels->item_name ?></span>
                                                </div>
                                                <div class="sort-top-col sort-top-col-right">
                                                    <?php if ($key == 0) { ?>
                                                        <a href="#" data-toggle="modal" data-target="#myModal<?= $val->id; ?>" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                                    <?php } ?>
                                                    <a href="javascript:void(0)" data-id="<?= $labels->id ?>" data-img-id="<?= $val->id; ?>" class="edit_label">
                                                        <img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon">
                                                    </a>
                                                    <a href="javascript:void(0)" data-id="<?= $labels->id ?>" class="del_label"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a> 
                                                    <?php if ($key == 0) { ?>
                                                        <a href="<?= url('details/items/' . encodeId($val->id)); ?>"> <i class="fa fa-eye"></i></a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="sort-bot-row">
                                                <div class="sort-bot-col">
                                                    <span class="sort-bot-title">Brand/ Manufacture</span>
                                                    <span class="sort-bot-detail label_brand"><?= $labels->brand ?></span>
                                                </div>
                                                <div class="sort-bot-col">
                                                    <span class="sort-bot-title">Model &amp; Serial Number</span>
                                                    <span class="sort-bot-detail label_model"><?= $labels->model ?></span>
                                                </div>
                                                <div class="sort-bot-col">
                                                    <span class="sort-bot-title">Quantity Lost</span>
                                                    <span class="sort-bot-detail label_quantity"><?= $labels->quantity ?></span>
                                                </div>
                                                <div class="sort-bot-col">
                                                    <span class="sort-bot-title">Age</span>
                                                    <span style="display: none" class="label_age_year"><?= $labels->age_in_years ?></span>
                                                    <span style="display: none" class="label_age_month"><?= $labels->age_in_months ?></span>
                                                    <span style="display: none" class="label_room_id"><?= $labels->room_id; ?></span>

                                                    <span class="sort-bot-detail"><?= $labels->age_in_years ?> years, <?= $labels->age_in_months ?> months</span>
                                                </div>
                                                <div class="sort-bot-col">
                                                    <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                                    <span style="display: none" class="label_cost_to_replace"><?= $labels->cost_to_replace ?></span>

                                                    <span class="sort-bot-detail"><span class="green-txt">$<?= ($labels->cost_to_replace != '') ? $labels->cost_to_replace : '0'; ?></span></span>
                                                </div>
                                            </div>
                                        </div> 
=======
               </div>
               <div class="sort-item-main-sec">
                    <?php
                    include resource_path('views/frontend/includes/messages.php');
                    $show_view = '';
                    if (isset($_GET['view']) && $_GET['view'] != '') {
                         $show_view = $_GET['view'] . 'This is val';
                    }
                    ?> 
                    <?php
                    if ($result && (!$result->isEmpty() || !$result_group->isEmpty())) {
                         foreach ($result as $val) {
                              $item_image_path = asset('public/images/users_image/default.jpg');
                              if ($val->image_path) {
                                   $item_image_path = asset('public/' . $val->image_path);
                              }
                              ?>
                              <div class="sort-item-row list_view " style="display: <?= ($showView == 'GridView') ? 'none' : '' ?>">  
                                   <div class="select-user">
                                        <a class="image-view-fancy" href="<?= $item_image_path; ?>" data-fancybox style="background-image: url('<?= $item_image_path; ?>')"></a>
                                        
                                   </div>
                                   <div class="sort-detail-area-sec"> 

                                        <?php if (!$val->getLabel && $val->getLabel->isEmpty()) { ?>
                                             <div class="box-tools pull-right">
                                                  <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                       <i class="fa fa-ellipsis-v"></i>
                                                  </a>
                                                  <ul class="dropdown-menu all-view-list"> 
                                                       <li><a href="javascript:void(0)" data-id="<?= $val->id ?>" class="del_list">Delete</a></li>
                                                  </ul>
                                             </div>
                                        <?php } ?>

                                  <!--                                <a href="javascript:void(0)" class="menu-view-drop"><i class="fa fa-ellipsis-v"></i></a>
                                                                  <ul class="all-view-list">
                                                                      <li><a href="javascript:void(0)" data-id="<?= $val->id ?>" class="del_list btn btn-primary">Delete</a></li>
                                                                  </ul>-->

>>>>>>> 5d2a6797be4912cd22b910b7d0a87996d01bc97f
                                        <?php
                                        if ($val->getLabel && !$val->getLabel->isEmpty()) {
                                             foreach ($val->getLabel as $key => $labels) {
                                                  ?> 
                                                  <div style="margin-top: 15px" class="label_div">
                                                       <div class="sort-top-row">
                                                            <div class="sort-top-col"> 
                                                                 <a href="<?= url('details/items/' . encodeId($val->id)); ?>"><h4><?= $key + 1 ?>. <?= $labels->item_name ?></h4></a>
                                                                 <span style="display: none" class="label_title"><?= $labels->item_name ?></span>
                                                                 <span style="display: none" class="label_room_name"><?= $labels->room_name ?></span>
                                                            </div>
                                                            <div class="sort-top-col sort-top-col-right">
                                                                 <?php if ($key == 0) { ?>
                                                                      <a href="#" data-toggle="modal" data-target="#myModal<?= $val->id; ?>" class="cus-btn-orange cus-btn-image">Label Multiple Items in this photo</a>
                                                                 <?php } ?>
                                                                 <a href="javascript:void(0)" data-id="<?= $labels->id ?>" data-img-id="<?= $val->id; ?>" class="edit_label">
                                                                      <img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon">
                                                                 </a>
                                                                 <a href="javascript:void(0)" data-id="<?= $labels->id ?>" class="del_label"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a> 
                                                                 <?php if ($key == 0) { ?>
                                                                      <a href="<?= url('details/items/' . encodeId($val->id)); ?>"> <i class="fa fa-eye"></i></a>
                                                                 <?php } ?>

                                                            </div>
                                                       </div>
                                                       <div class="sort-bot-row">
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Brand/ Manufacture</span>
                                                                 <span class="sort-bot-detail label_brand"><?= $labels->brand ?></span>
                                                            </div>
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Model</span>
                                                                 <span class="sort-bot-detail label_model"><?= $labels->model ?></span>
                                                            </div>
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Serial Number</span>
                                                                 <span class="sort-bot-detail label_serial_no"><?= $labels->serial_no ?></span>
                                                            </div>
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Quantity Lost</span>
                                                                 <span class="sort-bot-detail label_quantity"><?= $labels->quantity ?></span>
                                                            </div>
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Age</span>
                                                                 <span style="display: none" class="label_age_year"><?= $labels->age_in_years ?></span>
                                                                 <span style="display: none" class="label_age_month"><?= $labels->age_in_months ?></span>
                                                                 <span style="display: none" class="label_room_id"><?= $labels->room_id; ?></span>

                                                                 <span class="sort-bot-detail"><?= $labels->age_in_years ?> years, <?= $labels->age_in_months ?> months</span>
                                                            </div>
                                                            <div class="sort-bot-col">
                                                                 <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                                                 <span style="display: none" class="label_cost_to_replace"><?= $labels->cost_to_replace ?></span>

                                                                 <span class="sort-bot-detail"><span class="green-txt">$<?= ($labels->cost_to_replace != '') ? $labels->cost_to_replace : '0'; ?></span></span>
                                                            </div>
                                                       </div>
                                                  </div> 
                                                  <?php
                                             }
                                        } else {
                                             ?>
                                             <div style="margin-top: 15px">
                                                  <div class="sort-top-col sort-top-col-right">
                                                       <div class="no_label_actions_content">
                                                            <a href="#" data-toggle="modal" data-target="#myModal<?= $val->id; ?>" class="edit_label"><img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon"></a>

                                                            <a href="javascript:void(0)" data-id="<?= $val->id ?>" class="del_list"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a> 
                                                       </div>
                                                  </div>
                                                  <div class="sort-bot-row">
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">No label found.</span> 
                                                       </div>

                                                  </div>
                                             </div> 
                                        <?php }
                                        ?>
                                        <div class="check-box" style="display:none;">
                                             <div class="form-group">
                                                  <input class="styled-checkbox" id="selec-images" type="checkbox" value="value1">
                                                  <label for="selec-images"></label>
                                             </div>
                                        </div>
                                   </div>
                                   
                              </div> 

                              <!--More info model-->
                              <div class="modal fade" id="myModal<?= $val->id; ?>" role="dialog">
                                   <div class="modal-dialog">
                                        <div class="modal-content">
                                             <div class="modal-body">
                                                  <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                                                       <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                                       <span class="ajax-label-body"></span>
                                                  </div>
                                                  <form action="<?= url('add_item_label'); ?>" method="post" class="label_frm">
                                                       <?= csrf_field(); ?>
                                                       <div class="cus-form">
                                                            <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                                            <h4 class="form_title">Label info</h4>
                                                            <div class="cus-input-row show_error">
                                                                 <!--                                                    <label>Room name *</label>
                                                                                                                     <select name="room_id" required>
                                                                 <?php
                                                                 if ($room_list) {
                                                                      foreach ($room_list as $room) {
                                                                           ?>
                                                                                                                                                                   <option value="<?= $room->id; ?>"><?= $room->title; ?></option>
                                                                           <?php
                                                                      }
                                                                 }
                                                                 ?>
                                                                                                                     </select>-->
                                                                 <input type="hidden" name="type_item" value=""/>
                                                                 <input type="hidden" name="edit_id" value=""/>
                                                                 <input type="hidden" name="image_id" value="<?= $val->id; ?>" />
                                                                 <!--<br>-->
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Room name *</label>
                                                                 <input type="text" name="room_name" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Item name *</label>
                                                                 <input type="text" name="item_name" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Brand/Manufacture *</label>
                                                                 <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’" name="brand" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Model *</label>
                                                                 <input type="text" placeholder="If no model name, enter ‘Unknown’" name="model" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Serial Number *</label>
                                                                 <input type="text" placeholder="If no serial number, enter ‘Unknown’" name="serial_no" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Quantity Lost *</label>
                                                                 <input type="number" min="1" onkeypress="return event.charCode != 45" name="quantity" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Cost to replace *</label>
                                                                 <input type="number" min="1" onkeypress="return event.charCode != 45" name="cost_to_replace" required/>
                                                            </div>
                                                            <div class="cus-input-row-double">
                                                                 <div class="cus-input-row">
                                                                      <label>Age (years) *</label>
                                                                      <input type="number" min="0" onkeypress="return event.charCode != 45" name="age_in_years" required/>
                                                                 </div>
                                                                 <div class="cus-input-row">
                                                                      <label>Age (months) *</label>
                                                                      <input type="number" min="1" onkeypress="return event.charCode != 45" name="age_in_months" required/>
                                                                 </div>
                                                            </div>
                                                            <div class="cus-btn-main"> 
                                                                 <button type="button" class="cus-btn save_label" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">Save Info</button>
                                                            </div>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!--End More info model-->
                         <?php } ?>
                         <!-- Grid view items --> 
                         <div class="sort-item-thumb-row grid_view" style="display: <?= ($showView == 'GridView') ? '' : 'none' ?>;" >
                              <?php
                              foreach ($result as $val_img) {

                                   $item_image2_path = asset('public/images/users_image/default.jpg');
                                   if ($val->image_path) {
                                        $item_image2_path = asset('public/' . $val_img->image_path);
                                   }
                                   ?>   
                                   <div class="sort-item-thumb-col">
                                        <input class="checkbox-click" type="checkbox" name="ungroup_photos[]" value="<?= $val_img->id ?>"  id="test<?= $val_img->id ?>">
                                        <label for="test<?= $val_img->id ?>" style="background-image: url('<?= asset($item_image2_path) ?>')">
                                             <span class="sort-checked-box"><img src="<?= asset('userasset') ?>/img/tick-fill-white.png" alt="icon"></span>
                                             <?php if ($val_img->getSingleLabel) { ?>
                                                  <span class="info-added"><img src="<?= asset('userasset') ?>/img/info-icon.png" alt="icon">Info Added</span>
                                             <?php } ?>
                                        </label>
                                        <?php if ($val_img->getSingleLabel) { ?>
                                             <span class="sort-thumb-img-title"><?= $val_img->getSingleLabel->item_name; ?></span>
                                        <?php } ?>
                                   </div>
                              <?php } ?>
                              <!--///////////////////-->
                              <?php
                              if ($result_group && !$result_group->isEmpty()) {
                                   foreach ($result_group as $val) {
                                        $item_image_path = asset('public/images/users_image/default.jpg');
                                        if ($val->image_path && $val->image_path != 'empty') {
                                             $item_image_path = asset('public/' . $val->image_path);
                                        } else {

                                             $val->total_group_img = sizeof($val->getGroup->getGroupPhotos);
                                             if (sizeof($val->getGroup->getGroupPhotos) > 0) {
                                                  $item_image_path = asset('public/' . $val->getGroup->getGroupPhotos[0]->image_path);
                                             }
                                        }
                                        ?> 

                                        <div class="sort-item-thumb-col" style="position :relative">
                                             <input class="checkbox-click group_checkbox_grid" type="checkbox" name="ungroup_photos[]" value="<?= $val->id ?>"  id="test<?= $val->id ?>">
                                             <label for="test<?= $val->id ?>" style="background-image: url('<?= asset($item_image_path) ?>')">
                                                  <span class="sort-checked-box"><img src="<?= asset('userasset') ?>/img/tick-fill-white.png" alt="icon"></span>
                                                  <?php if ($val->getSingleLabel) { ?>
                                                       <span class="info-added"><img src="<?= asset('userasset') ?>/img/info-icon.png" alt="icon">Info Added</span>
                                                  <?php } ?>
                                             </label>
                                             <?php if ($val->getOneLabel) { ?>
                                                  <span class="sort-thumb-img-title"><?= $val->getOneLabel->item_name; ?>
                                                       <a href="<?= url('details/group/' . encodeId($val->group_id)); ?>" style="margin-left: 10px;">
                                                            <i class="fa fa-eye"></i>
                                                       </a>
                                                  </span>
                                             <?php } ?>
                                             <?php if ($val->getGroup) { ?>
                                                  <div class="cus_position">
                                                       <img src="<?= asset('userasset/img/photos-icon.png') ?>" alt="img" style="display:inline-block;">
                                                       <span class="sort-thumb-img-title" style="color: #ff9832;background: #dadada;border-radius: 10px;padding: 0px 5px 0px 5px;display:inline-block;"><?= count($val->getGroup->getGroupPhotos); ?></span>
                                                  </div>
                                             <?php } ?>
                                        </div>

                                   <?php } ?>
                              <?php } ?>
                         </div>

                    <?php } ?>

                    <!--result_group-->  
                    <?php
                    if ($result_group && !$result_group->isEmpty()) {
                         $counter_gr = 0;
                         foreach ($result_group as $val) {
                              $item_image_path = asset('public/images/users_image/default.jpg');
                              if ($val->image_path && $val->image_path != 'empty') {
                                   $item_image_path = asset('public/' . $val->image_path);
                              } else {

                                   $val->total_group_img = sizeof($val->getGroup->getGroupPhotos);
                                   if (sizeof($val->getGroup->getGroupPhotos) > 0) {
                                        $item_image_path = asset('public/' . $val->getGroup->getGroupPhotos[0]->image_path);
                                   }
                              }
                              ?>
                              <div class="sort-item-row list_view" style="display: <?= ($showView == 'GridView') ? 'none' : '' ?>">
                                   <a data-fancybox="group_<?= $counter_gr ?>" class="fancybox" href="<?= $item_image_path; ?>" style="background-image: url('<?= $item_image_path; ?>')">        
                                        <figure style="background-image: url('<?= $item_image_path; ?>')">
                                             <div class="img-with-text"> 
                                                  <strong><?= $val->total_group_img; ?></strong>
                                                  <span>Photos</span>
                                             </div>
                                        </figure> 
                                   </a>
                                   <?php
                                   $counter = 1;
                                   foreach ($val->getGroup->getGroupPhotos as $GroupPhoto) {
                                        if ($counter > 1) {
                                             ?> 
                                             <a data-fancybox="group_<?= $counter_gr ?>" style="display : none ;" class="fancybox" href="<?= asset('public/' . $GroupPhoto->image_path) ?>"  style="background-image: url('<?= asset('public/' . $GroupPhoto->image_path); ?>')"></a>
                                        <?php } ?>
                                        <?php
                                        $counter++;
                                   }
                                   ?>
                                   <div class="sort-detail-area-sec"> 
                                        <div style="margin-top: 15px" class="label_div">
                                             <div class="sort-top-row">
                                                  <div class="sort-top-col"> 
                                                       <a href="<?= url('details/group/' . encodeId($val->group_id)); ?>"><h4><?= isset($val->getOneLabel->getGroup->title) ? $val->getOneLabel->getGroup->title : '' ?></h4></a>
                                                       <span style="display: none" class="label_title"><?= isset($val->getOneLabel->item_name) ? $val->getOneLabel->item_name : '' ?></span>
                                                       <span style="display: none" class="label_room_name"><?= isset($val->getOneLabel->room_name) ? $val->getOneLabel->room_name : '' ?></span>
                                                  </div>
                                                  <div class="sort-top-col sort-top-col-right">
                                                       <a href="javascript:void(0)" data-group-id="<?= $val->group_id; ?>" data-img-id="<?= $val->id; ?>" class="edit_label">
                                                            <img src="<?= asset('userasset/img/pen-icon.png'); ?>" alt="icon">
                                                       </a>  
                                                       <!--<a href="javascript:void(0)" data-id="<?= $val->group_id ?>" class="del_group"><img src="<?= asset('userasset/img/del-icon.png'); ?>" alt="icon"></a>-->
                                                       <a href="<?= url('details/group/' . encodeId($val->group_id)); ?>"> <i class="fa fa-eye"></i></a>
                                                       <a href="javascript:void(0)" class="menu-view-drop"><i class="fa fa-ellipsis-v"></i></a>
                                                       <ul class="all-view-list">
                                                            <li><a href="javascript:void(0)" data-id="<?= $val->group_id ?>" class="del_group btn btn-primary">Delete</a></li>
                                                       </ul>   
                                                  </div>
                                             </div>

                                             <?php if ($val->getOneLabel) { ?> 
                                                  <div class="sort-bot-row">
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">Brand/ Manufacture</span>
                                                            <span class="sort-bot-detail label_brand"><?= $val->getOneLabel->brand ?></span>
                                                       </div>
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">Model </span>
                                                            <span class="sort-bot-detail label_model"><?= $val->getOneLabel->model ?></span>
                                                       </div>
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title"> Serial Number</span>
                                                            <span class="sort-bot-detail label_serial_no"><?= $val->getOneLabel->serial_no ?></span>
                                                       </div>
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">Quantity Lost</span>
                                                            <span class="sort-bot-detail label_quantity"><?= $val->getOneLabel->quantity ?></span>
                                                       </div>
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">Age</span>
                                                            <span style="display: none" class="label_age_year"><?= $val->getOneLabel->age_in_years ?></span>
                                                            <span style="display: none" class="label_age_month"><?= $val->getOneLabel->age_in_months ?></span>
                                                            <span style="display: none" class="label_room_id"><?= $val->getOneLabel->room_id; ?></span>

                                                            <span class="sort-bot-detail"><?= $val->getOneLabel->age_in_years ?> years, <?= $val->getOneLabel->age_in_months ?> months</span>
                                                       </div>
                                                       <div class="sort-bot-col">
                                                            <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                                            <span style="display: none" class="label_cost_to_replace"><?= $val->getOneLabel->cost_to_replace; ?></span>

                                                            <span class="sort-bot-detail"><span class="green-txt">$<?= ($val->getOneLabel && $val->getOneLabel->cost_to_replace) ? $val->getOneLabel->cost_to_replace : '0'; ?></span></span>
                                                       </div>
                                                  </div>
                                                  <?php
                                             }
                                             ?>
                                        </div>  
                                   </div>  
                              </div>

                              <!--More info model-->
                              <div class="modal fade" id="myModal<?= $val->id; ?>" role="dialog">
                                   <div class="modal-dialog">
                                        <div class="modal-content">
                                             <div class="modal-body">
                                                  <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                                                       <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                                       <span class="ajax-label-body"></span>
                                                  </div>
                                                  <form action="<?= url('add_item_label'); ?>" method="post" class="label_frm">
                                                       <?= csrf_field(); ?>
                                                       <div class="cus-form">
                                                            <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                                            <h4 class="form_title">Label info</h4>
                                                            <div class="cus-input-row show_error">
                                                                 <!--<label>Room name *</label>-->
                     <!--                                                    <select name="room_id" class="">
                                                                 <?php
                                                                 if ($room_list) {
                                                                      foreach ($room_list as $room) {
                                                                           ?>
                                                                                                               <option value="<?= $room->id; ?>"><?= $room->title; ?></option>
                                                                           <?php
                                                                      }
                                                                 }
                                                                 ?>
                                                                 </select>-->
                                                                 <input type="hidden" name="type_item" value=""/>
                                                                 <input type="hidden" name="edit_id" value=""/>
                                                                 <input type="hidden" name="image_id" value="<?= $val->id; ?>" />
                                                                 <br>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Room name *</label>
                                                                 <input type="text" name="room_name" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Item name *</label>
                                                                 <input type="text" name="item_name" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Brand/Manufacture *</label>
                                                                 <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’" name="brand" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Model *</label>
                                                                 <input type="text" placeholder="If no model name, enter ‘Unknown’" name="model" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label> Serial Number *</label>
                                                                 <input type="text" placeholder="If no serial number, enter ‘Unknown’" name="serial_no" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Quantity Lost *</label>
                                                                 <input type="number" min="1" onkeypress="return event.charCode != 45" name="quantity" required/>
                                                            </div>
                                                            <div class="cus-input-row">
                                                                 <label>Cost to replace *</label>
                                                                 <input type="number" min="1" onkeypress="return event.charCode != 45" name="cost_to_replace" required/>
                                                            </div>
                                                            <div class="cus-input-row-double">
                                                                 <div class="cus-input-row">
                                                                      <label>Age (years) *</label>
                                                                      <input type="number" min="0" onkeypress="return event.charCode != 45" name="age_in_years" required/>
                                                                 </div>
                                                                 <div class="cus-input-row">
                                                                      <label>Age (months) *</label>
                                                                      <input type="number" min="1" name="age_in_months" required/>
                                                                 </div>
                                                            </div>
                                                            <div class="cus-btn-main">
                                                                 <button type="button" class="cus-btn save_label" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">Save Info</button>
                                                                 <!--<input type="button" value="" class="cus-btn " data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing..."/>-->
                                                            </div>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!--End More info model-->
                              <?php
                              $counter_gr++;
                         }
                    }
                    ?> 
               </div> 
               <!--End result_group-->  


               <!--More add photo model-->
               <div class="modal fade" id="photoAddModal" role="dialog">
                    <div class="modal-dialog">
                         <div class="modal-content">
                              <div class="modal-body">
                                   <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                        <span class="ajax-label-body"></span>
                                   </div>
                                   <form action="<?= url('add_photos'); ?>" method="post" class="image_frm" id="select_photo_frm">
                                        <?= csrf_field(); ?>
                                        <div class="cus-form">
                                             <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                             <h4 class="form_title">Upload image and information.</h4>

                                             <div class="cus-input-row">
                                                  <label>Select type of photo *</label>
                                                  <select name="type" id="type">
                                                       <option value="single">Single photo</option>
                                                       <option value="multi">Multiple photos</option>
                                                       <option value="group" data-groups="<?= sizeof($group_list) ?>">Room photos</option>
                                                  </select>
                                                  <input type="hidden" name="item_id" value="<?= $item_id ?>"/>
                                             </div>

                                             <div class="multi_group_div" style="display: none;">
                                                  <div class="cus-input-row">
                                                       <label>Select Room*</label>
                                                       <select name="group_id" class="add_photo_group" required> 
                                                            <option value="none">Please Select</option>
                                                            <option value="-1"><strong>Create new room</strong></option>
                                                            <option disabled="">Choose From Existing Rooms</option>
                                                            <?php
                                                            if (!$group_list->isEmpty()) {
                                                                 foreach ($group_list as $group) {
                                                                      ?>
                                                                      <option value="<?= $group->id; ?>"><?= $group->title; ?></option>
                                                                      <?php
                                                                 }
                                                            } else {
                                                                 ?> 
                                                                 <option disabled="">N/A</option>
                                                            <?php } ?> 
                                                       </select>
                                                  </div>  
                                             </div> 
                                             <div class="cus-input-row create_new_group_title" style="display: none;">
                                                  <label>Group Title *</label>
                                                  <input type="text" name="group_title" required/>
                                                  <input type="hidden" name="item_id" value="<?= $item_id; ?>" required/>
                                             </div>
                                             <div class="cus-input-row multi_img" style="display: none;">
                                                  <label>Select multiple image *</label>
                                                  <input type="file"  name="group_image[]" id="image_uploading" accept="image/*" multiple required/>
                                                  <span class="text-danger error_image"></span>
                                             </div>
                                             <div class="cus-input-row single_image">
                                                  <label>Select image *</label>
                                                  <input type="file" name="image" accept="image/*" required/>
                                                  <span class="text-danger error_image"></span>
                                             </div>

                                             <div class="label_detail"> 
                                                  <!--                                        <div class="cus-input-row show_error">
                                                                                              <label>Room name *</label>
                                                                                              <select name="room_id" class="">
                                                  <?php
                                                  if ($room_list) {
                                                       foreach ($room_list as $room) {
                                                            ?>
                                                                                                                                            <option value="<?= $room->id; ?>"><?= $room->title; ?></option>
                                                            <?php
                                                       }
                                                  }
                                                  ?>
                                                                                              </select>  
                                                                                          </div>-->
                                                  <div class="cus-input-row">
                                                       <label>Room name *</label>
                                                       <input type="text" name="room_name" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Item name *</label>
                                                       <input type="text" name="item_name" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Brand/Manufacture *</label>
                                                       <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’" name="brand" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Model *</label>
                                                       <input type="text" placeholder="If no model name, enter ‘Unknown’" name="model" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Serial Number *</label>
                                                       <input type="text" placeholder="If no serial number, enter ‘Unknown’" name="serial_no" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Quantity Lost *</label>
                                                       <input type="number" min="1" onkeypress="return event.charCode != 45" name="quantity" required/>
                                                  </div>
                                                  <div class="cus-input-row">
                                                       <label>Cost to replace *</label>
                                                       <input type="number" min="1" onkeypress="return event.charCode != 45" name="cost_to_replace" required/>
                                                  </div>
                                                  <div class="cus-input-row-double">
                                                       <div class="cus-input-row">
                                                            <label>Age (years) *</label>
                                                            <input type="number" onkeypress="return event.charCode != 45" min="0" name="age_in_years" required/>
                                                       </div>
                                                       <div class="cus-input-row">
                                                            <label>Age (months) *</label>
                                                            <input type="number" onkeypress="return event.charCode != 45" min="1" name="age_in_months" required/>
                                                       </div>
                                                  </div>
                                             </div> 
                                        </div>
                                        <div class="cus-btn-main"> 
                                             <button type="button" class="cus-btn save_photos" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">Submit Photo(s)</button>
                                        </div>
                                   </form>

                              </div>
                         </div>
                    </div>  
               </div>
               <!--End add photo model-->

               <?php if (count($result_group) == 0 && count($result) == 0) { ?> 
                    <div class="no-item-sec">
                         <img src="<?= asset('userasset') ?>/img/no-items.png" alt="No Items" />
                         <span>No Item has been added yet!</span>
                    </div>
               <?php } ?>
          </div>
     </div> 

     <!-- Add to group popup -->
     <div class="modal fade" id="addToModal" role="dialog">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-body">
                         <div class="alert alert-success fade in alert-dismissible ajax-label" style="display: none;">
                              <!--<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>-->
                              <span class="ajax-label-body"></span>
                         </div>
                         <form action="<?= url('add_to_group'); ?>" method="post" class="label_frm">
                              <?= csrf_field(); ?>
                              <div class="cus-form">
                                   <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                   <h4 class="form_title">Add to Group</h4>
                                   <div class="cus-input-row">
                                        <label>Select Group*</label>
                                        <select name="group_id" class="add_to_existing_group">
                                             <option value="">Select group</option>
                                             <?php
                                             if ($group_list) {
                                                  foreach ($group_list as $g_list) {
                                                       ?>
                                                       <option value="<?= $g_list->id; ?>"><?= $g_list->title; ?></option>
                                                       <?php
                                                  }
                                             }
                                             ?>
                                             <option value="-1">Create new group</option>
                                        </select>
                                        <input type="hidden" name="item_id" value="<?= $item_id; ?>"/>
                                        <input type="hidden" class="new_created_group" name="items_ids" value=""/>
                                   </div>
                                   <span class="error no_group" style="display: none;">Please select any room</span>

                                   <div class="cus-input-row new_group_box" style="display: none;">
                                        <div class="cus-input-row">
                                             <label>Group Name *</label>
                                             <input type="text" class="new_created_group" name="group_name" required/>
                                        </div>  
                                        <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                                        <h4 class="form_title">Room Label info</h4>
                                        <!--                                <div class="cus-input-row show_error">
                                                                            <label>Room name *</label>
                                                                            <select name="room_id" required>
                                        <?php
                                        if ($room_list) {
                                             foreach ($room_list as $room) {
                                                  ?>
                                                                                                                          <option value="<?= $room->id; ?>"><?= $room->title; ?></option>
                                                  <?php
                                             }
                                        }
                                        ?>
                                                                            </select>  
                                                                        </div>-->
                                        <div class="cus-input-row">
                                             <label>Room name *</label>
                                             <input type="text" name="room_name" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Item name *</label>
                                             <input type="text" name="item_name" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Brand/Manufacture *</label>
                                             <input type="text" placeholder="If no brand or manufacture name, enter ‘Unknown’" name="brand" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Model *</label>
                                             <input type="text" placeholder="If no model name, enter ‘Unknown’" name="model" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Serial Number *</label>
                                             <input type="text" placeholder="If no serial number, enter ‘Unknown’" name="serial_no" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Quantity Lost *</label>
                                             <input type="number" min="1" onkeypress="return event.charCode != 45" name="quantity" required/>
                                        </div>
                                        <div class="cus-input-row">
                                             <label>Cost to replace *</label>
                                             <input type="number" min="1" onkeypress="return event.charCode != 45" name="cost_to_replace" required/>
                                        </div>
                                        <div class="cus-input-row-double">
                                             <div class="cus-input-row">
                                                  <label>Age (years) *</label>
                                                  <input type="number" min="0" onkeypress="return event.charCode != 45" name="age_in_years" required/>
                                             </div>
                                             <div class="cus-input-row">
                                                  <label>Age (months) *</label>
                                                  <input type="number" min="1" onkeypress="return event.charCode != 45" name="age_in_months" required/>
                                             </div>
                                        </div>  
                                   </div> 

                                   <div class="cus-btn-main">
                                       <!--<input type="button" value="Save" class="cus-btn "/>-->
                                        <button type="button" class="cus-btn add_to_group_btn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">Save Info</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- End Add to group popup -->
</main>     
<script>
     $(document).ready(function () {
          var view = "<?= $showView ? $showView : 'listView' ?>";
          if (view === 'listView') {
               $('.create_grp_btn ').show();
          } else {
               $('.create_grp_btn ').hide();
          }
          $(".fancybox").fancybox({
               loop: true
          });
          $(window).on('popstate', function () {
               location.reload(true);
          });
          $('INPUT[type="file"]').change(function () {
               var ext = this.value.match(/\.(.+)$/)[1];
               switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                         $(this).next('.error_image').hide();
                         return true;
                         break;
                    default:
                         $(this).next('.error_image').show();
                         $(this).next('.error_image').html('Invalid image type selected');
                         this.value = '';
               }
          });

          $('body').on('change', '.sort_by', function () {
               var val = $(this).val();
               second_param = window.location.href.split('&')[1];
               if (typeof second_param != 'undefined') {
                    second_param = second_param;
               } else {
                    second_param = 'view=listView';
               }
               history.pushState('', '', '?sort_by=' + val + '&' + second_param);
               window.location.reload();
          });

          $('.menu-view-drop').click(function () {
               $(this).next().slideToggle();
          });
          //Add to group functions
          $('body').on('change', '.add_to_existing_group', function () {
               var val = $(this).val();
               $('.new_group_box').hide();
               if (val == '-1') {
                    $('.new_group_box').show();
               }
          });


          $('body').on('click', '.add_to_group_btn', function () {
               $this = $(this);
               $form = $(this).parents('form');
               var group_dropdown = $form.find("select[name=group_id]").val();
               if (group_dropdown == '') {
                    $('.no_group').show();
                    return false;
               } else if (group_dropdown == '-1') {
                    $form.validate();
                    $form.validate({
                         rules: {
                              group_name: "required",
//                        room_id: "required",
                              room_name: "required",
                              item_name: "required",
                              brand: "required",
                              model: "required",
                              serial_no: "required",
                              quantity: "required",
                              cost_to_replace: "required",
                              age_in_years: "required",
                              age_in_months: "required"
                         },
                         messages: {
                              quantity: "Please enter quantity",
                              age_in_years: "Please enter age in years",
                              age_in_months: "Please enter age in months",
                              brand: "Please enter brand",
                              model: "Please enter model",
                              serial_no: "Please enter serial number",
                              room_name: "Please enter room name",
                              item_name: "Please enter item name",
                              cost_to_replace: "Please enter cost to replace"
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
               }
               //Send save request to server
               if ($form.valid()) {
                    $this.button('loading');
                    var formData = new FormData($form[0]);
                    $.ajax({
                         url: base_url + 'add_to_group',
                         type: 'POST',
                         data: formData,
                         dataType: 'json',
                         cache: false,
                         contentType: false,
                         processData: false,
                         beforeSend: function (request) {
                              return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                         },
                         success: function (data) {
                              $this.button('reset');
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
                                   $('html .modal').animate({scrollTop: 0}, 1000);
                                   $('.ajax-label').show();
                                   $(".ajax-label").removeClass("alert-success");
                                   $(".ajax-label").addClass("alert-danger");
                                   $(".ajax-label-body").html(data.message);

                              }
                         }
                    });
               }
               //End send save reques to server
          });
          //End Add to group functions

          $('body').on('click', '.del_check_items', function () {
               var searchIDs = $(".grid_view input:checkbox:checked").map(function () {
                    return $(this).val();
               }).get();
               var id = JSON.stringify({
                    id: searchIDs
               });

               var total_items = searchIDs.length;
               $('.confirm_message').html('Are you sure to delete ' + total_items + ' selected items?');
               $('#confirmModal').modal({
                    backdrop: 'static',
                    keyboard: false
               }).one('click', '#delete', function (e) {
                    $.ajax({
                         url: base_url + 'delete_record',
                         type: 'POST',
                         dataType: 'json',
                         data: {'table': 'photo_with_group', 'id': id},
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

          $('body').on('click', '.list_view_btn', function () {
               var view = "<?= $showView ? $showView : 'listView' ?>";
               if (view === 'listView') {
                    $('.create_grp_btn ').show();
               } else {
                    $('.create_grp_btn ').hide();
               }
               $('.list_view').show();
               $('.grid_view').hide();
               $('.create_grp_btn').show();
               history.pushState('', '', '?sort_by=&view=listView');
          });

          $('body').on('click', '.grid_view_btn', function () {
               var view = "<?= $showView ? $showView : 'listView' ?>";
               if (view === 'listView') {
                    $('.create_grp_btn ').show();
               } else {
                    $('.create_grp_btn ').hide();
               }
               history.pushState('', '', '?sort_by=&view=GridView');
               $('.grid_view').show();
               $('.list_view').hide();
               $('.create_grp_btn').hide();
          });

          $('body').on('click', '.checkbox-click', function () {

               var groupLen = $(".group_checkbox_grid:checked").length;

               var chLen = $("input[name='ungroup_photos[]']:checked").length;
               $('.total_selectd').text(chLen);
               if (chLen > 0) {
                    var searchIDs = $(".grid_view input:checkbox:checked").map(function () {
                         return $(this).val();
                    }).get();
                    var id = JSON.stringify(searchIDs);
                    $('#addToModal .label_frm').find("input[name='items_ids']").val(id);
                    $('.grid_view_action').show();
               } else {
                    $('.grid_view_action').hide();
               }
               if (groupLen > 0) {
                    $('.create_grp_btn_action').hide();
               }
          });
          $('body').on('click', '.cancel_selected', function () {
               $(".grid_view input:checkbox:checked").trigger('click');
          });

          $('body').on('click', '.selectMultiImg', function () {
               $('body #photoAddModal #select_photo_frm').find("select[name='type']").val('multi');
               $('body #photoAddModal #select_photo_frm').find("select[name='type']").trigger('click');
               $('select').niceSelect('update');

               $('.multi_img').show();
               $('.multi_group_div').hide();
               $('.single_image').hide();
               $('.label_detail').hide();

               $('#photoAddModal').modal('show');
          });

          $('body').on('change', '.add_photo_group', function () {
               $('.add_photo_group').css('border', 'solid 1px #e8e8e8');
               var val = $('.add_photo_group').val();
               $('.label_detail').hide();
               $('.create_new_group_title').hide();
               if (val == '-1') {
                    $('.label_detail').show();
                    $('.create_new_group_title').show();
               }
          });

          $('body').on('change', '#type', function () {
               var val = $(this).val();
               if (val == 'group') {
                    var groups = $(this).find(':selected').attr('data-groups');
                    if (groups == '0') {
                         $('.label_detail').show();
                         $('.label_detail').show();
                         $('.create_new_group_title').show();
                         $('#image_uploading').removeAttr('required');
                    } else {
                         $('.label_detail').hide();//labe detail
                    }
                    $('.multi_group_div').show();
                    $('.multi_img').show();
                    $('.single_image').hide();

               } else if (val == 'multi') {
                    $('.multi_img').show();
                    $('.multi_group_div').hide();
                    $('.single_image').hide();
                    $('.label_detail').hide();
                    $('.create_new_group_title').hide();

               } else {
                    $('.single_image').show();
                    $('.label_detail').show();
                    $('.multi_group_div').hide();
                    $('.multi_img').hide();
                    $('.create_new_group_title').hide();
               }
          });

          $('body').on('click', '.save_label', function () {
               $this = $(this);
               $form = $(this).parents('form');
               //Form validation
               $form.validate({
                    rules: {
//                    rood_id: "required",
                         quantity: "required",
                         age_in_years: "required",
                         age_in_months: "required",
                         brand: {
                              required: true
                         },
                         model: {
                              required: true
                         },
                         serial_no: {
                              required: true
                         },
                         room_name: {
                              required: true
                         },
                         item_name: {
                              required: true
                         },
                         cost_to_replace: {
                              required: true
                         }
                    },
                    messages: {
                         quantity: "Please enter quantity",
                         age_in_years: "Please enter age in years",
                         age_in_months: "Please enter age in months",
                         brand: "Please enter brand",
                         model: "Please enter model",
                         serial_no: "Please enter serial number",
                         room_name: "Please enter room name",
                         item_name: "Please enter item name",
                         cost_to_replace: "Please enter cost to replace"
                    },
                    errorElement: "em",
                    errorPlacement: function (error, element) {
                         error.addClass("help-block");

                         if (element.prop("type") === "checkbox") {
                              error.insertAfter(element.parent("label"));
                         } else {
                              error.insertAfter(element);
                         }
                    },
                    highlight: function (element, errorClass, validClass) {
                         $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                    },
                    unhighlight: function (element, errorClass, validClass) {
                         $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                    }
               });
               if ($form.valid()) {
                    $this.button('loading');
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
                                   $this.button('reset');
                                   $('.ajax-label').show();
                                   $(".ajax-label").removeClass("alert-danger");
                                   $(".ajax-label").addClass("alert-success");
                                   $(".ajax-label-body").html(data.message);
                              }
                         },
                         error: function (data) {
                              $this.button('reset');
                              $('.ajax-label').show();
                              var response = $.parseJSON(data.responseText);
                              $(".ajax-label").addClass("alert-danger");
                              $(".ajax-label").removeClass("alert-success");
                         }
                    });
               }
          }); //End save label function

          $('body').on('click', '.save_photos', function () {
               var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 20) {
                    alert("You can only upload a maximum of 20 files at a time");
                    $("input[type='file']").val('');
                    $('#photos').html('');
               } else {
                    $this = $(this);
                    $form = $(this).parents('form');
                    var type = $form.find("select[name='type']").val();

                    var group_id = $form.find('select[name="group_id"]').val();
                    if (type == 'group' && group_id == 'none') {
                         $('.add_photo_group').css('border', '1px solid red');
                         $('html .modal').animate({scrollTop: 0}, 1000);
                         return false;
                    } else {
                         $('#image_uploading').removeAttr('required');
                         $('.add_photo_group').css('border', '1px solid #e8e8e8');
                    }
<<<<<<< HEAD
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
            if ($form.valid()) {
                $this.button('loading');
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
                            $this.button('reset');
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                            $('html .modal').animate({scrollTop: 0}, 1000);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $this.button('reset');
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $this.button('reset');
                        $('.ajax-label').show();
                        var response = $.parseJSON(data.responseText);
                        $(".ajax-label").addClass("alert-danger");
                        $(".ajax-label").removeClass("alert-success");
                    }
                });
            }
        }); //End save label function

        $('body').on('click', '.save_photos', function () {
            $this = $(this);
            $form = $(this).parents('form');
            var type = $form.find("select[name='type']").val();

            var group_id = $form.find('select[name="group_id"]').val();
            var validation_rule = {};

            if (type == 'single') {
                validation_rule = {
                    image: "required",
                    rood_id: "required",
                    quantity: "required",
                    age_in_years: "required",
                    age_in_months: "required",
                    brand: "required",
                    model: "required",
                    item_name: "required",
                    cost_to_replace: "required",
                };
            } else if (type == 'multi') {
                var validation_rule = {
                    group_image: "required",
                };
            } else {
                if (group_id == '-1') {
                    validation_rule = {
                        group_title: "required",
                        group_image: "required",
                        rood_id: "required",
                        quantity: "required",
                        age_in_years: "required",
                        age_in_months: "required",
                        brand: "required",
                        model: "required",
                        item_name: "required",
                        cost_to_replace: "required",
                    };
                } else {
                    validation_rule = {
                        group_id: "required"
                    };
                }
            }
            $form.validate();
//            $form.validate({
////            $('#select_photo_frm').validate({
//                    rules: validation_rule,
//                errorElement: "em",
//                errorPlacement: function (error, element) {
//                    error.addClass("help-block");
//                },
//                highlight: function (element, errorClass, validClass) {
//                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
//                },
//                unhighlight: function (element, errorClass, validClass) {
//                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
//                }
//            });

            if ($form.valid()) {
                $this.button('loading');
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
                             $this.button('reset');
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                            $('html .modal').animate({scrollTop: 0}, 1000);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $this.button('reset');
                            $('.ajax-label').show();
                            $(".ajax-label").removeClass("alert-danger");
                            $(".ajax-label").addClass("alert-success");
                            $(".ajax-label-body").html(data.message);
                        }
                    },
                    error: function (data) {
                        $this.button('reset');
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
                    data: {'table': 'label', 'id': id},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.ajax-msg').show();
                            $(".ajax-msg").removeClass("alert-danger");
                            $(".ajax-msg").addClass("alert-success"); 
                            $(".ajax-body").html(data.message);
                            setTimeout(function () {
                                 window.location.reload();
                            }, 200);
                        } else {
                            $('.ajax-msg').show();
                            $(".ajax-msg").removeClass("alert-danger");
                            $(".ajax-msg").addClass("alert-success");
                            $(".ajax-body").html(data.message);
                        }
=======
                    var validation_rule = {};

                    if (type == 'single') {
                         validation_rule = {
                              image: "required",
//                        rood_id: "required",
                              quantity: "required",
                              age_in_years: "required",
                              age_in_months: "required",
                              brand: "required",
                              model: "required",
                              serial_no: "required",
                              item_name: "required",
                              room_name: "required",
                              cost_to_replace: "required",
                         };
                    } else if (type == 'multi') {
                         var validation_rule = {
                              group_image: "required",
                         };
                    } else {
                         if (group_id == '-1') {
                              validation_rule = {
                                   group_id: "required",
                                   group_title: "required",
//                            group_image: "required",
//                            rood_id: "required",
                                   quantity: "required",
                                   age_in_years: "required",
                                   age_in_months: "required",
                                   brand: "required",
                                   model: "required",
                                   item_name: "required",
                                   room_name: "required",
                                   cost_to_replace: "required",
                              };
                         } else {
                              validation_rule = {
                                   group_id: "required"
                              };
                         }
                    }
                    $form.validate();

                    if ($form.valid()) {
                         $this.button('loading');
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
                                        $this.button('reset');
                                        $('.ajax-label').show();
                                        $(".ajax-label").removeClass("alert-danger");
                                        $(".ajax-label").addClass("alert-success");
                                        $(".ajax-label-body").html(data.message);
                                   }
                              },
                              error: function (data) {
                                   $this.button('reset');
                                   $('.ajax-label').show();
                                   var response = $.parseJSON(data.responseText);
                                   $(".ajax-label").addClass("alert-danger");
                                   $(".ajax-label").removeClass("alert-success");
                              }
                         });
>>>>>>> 5d2a6797be4912cd22b910b7d0a87996d01bc97f
                    }
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
                         data: {'table': 'label', 'id': id},
                         beforeSend: function (request) {
                              return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                         },
                         success: function (data) {
                              if (data.success) {
                                   $('.ajax-msg').show();
                                   $(".ajax-msg").removeClass("alert-danger");
                                   $(".ajax-msg").addClass("alert-success");
                                   $(".ajax-body").html(data.message);
                                   setTimeout(function () {
                                        // window.location.reload();
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
          //Delete group
          $('body').on('click', '.del_group', function () {
               var id = $(this).attr('data-id');
               $('.confirm_message').html('Are you sure to delete this group?');
               $('#confirmModal').modal({
                    backdrop: 'static',
                    keyboard: false
               }).one('click', '#delete', function (e) {
                    $.ajax({
                         url: base_url + 'delete_record',
                         type: 'POST',
                         dataType: 'json',
                         data: {'table': 'groups_photos', 'id': id},
                         beforeSend: function (request) {
                              return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                         },
                         success: function (data) {
                              if (data.success) {
                                   $('.ajax-msg').show();
                                   $(".ajax-msg").removeClass("alert-danger");
                                   $(".ajax-msg").addClass("alert-success");
                                   $(".ajax-body").html(data.message);
//                            $('html').animate({scrollTop: 0}, 1000);
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
          //Delete item
          $('body').on('click', '.del_list', function () {
               var id = $(this).attr('data-id');
               $('.confirm_message').html('Are you sure to delete complete items?');
               $('#confirmModal').modal({
                    backdrop: 'static',
                    keyboard: false
               }).one('click', '#delete', function (e) {
                    $.ajax({
                         url: base_url + 'delete_record',
                         type: 'POST',
                         dataType: 'json',
                         data: {'table': 'list_detail', 'id': id},
                         beforeSend: function (request) {
                              return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                         },
                         success: function (data) {
                              if (data.success) {
                                   $('.ajax-msg').show();
                                   $(".ajax-msg").removeClass("alert-danger");
                                   $(".ajax-msg").addClass("alert-success");
                                   $(".ajax-body").html(data.message);
                                   //$('html').animate({scrollTop: 0}, 1000);
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

          //Delete group
          $('body').on('click', '.del_group', function () {
               var id = $(this).attr('data-id');
               $('.confirm_message').html('Are you sure to delete complete items?');
               $('#confirmModal').modal({
                    backdrop: 'static',
                    keyboard: false
               }).one('click', '#delete', function (e) {
                    $.ajax({
                         url: base_url + 'delete_record',
                         type: 'POST',
                         dataType: 'json',
                         data: {'table': 'groups_photos', 'id': id},
                         beforeSend: function (request) {
                              return request.setRequestHeader('X-CSRF-Token', '<?= csrf_token(); ?>');
                         },
                         success: function (data) {
                              if (data.success) {
                                   $('.ajax-msg').show();
                                   $(".ajax-msg").removeClass("alert-danger");
                                   $(".ajax-msg").addClass("alert-success");
                                   $(".ajax-body").html(data.message);
                                   //$('html').animate({scrollTop: 0}, 1000);
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
               var img_id = $(this).attr('data-img-id');
               var type = $(this).attr('data-type');
               var group_id = $(this).attr('data-group-id');


//            var label_room_id = $(this).parents('.label_div').find('.label_room_id').text();
               var label_title = $(this).parents('.label_div').find('.label_title').text();
               var room_name = $(this).parents('.label_div').find('.label_room_name').text();
               var brand = $(this).parents('.label_div').find('.label_brand').text();
               var model = $(this).parents('.label_div').find('.label_model').text();
               var serial_no = $(this).parents('.label_div').find('.label_serial_no').text();
               var quantity = $(this).parents('.label_div').find('.label_quantity').text();
//            var age_year = $(this).parents('.label_div').find('.label_age_year').text();
               var age_month = $(this).parents('.label_div').find('.label_age_month').text();
               var age_year = $(this).parents('.label_div').find('.label_age_year').text();
               var cost_to_repair = $(this).parents('.label_div').find('.label_cost_to_replace').text();
//            $('#myModal' + img_id).find('select').val(label_room_id);
//            $('select').niceSelect('update');

               $('#myModal' + img_id).find('input[name=edit_id]').val(id);
               if (typeof group_id != 'undefined' && group_id != '') {
                    //There will be group id in img_id
                    $('#myModal' + img_id).find('input[name=type_item]').val('group');
                    $('#myModal' + img_id).find('input[name=edit_id]').val(group_id);
               }
               $('#myModal' + img_id).find('input[name=item_name]').val(label_title);
               $('#myModal' + img_id).find('input[name=room_name]').val(room_name);
               $('#myModal' + img_id).find('input[name=brand]').val(brand);
               $('#myModal' + img_id).find('input[name=model]').val(model);
               $('#myModal' + img_id).find('input[name=serial_no]').val(serial_no);
               $('#myModal' + img_id).find('input[name=quantity]').val(quantity);
               $('#myModal' + img_id).find('input[name=cost_to_replace]').val(cost_to_repair);
               $('#myModal' + img_id).find('input[name=age_in_years]').val(age_year);
               $('#myModal' + img_id).find('input[name=age_in_months]').val(age_month);

               $('#myModal' + img_id).modal('show');
          });

          $('.modal').on('hidden.bs.modal', function () {
               $('.label_frm')[0].reset();
          });
     });

</script>