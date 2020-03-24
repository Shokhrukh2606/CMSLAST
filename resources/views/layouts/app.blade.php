<html prefx="og: http://ogp.me/ns#">
    <head>
        <title>{{$title}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta property="og:title" content="{{$meta->meta_title}}">
        <meta property="og:description" 
          content="{{$meta->meta_description}}" />
         <meta property="og:determiner" content="the" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ Request::url()}}" />
        <meta property="og:locale" content="uz_UZ" />
        <meta property="og:locale:alternate" content="uz_UZ" />
        <meta property="og:locale:alternate" content="en_EN" />
        <meta property="og:locale:alternate" content="ru_RU" />
        <meta property="og:site_name" content="Loctech" />
        <meta property="og:image" content="{{asset('logo.png')}}" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="200" />
        <meta property="og:image:height" content="200" />
        {{-- <meta property="og:video" content="http://example.com/bond/trailer.swf" /> --}}
        <link rel="shortcut icon" href="{{asset("favicon.ico")}}">
    @include('layouts.head')
    </head>
    <body>
            @include('layouts.header')
            @yield('content')
                @include('layouts.footer')
        @include('layouts.bottomAssets')
    </body>
</html>