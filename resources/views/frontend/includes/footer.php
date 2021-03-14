<!--cofirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5> 
            </div>
            <div class="modal-body">
                <span class="confirm_message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Yes</button>
                <button type="button" data-dismiss="modal" id="concel_confirm" class="btn">No</button>
            </div>
        </div>
    </div>
</div> 

<!--Add  item model -->
<div class="modal fade" id="addItemModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="cus-form">
                    <form action="<?= url('') ?>" method="post">
                        <?= csrf_field(); ?>
                        <button type="button" class="close cus-modal-xbtn" data-dismiss="modal"></button>
                        <h4>Add Room</h4>
                        <div class="cus-input-row">
                            <label> Room Name *</label>
                            <input type="text" id="title" name="title" required=""/>
                        </div>
<!--                        <div class="cus-input-row">
                            <label>Item Description *</label>
                            <textarea rows="5" class="form-control" id="item_description" name="description" required=""></textarea>
                        </div>-->
                        <div class="cus-btn-main">
                            <!--<input type="button" value="Create" class="submit_items cus-btn" />-->
                            <button type="button" class="submit_items cus-btn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Add  item model -->
<script src="<?= asset('userasset'); ?>/js/bootstrap.min.js"></script>  
<script src="<?= asset('userasset'); ?>/js/jquery.nice-select.min.js"></script> 
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
 <script src="<?= asset('userasset'); ?>/js/regix.js"></script> 
<script>
    function showLoading() {
 
    }
    function hideLoading() { 
    }
    $(document).ready(function () {
        $('select').niceSelect();
        $('header .pro-drop-main').click(function () {
            $('.cus-pro-drop').slideToggle();
        });
        $('.menu-icon').click(function () {
            $('.cus-sidebar').toggleClass('cus-sidebar-view');
        });

        //Add item   
        $('body').on('click', '.submit_items', function () {
            
            $title_length = $.trim($('#title').val());
            $item_description = $.trim($('#item_description').val());
            if($title_length == ''){
                $('#title').val(null);
//            }else if($item_description == ''){
//                $('#item_description').val(null);
//            }else{
            }else{
                $('.submit_items').button('loading');
            }
            $form = $(this).parents('form');
            $form.validate({
                rules: {
                    title: "required"
//                    description: "required"
                },
                messages: {
                    title: "Please enter title"
//                    description: "Please enter description"
                },
                errorElement: "em",
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".cus-input-row").addClass("has-success").removeClass("has-error");
                }
            });
            if ($form.valid()) {
                $.ajax({
                    url: base_url + 'user_add_item',
                    type: 'POST',
                    dataType: 'json',
                    data: $form.serialize(),
                    success: function (data) {
                        window.location.reload();
                    }
                });
            }
        });
        //End add item

    });
</script>
</body> 
</html>
