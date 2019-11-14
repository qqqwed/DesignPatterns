<?php
/**
 * Description:
 * Created by Martini
 * DateTime: 2019-11-14 11:34
 */

namespace DesignPatterns\Creational\FactoryMethod\DemoOne;


class WechatPayFactory implements IFactory
{
    public function driver()
    {
        return new WechatPay();
    }
}