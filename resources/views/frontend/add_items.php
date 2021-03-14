<main class="full-page">
           <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
            <div class="cus-section">
               <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>
                <div class="page-inside">
                    <h3>Add Item</h3>
                    <div class="cus-select-area">
                        <select style="display: none;">
                            <option>Bedroom</option>
                            <option>Laundry</option>
                            <option>Other</option>
                        </select><div class="nice-select" tabindex="0"><span class="current">Bedroom</span><ul class="list"><li data-value="Bedroom" class="option selected">Bedroom</li><li data-value="Laundry" class="option">Laundry</li><li data-value="Other" class="option">Other</li></ul></div>
                        <div class="cus-btn-main">
                            <a href="#" class="cus-btn">Save</a>
                        </div>
                    </div>
                    <div class="heading-btn-sec">
                        <h3>Add Photos</h3>
                        <a href="add-item.html" class="cus-btn-green">Add Photos</a>
                    </div>
                    <div class="main-top-row">
                        <div class="content-img-detail">
                            <div class="img-with-text">
                                <img src="<?= asset('userasset') ?>/img/group-icon.png" alt="icon">
                                <strong>12</strong>
                                <span>Groups</span>
                            </div>
                            <div class="img-with-text">
                                <img src="<?= asset('userasset') ?>/img/photos-icon.png" alt="icon">
                                <strong>363</strong>
                                <span>Photos</span>
                            </div>
                        </div>
                        <div class="sort-btn-right">
                            <a href="add-item.html" class="cus-btn-green cus-btn-image"><img src="<?= asset('userasset') ?>/img/c-group-icon.png" alt="icon"> Create Group</a>
                            <a href="#" class="bg-sort-color"><img src="<?= asset('userasset') ?>/img/list-view-icon.png" alt="icon"></a>
                            <a href="#" class="bg-sort-color"><img src="<?= asset('userasset') ?>/img/thumb-view-icon.png" alt="icon"></a>
                        </div>
                    </div>
                    <div class="sort-item-main-sec">
                        <div class="sort-item-row">
                            <figure style="background-image: url('<?= asset('userasset') ?>/img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="#" data-toggle="modal" data-target="#myModal" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('<?= asset('userasset') ?>/img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('<?= asset('userasset') ?>/img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('<?= asset('userasset') ?>/img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('<?= asset('userasset') ?>/img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sort-item-row">
                            <figure style="background-image: url('img/img1.png')"></figure>
                            <div class="sort-detail-area-sec">
                                <div class="sort-top-row">
                                    <div class="sort-top-col">
                                        <span class="sort-sub-title">Bedroom</span>
                                        <h4>No title added yet</h4>
                                    </div>
                                    <div class="sort-top-col sort-top-col-right">
                                        <a href="add-item.html" class="cus-btn-orange cus-btn-image">+ Add Multiple Info</a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/pen-icon.png" alt="icon"></a>
                                        <a href="#" class=""><img src="<?= asset('userasset') ?>/img/del-icon.png" alt="icon"></a>
                                    </div>
                                </div>
                                <div class="sort-bot-row">
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Brand/ Manufacture</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Model &amp; Serial Number</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Quantity Lost</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Age</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                    <div class="sort-bot-col">
                                        <span class="sort-bot-title">Cost to Replace (each) Pre Tax</span>
                                        <span class="sort-bot-detail">No info added</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>