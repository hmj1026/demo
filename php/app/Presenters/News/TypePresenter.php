<?php

namespace App\Presenters\News;

use Illuminate\Database\Eloquent\Model;

class TypePresenter
{
    public function getNewsType(Model $model = null, $type, $isEditable = false)
    {
        $ret = '';

        $types = [
            [
                'text' => '推薦文章',
                'value' => 'article'
            ],
            [
                'text' => '最新消息',
                'value' => 'news'
            ],
            [
                'text' => '活動訊息',
                'value' => 'event'
            ],
        ];

        if ($type === 'label') {
            $filtered = collect($types)->filter(function($type) use($model){
                return $model->type === $type['value'];
            })->first();

            $ret = $filtered['text'] ?? 'UNKNOWN';
        }

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($types)->reduce(function($carry, $item) use ($model, $isEdit) {
                $isChecked = isset($model) && $item['value'] === $model->type 
                    ? 'checked' 
                    : '';
                
                #新增帳號，預設狀態為最新消息
                if (! isset($model) && empty($isChecked) && $item['value'] === 'news') {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="type" id="type_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}