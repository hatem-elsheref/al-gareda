
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-left hidden-xs">
        <b>Version</b> 2.2.0
    </div>
    <strong>Copyright &copy; 2019-2020 
        <a href="https://www.facebook.com/hatem.elsheref.73/">Hatem Mohamed Elsheref</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.1.4 -->
<script src="{{asset('dashboard/assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.4 -->
<script src="{{asset('dashboard/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('dashboard/assets/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('dashboard/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('dashboard/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('dashboard/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('dashboard/assets/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<!-- datepicker -->
<!-- Bootstrap WYSIHTML5 -->
{{--<script src="{{asset('dashboard/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>--}}
<!-- Slimscroll -->
<script src="{{asset('dashboard/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('dashboard/assets/plugins/fastclick/fastclick.min.js')}}"></script>


@stack('scripts')

<!-- AdminLTE App -->
<script src="{{asset('dashboard/assets/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dashboard/assets/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dashboard/assets/dist/js/demo.js')}}"></script>



</body>
</html>
