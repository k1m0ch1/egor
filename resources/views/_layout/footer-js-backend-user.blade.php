<div class="modal"><!-- Place at bottom of page --></div>
<script>
 // var host = "{{ Config::get('app.url') }}";
 // var dir_host = "{{ Config::get('app.url') }}";
 var host = "{{asset('')}}";
 var dir_host = "{{asset("")}}";
</script>
    <script src="{{ asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets/vendor/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('assets/vendor/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/vendor/AdminLTE/dist/js/app.min.js') }}"></script>
    <!-- page script -->
    <script src="{{ asset('assets/js/general.js') }}"></script>
    @if($title=="Users")
      <script src="{{ asset('assets/js/user_js.js') }}"></script>
    @endif
    @if($title=="Preference")
      <script src="{{ asset('assets/js/preference.js') }}"></script>
      <script src="{{ asset('assets/js/image-picker.js') }}"></script>
    @endif
    @if($title=="Menu")
      <script src="{{ asset('assets/js/menuEvent.js') }}"></script>
      <script src="{{ asset('assets/js/menuOperation.js') }}"></script>
    @endif
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $body = $("body");

      });
      $(document).on({
          ajaxStart: function() { $body.addClass("loading");    },
           ajaxStop: function() { $body.removeClass("loading"); }
      });
    </script>
  </body>
</html>
