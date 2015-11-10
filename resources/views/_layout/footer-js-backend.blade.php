<div class="modal"><!-- Place at bottom of page --></div>
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
        $body = $("body");

       $(document).on({
           ajaxStart: function() { $body.addClass("loading");    },
            ajaxStop: function() { $body.removeClass("loading"); }
       });
      </script>
    </script>
