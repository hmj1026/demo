<?php

namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

class StatusPresenter
{
    public function getStatus(Model $model = null, $type = 'label', $isEditable = false)
    {
        $status = [
            [
                'text' => '無效',
                'value' => 0
            ],
            [
                'text' => '有效',
                'value' => 1
            ],
        ];

        if ($type === 'label') {
            $ret = (bool)$model->status === true 
                ? '<label class="label label-success">有效</label>' 
                : '<label class="label label-danger">無效</label>';
        }

        if ($type === 'status') {
            $ret = (bool)$model->status === true ? '有效' : '無效';
        }

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($status)->reduce(function($carry, $item) use ($model, $isEdit) {
                $isChecked = isset($model) && (bool)$item['value'] === (bool)$model->status 
                    ? 'checked' 
                    : '';
                
                #新增帳號，預設狀態為有效
                if (! isset($model) && empty($isChecked) && (bool)$item['value'] === true) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="status" id="status_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }
        
        
        return $ret;
    }
}