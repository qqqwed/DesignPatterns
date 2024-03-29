# 简单工厂模式（Simple Factory）
# 意图
可以根据参数的不同返回不同类的实例。
# 适用性
* 工厂类负责创建的对象比较少
* 客户端只知道传入工厂类的参数，对于如何创建对象不关心：客户端既不需要关心创建细节，甚至连类名都不需要记住，只需要知道类型所对应的参数。

# 实现方式
1. 定义一个工厂类来负责创建其他类的实例。被创建的实例通常都具有共同的父类或者有一些相同的特性。
2. 实现各个具体的类。

# 缺点
简单工厂模式最大的问题在于<span style="color:red;font-weight:bold">工厂类的职责相对过重</span>，增加新的产品需要修改工厂类的判断逻辑，这一点<span style="color:red;font-weight:bold">与开闭原则是相违背的</span>。

# 代码示例

## 支付方式

* 以 <span style="color:#F39019">支付方式</span> 为例
>你只要在用户端选择支付方式,就能使用相应支付平台的支付

**PayFactory.php**

```php
<?php
/**
 * Description:支付工厂类
 * Created by Martini
 * DateTime: 2019-07-02 10:13
 */

namespace DesignPatterns\Creational\SimpleFactory;


class PayFactory
{
	public $pay;

	/**
	 * 根据支付支付平台实例化对象
	 * @param $type
	 *
	 * @return Alipay|WechatPay
	 * @author Martini 2019-07-02 10:37
	 */
	public function driver($type)
	{
		switch ($type) {
			case 'alipay':
				$this->pay = new Alipay();
				break;
			case 'wechat':
				$this->pay = new WechatPay();
				break;
		}
		return $this->pay;
	}
}

```
**Alipay.php**

```php
<?php
/**
 * Description: 支付宝支付
 * Created by Martini
 * DateTime: 2019-07-02 10:30
 */

namespace DesignPatterns\Creational\SimpleFactory;


class Alipay
{
	public function pay()
	{
		return "使用Alipay付款";
	}
}
```

**WechatPay.php**

```php
<?php
/**
 * Description:微信支付
 * Created by Martini
 * DateTime: 2019-07-02 10:31
 */

namespace DesignPatterns\Creational\SimpleFactory;


class WechatPay
{
	public function pay()
	{
		return "使用Wechat付款";
	}
}
```
### **测试**

```php
<?php
/**
 * Description:支付工厂类测试用例
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

```

## 计算器


* 以 <span style="color:orange">计算器</span> 为例
>你只需要输入"+-x/"符号，就能进入相应的计算模式，然后你输入数据就能得到结果，你并不需要关心它是怎么做到的。

**OperationFactory.php**

```php
<?php
/**
 * Description: 简单工厂类
 * Created by Martini
 * DateTime: 2019-06-28 22:42
 */

namespace DesignPatterns\Creational\SimpleFactory;

class OperationFactory
{
	/**
	 * 操作工厂类
	 * @param $operate
	 *
	 * @return OperationAdd|OperationDiv|OperationMul|OperationSub|null
	 * @author Martini 2019-06-30 19:58
	 */
	public static function createOperate($operate)
	{
        $obj = null;
        switch ($operate){
            case "+":
				$obj = new OperationAdd();
                break;
            case "-":
				$obj = new OperationSub();
                break;
            case "*":
				$obj = new OperationMul();
                break;
            case "/":
				$obj = new OperationDiv();
                break;
		}
		return $obj;
	}
}
```
**OperationAdd.php**

```php
<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationAdd
{
	public function getResult($number1, $number2)
	{
		return intval($number1 + $number2);
	}
}
```
OperationSub.php
```php
<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationSub
{
	public function getResult($number1, $number2)
	{
		return intval($number1 - $number2);
	}
}
```
**OperationMul.php**

```php
<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationMul
{
	public function getResult($number1, $number2)
	{
		return intval($number1 * $number2);
	}
}
```

**OperationDiv.php**

```php
<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationDiv
{
	public function getResult($number1, $number2)
	{
		return intval($number1 / $number2);
	}
}
```

### 用法
```php
$operate = OperationFactory::createOperate('+');
$operate->getResult(1,2);
```
### 测试
```php
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

```
