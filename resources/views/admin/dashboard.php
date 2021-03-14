<div class="wrapper wrapper-content">

    <div class="row">
        <a href="<?= url('manage_users/active') ?>">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Active Users</h5>
                    </div>
                    <div class="ibox-content" style="color: #2f9023;"> 
                        <h1 class="no-margins"><?= $active_users ?></h1>
                        <small>Active Users</small>                    
                    </div>
                </div>
            </div> 
        </a>
        <a href="<?= url('manage_users/inactive') ?>">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Pending/Inactive Users</h5>
                    </div>
                    <div class="ibox-content" style="color: #2f9023;"> 
                        <h1 class="no-margins"><?= $inactive_users ?></h1>
                        <small>Pending Users</small>                    
                    </div>
                </div>
            </div> 
        </a>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <a href="<?= url('manage_users/blocked') ?>">Blocked Users</a></h5>
                </div>
                <div class="ibox-content"> 
                    <h1 class="no-margins"><?= $blocked_users ?></h1>
                    <small>Blocked Users</small>                    
                </div>
            </div>
        </div> 
    </div> 

</div> 
</body>
</html>
