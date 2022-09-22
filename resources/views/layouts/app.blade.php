<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    @yield("head")

    <meta charset="utf-8">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("/css/stylesheet.css") }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head><body>

    <br>
    <div id="body">
        <!-- begins: body -->
        @yield("body")
        <!-- ends: body -->
    </div>
    <div class="clear-fix"></div>
    <br>
    
    <div id="popup" class="fixed-top rounded" style="display:none;"></div>

    <!--
        <div class="d-flex justify-content-start"></div>
        <div class="d-flex justify-content-end"></div>
        <div class="d-flex justify-content-center"></div>
    -->    

</body>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset("/js/script.js") }}"></script>
        <script>

            if(top!=self) 
            {
                top.location.href=self.location.href;
            }
            
            $(function() 
            {
                $("#logout").on("click", function(e) 
                {
                    e.preventDefault();
                    $("#logout-form").submit();
                });
            });

        </script>
        @yield("scripts")

</html>
<!-- version 0.01 -->