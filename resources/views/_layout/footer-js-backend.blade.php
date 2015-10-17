    <script>
      var dir_host = "{{ Config::get('app.url') }}";
      var host = "{{ Config::get('app.url') }}";
    </script>

    @foreach($jH as $jsHeader)
        <script src="{{ $jsHeader }}"></script>
    @endforeach
      $.widget.bridge('uibutton', $.ui.button);

      <script>
      	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
    </script>