
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    © 2017 <strong>My Story</strong> all right reserved.
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../../plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<!-- Select2 -->
<!--<script src="plugins/ckeditor/ckeditor.js"></script>-->
<script src="../../../plugins/select2/select2.full.min.js"></script>
<script src="../../../plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="../../../dist/js/app.min.js"></script>


<script>
    tinymce.init({
        selector:'#post_desc',
        plugins: ["image"],
        file_browser_callback: function(field_name, url, type, win) {
            if(type=='image') $('#post_desc').click();
        }
    });
    $(".select2").select2();
    $('#datepicker').datepicker({
        autoclose: true
    });
</script>
</body>
</html>
