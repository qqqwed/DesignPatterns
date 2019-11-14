<?php
/**
 * Description: 测试支付
 * Created by Martini
 * DateTime: 2019-11-14 21:48
 */

namespace DesignPatterns\Creational\FactoryMethod\Tests;


use DesignPatterns\Creational\FactoryMethod\DemoOne\AliPayFactory;
use DesignPatterns\Creational\FactoryMethod\DemoOne\WechatPayFactory;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testAliPay()
    {
        $payFactory = new AliPayFactory();
        $pay = $payFactory->driver();
        $actual = $pay->pay(20);
        $actual2 = $pay->refund(10);

        $this->assertEquals('AliPay付款20元', $actual);
        $this->assertEquals('AliPay退款10元', $actual2);
    }

    public function testWechatPay()
    {
        $payFactory = new WechatPayFactory();
        $pay = $payFactory->driver();
        $actual = $pay->pay(20);
        $actual2 = $pay->refund(10);

        $this->assertEquals('WechatPay付款20元', $actual);
        $this->assertEquals('WechatPay退款10元', $actual2);
    }

}