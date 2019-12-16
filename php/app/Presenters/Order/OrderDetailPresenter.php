<?php

namespace app\Presenters\Order;

use App\Models\Order;

class OrderDetailPresenter
{
    public function getOrderDetail(Order $order, $type, $isEditable = false)
    {
        $ret = '';

        $applied = [
            [
                'text' => '另填收件地址',
                'value' => 0
            ],
            [
                'text' => '使用帳單地址',
                'value' => 1
            ],
        ];

        if ($type === 'radio') {
            $isEdit = $isEditable === false ? 'disabled' : '';
            $ret = collect($applied)->reduce(function($carry, $item) use ($order, $isEdit) {
                if (old('is_billing_address_used') != null) {
                    $isChecked = isset($order) && (bool)$item['value'] === (bool)old('is_billing_address_used')
                        ? 'checked' 
                        : '';
                } else {
                    $isChecked = isset($order) && (bool)$item['value'] === (bool)$order->is_billing_address_used 
                        ? 'checked' 
                        : '';
                }

                #新增帳號，預設狀態為有效
                if (! isset($order) && empty($isChecked) && (bool)$item['value'] === true) {
                    $isChecked = 'checked';
                }

                $carry .= '<div class="radio-inline" '.$isEdit.'><label>';
                $carry .= '<input type="radio" name="is_billing_address_used" id="is_billing_address_used_'.$item['value'].'" value="'.$item['value'].'" '.$isChecked.' '.$isEdit.' />';
                $carry .= $item['text'];
                $carry .= '</label></div>';

                return $carry;
            }, '');
        }

        return $ret;
    }
}