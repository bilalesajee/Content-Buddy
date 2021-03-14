<!-- Mainly scripts -->

<script src="<?= asset('public/admin'); ?>/js/bootstrap.min.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="<?= asset('public/admin'); ?>/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?= asset('public/admin'); ?>/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= asset('public/admin'); ?>/js/inspinia.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="<?= asset('public/admin'); ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="<?= asset('public/admin'); ?>/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= asset('public/admin'); ?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="<?= asset('public/admin'); ?>/js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="<?= asset('public/admin'); ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="<?= asset('public/admin'); ?>/js/demo/sparkline-demo.js"></script>

<!-- Image selector-->
<script src="<?= asset('public/admin'); ?>/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- SUMMERNOTE -->
<script src="<?= asset('public/admin'); ?>/js/plugins/summernote/summernote.min.js"></script>

<!-- Data tables -->
<script src="<?= asset('public/admin'); ?>/js/plugins/dataTables/datatables.min.js"></script>

<!-- Sweet alert -->
<script src="<?= asset('public/admin'); ?>/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Data picker -->
<script src="<?= asset('public/admin'); ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Tags Input -->
<script src="<?= asset('public/admin'); ?>/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script>
    $(document).ajaxStart(function () {
        $('.ibox').children('.ibox-content').addClass('sk-loading');
    });
    $(document).ajaxComplete(function () {
        $('.ibox').children('.ibox-content').removeClass('sk-loading');
    });


    $(document).ready(function () {
         
        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });
        
        $('.create_date.date').datepicker({
            format: 'yyyy-m-d', 
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            
        });
        
        $('.input-group.date').datepicker({
            format: 'yyyy-m-d',
            startDate: '-0d', 
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            
        });
        
        

    });
</script>
