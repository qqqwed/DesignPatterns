<?php
/**
 * Description:
 * Created by Martini
 * DateTime: 2019-11-14 11:32
 */

namespace DesignPatterns\Creational\FactoryMethod\DemoOne;


class WechatPay implements IPay
{
    public function pay($money)
    {
        return "WechatPay付款{$money}元";
    }

    public function refund($money)
    {
        return "WechatPay退款{$money}元";
    }
}