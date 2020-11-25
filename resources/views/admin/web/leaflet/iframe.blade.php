<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iframe</title>
    <style>
        div {
            box-sizing: border-box;
        }
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        .page_section {
            width: 8.833333333cm; height: 21cm; float: left; display: block; 
            @if ($type == 'page') border: 1px dashed #ddd; @endif
            margin-right: 5px;
            /* position:relative; */
        }

        @if ($type == 'pdf')
            @page { size: 26.5cm 21cm; 
             margin: 0; }
        @endif
    </style>
</head>
<body>
<div style="width: 100%; float: left;">
    @if ($type == 'page')
        <h2 style="text-align: center">Front Page</h2>
    @endif
    @for ($i = 1; $i <= 3; $i++) 
        <div id="preview_contentid_{{$i}}" class="page_section" style="">
        @if(count($pages))
            @foreach ($pages as $page)
                @if($page->page_no == $i)
                    {!! $page->page_content !!}
                @endif
            @endforeach
        @else 
            <div style="text-align:center;">
                <p>Page - {{$i}}</p>
            </div>
        @endif
        </div>
    @endfor
</div>    
<br>
<div style="width: 100%; float: left;">
    @if ($type == 'page')
        <h2 style="text-align: center">Back Page</h2>
    @endif
    @for ($i = 4; $i <= 6; $i++) 
        <div id="preview_contentid_{{$i}}" class="page_section">
            @if(count($pages))
                @foreach ($pages as $page)
                    @if($page->page_no == $i)
                        {!! $page->page_content !!}
                    @endif
                @endforeach
            @else 
                <div style="text-align:center;">
                    <p>Page - {{$i}}</p>
                </div>
            @endif
        </div>
    @endfor
</div>
</body>
</html>
