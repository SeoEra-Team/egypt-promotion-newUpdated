<title>{{ $title }}</title>
<meta name="description" content="{!! $description !!}">
<meta name="keywords" content="{{ $keywords }}">

<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:title" content="{{ $title }}"/>
<meta property="og:description" content="{!! $description !!}"/>
<meta property="og:image" content="{{ $image }}"/>

<meta property="og:site_name" content="{{ $title }}"/>
<meta name="author" content="{{ $title }}">
<meta property="og:type" content="{{ $title }}">
<link href="{{ url()->current() }}" rel="canonical">

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{ '@'. nova_get_setting('site_name', env('APP_NAME')) }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{!! $description !!}">
<meta name="twitter:image" content="{{ $image }}">

{!! $schema !!}



