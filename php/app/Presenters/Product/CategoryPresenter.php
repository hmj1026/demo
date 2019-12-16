<?php

namespace App\Presenters\Product;

use Illuminate\Database\Eloquent\Model;

class CategoryPresenter
{
    public function getCategory(Model $model, $type, $isEditable = false)
    {
        $ret = '';

        $category = [
            [
                'text' => '商用',
                'value' => 1
            ],
            [
                'text' => '普通',
                'value' => 2
            ],
        ];

        if ($type === 'title') {
            switch($model->category_id) {
                case 1:
                    $ret = '商用';
                    break;
                case 2:
                    $ret = '普通';
                    break;
            }
        }

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($category)->reduce(function($carry, $item) use ($model, $isEdit) {
                $isChecked = isset($model) && (int)$item['value'] === (int)$model->category_id 
                    ? 'checked' 
                    : '';
                
                #新增帳號，預設狀態為普通
                if (! isset($model) && empty($isChecked) && (bool)$item['value'] === 2) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="category_id" id="category_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}