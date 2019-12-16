<?php

namespace app\Presenters\Order;

use App\Models\Order;

class UserDetailPresenter
{
    public function getUserDetail(Order $order, $type, $isEditable = false)
    {
        $ret = '';

        $applied = [
            [
                'text' => '另填收件資訊',
                'value' => 0
            ],
            [
                'text' => '使用帳號資訊',
                'value' => 1
            ],
        ];

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($applied)->reduce(function($carry, $item) use ($order, $isEdit) {
                if (old('is_user_detail_used') != null) {
                    $isChecked = isset($order) && (bool)$item['value'] === (bool)old('is_user_detail_used')
                        ? 'checked' 
                        : '';
                } else {
                    $isChecked = isset($order) && (bool)$item['value'] === (bool)$order->is_user_detail_used 
                        ? 'checked' 
                        : '';
                }
                
                #新增帳號，預設狀態為有效
                if (! isset($order) && empty($isChecked) && (bool)$item['value'] === true) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio-inline" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="is_user_detail_used" id="is_user_detail_used_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}