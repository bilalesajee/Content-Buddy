<main class="full-page">
    <?php include resource_path('views/frontend/includes/profile_side_bar.php'); ?>
    <div class="cus-section">
        <?php include resource_path('views/frontend/includes/profile_top_bar.php'); ?>

        <div class="page-inside">
            <div class="heading-btn-sec">
                <h2>Change password</h2> 
            </div>
            
            <?php include resource_path('views/frontend/includes/messages.php'); ?> 

            <form action="<?= url('user_change_password'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="fname">Old Password:</label>
                    <input type="password" class="form-control" name="old_pass">
                </div>

                <div class="form-group">
                    <label for="lname">New Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="email">Confirm Password:</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-default">Update</button>
            </form>
        </div>

    </div>
</main>