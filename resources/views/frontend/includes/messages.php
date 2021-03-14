<?php if ($errors->any()): ?>
    <div class="alert alert-danger">
        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>-->
        <?php echo implode('', $errors->all('<p>:message</p>')) ?>
    </div>
<?php endif; ?>

<?php if (Session::has('error')) { ?>
    <div class="alert alert-danger">
        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>-->
        <?php echo Session::get('error') ?>
    </div>
<?php } ?>

<?php if (Session::has('success')) { ?>
    <div class="alert alert-success">
        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>-->
        <?php echo Session::get('success') ?>
    </div>
<?php } ?>
<div class="alert alert-success fade in alert-dismissible ajax-msg" style="display: none;">
    <!--<a href="#" class="close" data-dismiss="ajax-msg" aria-label="close" title="close">×</a>-->
    <span class="ajax-body"></span>
</div>