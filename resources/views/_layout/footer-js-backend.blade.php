<script>
 var host = "{{ Config::get('app.url') }}/index.php/";
 var dir_host = "{{ Config::get('app.url') }}";
</script>

    @foreach($jH as $jsHeader)
        <script src="{{ $jsHeader }}"></script>
    @endforeach
      <script>
      	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      </script>
    </script>