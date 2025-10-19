<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() ?? 'en' }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ Storage::url(nova_get_setting('favicon', asset('assets/images/favicon.icon'))) }}">
    @include('layout.partials.assets.style-assets')

    @yield('extraStyles')
@yield('schema')
@yield('sub_schema')
</head>

<body>

    @include('layout.partials.header')
    @include('layout.partials.mobile_header')
    @yield('content')
    @include('layout.partials.partners')
    @include('layout.partials.footer')

    @include('layout.partials.static_section')

    @include('layout.partials.assets.script-assets')

    @include('layout.partials.assets.script-master')




    @yield('extraScripts')
    <script type="text/javascript">
        $('#currencyId').on('change', function(e) {
            $('#switchCurrency').submit();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.addfavorite').on('click', function(e) {
                e.preventDefault();
                $(this).find('i:first').toggleClass('isfavorite').toggleClass('notfavorite');
                $(this).find('i:first').toggleClass('fa-regular').toggleClass('fa-solid');
                $.ajax({
                    url: $(this).data('href'),
                    method: 'GET',
                }).done(function(response) {
                    if (response.status) {
                        window.location.reload();
                    }
                }).fail(function(response) {
                    handleFailure(response);
                })
            });
        });
    </script>

</body>

</html>
