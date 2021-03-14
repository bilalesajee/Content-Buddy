<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>

        <div class="page-inside">
            <div class="heading-btn-sec">
                <h2>Profiles</h2> 
            </div>
            <?php include resource_path('views/frontend/includes/messages.php'); ?> 
            <form action="<?= url('update_profile'); ?>" method="post" enctype="multipart/form-data" id="profile_frm">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" class="form-control" value="<?= $user->first_name; ?>" id="fname" name="first_name">
                </div>

                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" class="form-control" value="<?= $user->last_name; ?>" id="lname" name="last_name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" value="<?= $user->email; ?>" id="email" name="email" readonly="">
                </div>
                <div class="form-group">
                    <label for="email">Phone:</label>
                    <input type="text" class="form-control" value="<?= $user->phone; ?>" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="email">Address:</label>
                    <input type="text" class="form-control" value="<?= $user->address; ?>" id="address" name="address">
                </div>
                <div class="form-group">
                    <label for="email">City:</label>
                    <input type="text" class="form-control" value="<?= $user->city; ?>" id="city" name="city">
                </div>
                <div class="form-group">
                    <label for="email">State:</label>
                    <input type="text" class="form-control" value="<?= $user->state; ?>" id="state" name="state">
                </div>
                <div class="form-group">
                    <label for="email">Zip Code:</label>
                    <input type="text" class="form-control" value="<?= $user->zip_code; ?>" id="zip_code" name="zip_code">
                </div>

                <div class="form-group">
                    <label for="email">Profile image:</label>
                    <input type="file" class="form-control" name="image">
                     <span class="text-danger error_image"></span>
                </div>
                <button type="submit" class="btn btn-default">Update</button>
            </form>
        </div>

    </div>
    <script>
        $(document).ready(function () {
 
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
            $('#profile_frm').validate({
                rules: {
                    first_name: {
                        required: true,
                        specialChars: true
                    },
                    last_name: {
                        required: true,
                        specialChars: true
                    },
                    email: {
                            required: true,
                            email: true
                        },
                        address: {
                            required: true
                        },
                        city: {
                            required: true
                        },
                        state: {
                            required: true
                        },
                        zipcode: {
                            required: true,
                            specialChars: true
                        },
                        phone_no: {
                            required: true
                        }
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                }
                ,
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                }
                ,
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                }
            }
            );
        });
        jQuery.fn.ForceNumericOnly =
        function()
        {
            return this.each(function()
            {
                $(this).keydown(function(e)
                {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                    // home, end, period, and numpad decimal
                    return (
                        key == 8 || 
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };
        $("#phone").ForceNumericOnly();
    </script>
</main>