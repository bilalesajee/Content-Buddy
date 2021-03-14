<!DOCTYPE html>
<html lang="en">
<?php include resource_path('views/admin/include/top.php'); ?>

<body>
    <div id="wrapper"> 
<?php include resource_path('views/admin/include/side_bar.php'); ?>
  <div id="page-wrapper" class="gray-bg">
     
        <?php include resource_path('views/admin/include/header.php'); ?>
        <?php include 'admin/'.$currentView.'.php'; ?>
      <div class="footer">
          <div class="pull-right">
               
          </div>
          <div>
               
          </div>
      </div>      
  </div>
</div>
<?php include resource_path('views/admin/include/footer.php'); ?>
    
</body>

</html>