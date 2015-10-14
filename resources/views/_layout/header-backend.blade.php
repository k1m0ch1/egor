<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @foreach($css as $listCSS)
        <link rel="stylesheet" href="{{ $listCSS }}">
    @endforeach
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">