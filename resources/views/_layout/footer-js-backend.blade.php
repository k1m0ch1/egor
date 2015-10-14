    @foreach($jH as $jsHeader)
        <script src="{{ $jsHeader }}"></script>
    @endforeach
      $.widget.bridge('uibutton', $.ui.button);

      <script>
      	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
    </script>