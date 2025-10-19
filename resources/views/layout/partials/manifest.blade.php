{
    "name": "{{ nova_get_setting('site_name', 'Exceptional Tours Egypt') }}",
    "short_name": "{{ nova_get_setting('site_short_name', 'Tours Egypt') }}",
    "start_url": "{{ nova_get_setting('site_start_url', '/') }}",
    "display": "{{ nova_get_setting('site_display_mode', 'standalone') }}",
    "background_color": "{{ nova_get_setting('site_background_color', '#ffffff') }}",
    "theme_color": "{{ nova_get_setting('site_theme_color', '#5bbad5') }}",
    "icons": [
        {
            "src": "{{ Storage::url(nova_get_setting('logo', asset('assets/images/logo.png'))) }}",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "{{ Storage::url(nova_get_setting('logo', asset('assets/images/logo.png'))) }}",
            "sizes": "512x512",
            "type": "image/png"
        }
    ]
}