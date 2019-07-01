<?php
/**
 * Description:简单工厂测试类
 * Created by Martini
 * DateTime: 2019-06-29 10:49
 */

namespace DesignPatterns\Creational\SimpleFactory\Tests;


use DesignPatterns\Creational\SimpleFactory\OperationAdd;
use DesignPatterns\Creational\SimpleFactory\OperationDiv;
use DesignPatterns\Creational\SimpleFactory\OperationFactory;
use DesignPatterns\Creational\SimpleFactory\OperationMul;
use DesignPatterns\Creational\SimpleFactory\OperationSub;
use PHPUnit\Framework\TestCase;

class SimpleFactoryTest extends TestCase
{
	/**
	 * 计算器类测试方法
	 * @dataProvider OperateProvider
	 * @param string $oper 操作方式
	 * @param float $a 数据1
	 * @param float $b 数据2
	 * @param int $expected 期待的计算结果
	 * @param object $obj 创建的对象
	 *
	 * @author Martini 2019-06-30 22:21
	 */
	public function testOperation($oper, $a, $b, $expected, $obj)
	{
		$operate = OperationFactory::createOperate($oper);

		$this->assertInstanceOf($obj, $operate);
		$this->assertEquals($expected, $operate->getResult($a, $b));
	}

	public function OperateProvider()
	{
		return [
			['+', 12, 3, 15, OperationAdd::class],
			['-', 12, 3, 9, OperationSub::class],
			['*', 12, 3, 36, OperationMul::class],
			['/', 12, 3, 4, OperationDiv::class],
		];
	}

}
