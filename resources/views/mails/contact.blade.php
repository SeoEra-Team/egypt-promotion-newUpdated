<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <title>{{ $msg }}</title>
     <style>
        .mails__form {
            max-width: 50%;
            margin: 0 auto;
        }

        @media (max-width: 768px) {

            .mails__form {
                max-width: 100%;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div style="width: 100%;background:#eee;">
        <div class="mails__form">
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important;">
                <tbody>
                <tr>
                    <td valign="top" style="padding: 1em 2.5em; background: #ffffff;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                            <tbody>
                            <tr>
                                <td width="40%" style="text-align: left;">
                                    <h1 style="font-family: 'Poppins', sans-serif; color: #000000; margin-top: 0; margin: 0;">
                                        <a href="{{ env('APP_URL') }}" style="text-decoration: none; color: #000000; font-size: 20px; font-weight: 700; text-transform: uppercase; font-family: 'Poppins', sans-serif;" target="_blank">
                                            <img loading="lazy" src="{{env('APP_URL')}}/storage/edl2jg82DqwiXeac85ZLlZ1H2AJah91ftyIo.png"
                                                 alt="{{ nova_get_setting_translate('logo_alt') }}"
                                                 title="{{ nova_get_setting_translate('logo_title') }}"
                                                 style="width: 60%;" class="CToWUd" data-bit="iit" />
                                        </a>
                                    </h1>
                                </td>
                                <td width="60%" style="text-align: right;">
                                    <ul style="padding: 0;">
                                        <li style="list-style: none; display: inline-block; margin-left: 5px; font-size: 13px; font-weight: 500;">
                                            <a href="{{ route('home') }}" style="text-decoration: none; color: rgba(0, 0, 0, 0.4);" target="_blank">
                                                {{ __('general.home') }}
                                            </a>
                                        </li>
                                        <li style="list-style: none; display: inline-block; margin-left: 5px; font-size: 13px; font-weight: 500;">
                                            <a href="{{ route('blog.category') }}" style="text-decoration: none; color: rgba(0, 0, 0, 0.4);" target="_blank">
                                                {{ __('general.blog') }}
                                            </a>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td valign="top" style="padding: 0 1em; background: #ffffff;">
                        <h2 style="color: #000; padding: 0; text-align: left; margin:50px 0 15px 0;">{{ $msg }}</h2>

                    </td>
                </tr>
                </tbody>
            </table>

            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important;">
                <tbody>
                <tr>
                    <td valign="middle" style=" background: #1D231F; padding:0 2.5em; padding-top: 0; color: rgba(255, 255, 255, 0.5); ">
                        <table style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                            <tbody>
                            <tr>
                                <td valign="top" width="70%" style="padding-top: 20px;">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                                        <tbody>
                                        <tr>
                                            <td style="text-align: left; padding-right: 10px;">
                                                <h3 style="font-family: 'Poppins', sans-serif; color: #ffffff; margin-top: 0; font-size: 20px;">{{ __('mail.about_us') }}</h3>
                                                <p style="color: #fff;">{{ __('mail.about_us_text') }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td valign="top" width="30%" style="padding-top: 20px;">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                                    <h3 style="font-family: 'Poppins', sans-serif; color: #ffffff; margin-top: 0; font-size: 20px;">{{ __('mail.contact') }}</h3>
                                                    <ul style="margin: 0; padding: 0;">
                                                        <li style="list-style: none; margin-bottom: 10px;">
                                                            <span style="color: #fff;">
                                                                <a>{{ nova_get_setting_translate('site_address') }}</a>
                                                            </span>
                                                        </li>
                                                        <li style="list-style: none; margin-bottom: 10px;"><span style="color: #fff;"> {{ nova_get_setting('site_phone') }} </span></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
