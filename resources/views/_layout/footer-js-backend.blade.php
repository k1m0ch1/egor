<script>
// var host = "{{ Config::get('app.url') }}";
// var dir_host = "{{ Config::get('app.url') }}";
var host = "{{asset('')}}";
var dir_host = "{{asset("")}}";
</script>

    @foreach($jH as $jsHeader)
        <script src="{{ $jsHeader }}"></script>
    @endforeach
      <script>
      	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
    </script>
