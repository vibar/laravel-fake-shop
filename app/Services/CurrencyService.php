<?php

namespace App\Services;

use App\Currency;

class CurrencyService
{
    /**
     * @var string
     */
    private $url = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * @param Currency $currency
     * @return mixed
     */
    public function sync(Currency $currency)
    {
        $xml = simplexml_load_file($this->url);

        foreach ($xml->Cube->Cube->Cube as $row) {

            if ($currency->code == $row['currency']) {

                $currency->rate = $row['rate'];
                $currency->save();

                return $currency;
            }

        }

        // TODO: Log error. Currency code not found
    }
}
