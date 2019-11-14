<?php
/**
 * Description:支付
 * Created by Martini
 * DateTime: 2019-11-14 11:30
 */

namespace DesignPatterns\Creational\FactoryMethod\DemoOne;


interface IPay
{
    public function pay($money);
    public function refund($money);
}