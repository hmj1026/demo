<?php

namespace App\Presenters\User;

use Illuminate\Database\Eloquent\Model;

class FullnamePresenter
{
    public function getFullname(Model $model)
    {
        $ret = '';

        if ($model) {
            $lastname = $model->detail->last_name ?? '';
            $firstname = $model->detail->first_name ?? '';

            $ret = $lastname . ' ' . $firstname;
        }

        return $ret;
    }
}