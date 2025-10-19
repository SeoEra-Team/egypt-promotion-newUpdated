@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('site_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('site_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('site_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('logo')),
        'schema' => nova_get_setting('site_schema'),
    ])
@endsection
@section('extraStyles')
    <style>
        .desc-special-offer * {
            font-size: 30px !important;
            font-weight: 400 !important;
            color: #16243d !important;
            margin-bottom: 10px !important;
        }
    </style>
@endsection
@section('content')
    @include('home.partials.banner')
@endsection
@section('extraScripts')
    <script src="{{ asset('assets/js/home.js') }}"></script>    
    @include('layout.partials.notification')
    @include('layout.partials.timer')
@endsection
