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
@section('content')
    @include('home.partials.banner')
    @include('home.partials.first_sub_categories_section')
    @include('home.partials.first_tour_section')
    @include('home.partials.second_tour_section')
    @include('home.partials.second_sub_categories_section')
    @include('home.partials.articles_section')
    @include('home.partials.book_amazing_section')
    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script>
        
        // document.addEventListener("DOMContentLoaded", function () {
        //     const tabContainer = document.querySelector(".tab-container");
        //     const tabButtons = tabContainer.querySelectorAll(".travel-tab-btn");

        //     tabButtons.forEach((btn) => {
        //         btn.addEventListener("click", () => {
        //             tabContainer.scrollTo({
        //                 left: btn.offsetLeft - 10,
        //                 behavior: "smooth"
        //             });
        //         });
        //     });

        //     document.querySelector(".right-btn").addEventListener("click", () => {
        //         tabContainer.scrollBy({
        //             left: 150,
        //             behavior: "smooth"
        //         });
        //     });

        //     document.querySelector(".left-btn").addEventListener("click", () => {
        //         tabContainer.scrollBy({
        //             left: -150,
        //             behavior: "smooth"
        //         });
        //     });
        // });
    </script>
@endsection
