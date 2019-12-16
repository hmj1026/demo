<?php

namespace app\Presenters\Order;

use App\Models\Order;

class ShippedPresenter
{
    public function getShippedStatus(Order $order, $type, $isEditable = false)
    {
        $ret = '';

        $applied = [
            [
                'text' => '未寄送',
                'value' => 0
            ],
            [
                'text' => '已寄送',
                'value' => 1
            ],
        ];

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($applied)->reduce(function($carry, $item) use ($order, $isEdit) {
                $isChecked = isset($order) && (bool)$item['value'] === (bool)$order->is_shipped 
                    ? 'checked' 
                    : '';
                
                #新增帳號，預設狀態為有效
                if (! isset($order) && empty($isChecked) && (bool)$item['value'] === true) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio-inline" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="is_shipped" id="is_shipped_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}