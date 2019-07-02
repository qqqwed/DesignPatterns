<?php
/**
 * Description:
 * Created by Martini
 * DateTime: 2019-07-02 10:43
 */

namespace DesignPatterns\Creational\SimpleFactory\Tests;


use DesignPatterns\Creational\SimpleFactory\Alipay;
use DesignPatterns\Creational\SimpleFactory\PayFactory;
use DesignPatterns\Creational\SimpleFactory\WechatPay;
use \PHPUnit\Framework\TestCase;

class PayFactoryTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 * @param string $type 支付平台
	 * @param object $obj
	 * @param string $expected
	 *
	 * @author Martini 2019-07-02 11:25
	 */
	public function testDriver($type, $obj, $expected)
	{
		$pay = (new PayFactory())->driver($type);
		$actual = $pay->pay();

		$this->assertInstanceOf($obj, $pay);
		$this->assertEquals($expected, $actual);
	}

	public function dataProvider()
	{
		return [
			['alipay', Alipay::class, '使用Alipay付款'],
			['wechat', WechatPay::class, '使用Wechat付款'],
		];
	}

}
