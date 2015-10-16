    <script>
      var dir_host = "{{ Config::get('app.url') }}/egor/public/";
      var host = "{{ Config::get('app.url') }}/egor/public/index.php/";
    </script>

    @foreach($jH as $jsHeader)
        <script src="{{ $jsHeader }}"></script>
    @endforeach
      $.widget.bridge('uibutton', $.ui.button);

      <script>
      	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
    </script>