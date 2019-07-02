<?php
/**
 * Description: 策略模式测试 支付策略测试用例
 * Created by Martini
 * DateTime: 2019-07-02 14:07
 */

namespace DesignPatterns\Behavioral\Strategy\Tests;


use DesignPatterns\Behavioral\Strategy\Alipay;
use DesignPatterns\Behavioral\Strategy\PayUtils;
use DesignPatterns\Behavioral\Strategy\Wechatpay;
use PHPUnit\Framework\TestCase;

class StrategyTest extends TestCase
{
	public function testPay()
	{
		// 使用支付宝支付
		$pay = new PayUtils(new Alipay());
		$this->assertEquals('使用支付宝支付相关支付算法', $pay->pay());

		//切换为使用微信支付
		$pay->setPayStrategy(new Wechatpay());
		$this->assertEquals('使用微信支付相关支付算法', $pay->pay());
	}
}