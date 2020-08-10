<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>full stack blog</title>
        {{$metadataarray?? ''}}
        <link rel="stylesheet" href="{{mix('/css/all.css')}}"></link>
        <script>
            // following snippet does not work !!
            (function() { 
                window.Laravel = {
                    csrfToken = '{{ csrf_token() }}'
                };
            })();
        </script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div id="app">
            <mainapp></mainapp>
        </div>
    </body>
    <script src="{{mix('/js/app.js')}}"></script>
</html>
