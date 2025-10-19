<?php

namespace App\Helpers\Classes;

use App\Helpers\Constants\GeneralHelper;
use App\Models\Currency as CurrencyModel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Currency
{
    /**
     * @return void
     */
    public static function setDefault(): void
    {
        if(!session()->has(GeneralHelper::CURRENCY_SESSION)) {
            $currency = CurrencyModel::whereStatus(true)
                ->whereId(nova_get_setting('default_currency', 1))
                ->firstOrFail(['id', 'code', 'symbol', 'rate']);

            session()->put([
                GeneralHelper::CURRENCY_SESSION => $currency
            ]);
        }
    }

    /**
     * @param $attr
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function get($attr) {
        $currentCurrency = session()->get(GeneralHelper::CURRENCY_SESSION);
        if(isset($currentCurrency->$attr))
            return $currentCurrency->$attr;
        return $currentCurrency->code;
    }

    /**
     * @param $price
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function display($price): string
    {
        // dd(self::get('rate'));
        return round(self::get('rate') * $price, 0).self::get('symbol');
    }

}
