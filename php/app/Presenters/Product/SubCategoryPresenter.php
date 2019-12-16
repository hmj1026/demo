<?php

namespace App\Presenters\Product;

use Illuminate\Database\Eloquent\Model;

class SubCategoryPresenter
{
    public function getSubCategory(Model $model, $type, $isEditable = false)
    {
        $ret = '';

        $subCategory = [
            [
                'text' => 'treadmill',
                'value' => 1
            ],
            [
                'text' => 'elliptical',
                'value' => 2
            ],
            [
                'text' => 'rowing_machine',
                'value' => 3
            ],
            [
                'text' => 'bike',
                'value' => 4
            ],
            [
                'text' => 'indoor_cycling',
                'value' => 5
            ],
            [
                'text' => 'functional_machine',
                'value' => 6
            ],
        ];

        if ($type === 'title') {
            $filtered = collect($subCategory)->filter(function($item) use ($model) {
                return $item['value'] === $model->sub_category_id;
            })->first();

            $ret = $filtered['text'] ?? 'UNKNOWN';
        }

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($subCategory)->reduce(function($carry, $item) use ($model, $isEdit) {
                $isChecked = isset($model) && (int)$item['value'] === (int)$model->sub_category_id 
                    ? 'checked' 
                    : '';
                
                #新增帳號，預設狀態為普通
                if (! isset($model) && empty($isChecked) && (bool)$item['value'] === 2) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="sub_category_id" id="sub_category_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= trans('product/sub_category.'.$item['text']);
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}