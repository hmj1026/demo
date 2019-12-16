<?php

namespace App\Presenters\User;

use Illuminate\Database\Eloquent\Model;

class FullAddressPresenter
{
    public function getFullAddress(Model $model)
    {
        $ret = '';

        if ($model) {
            $postcode = $model->detail->billing_postcode ?? '';
            $city = $model->detail->billing_city ?? '';
            $address = $model->detail->billing_address ?? '';

            $ret = $postcode . ' ' . $city . ' ' . $address;
        }

        return $ret;
    }
}