<?php

/**
 * @param $settingKey
 * @param null $default
 * @return mixed|null
 */
function nova_get_setting_translate($settingKey, $default = null)
{
    $value = nova_get_setting($settingKey, $default);
    return json_decode($value)->{app()->getLocale()} ?? json_decode($value)->{app()->getLocale()} ?? $default;
}



