# 工厂方法模式（Factory Method）

# 意图

定义一个用于创建对象的接口，让 <span style="color:#51A7F9;font-weight:bold">子类</span> 决定将哪一个类实例化。<span style="color:#fe6d2e;font-weight:bold">工厂方法模式</span> 使一个类的实例化 <font style="color:red;font-weight:bold">延迟</font> 到其 <span style="color:#51A7F9;font-weight:bold">子类</span>。

# 适用性

- 当一个类希望由它的 <span style="color:#51A7F9;font-weight:bold">子类</span> 来 <span style="color:#51A7F9;font-weight:bold">指定</span>  它所创建的 <span style="color:#51A7F9;font-weight:bold">对象</span> 的时候。
- 当类将创建对象的职责委托给多个帮助子类中的某一个，并且你希望将哪一个帮助子类是代理者这一信息局部化的时候。

<span style="color:#fe6d2e;font-weight:bold">工厂方法模式</span> 是 <span style="color:#fe6d2e;font-weight:bold">简单工厂模式</span> 的衍生，解决了许多 <span style="color:#fe6d2e;font-weight:bold">简单工厂模式</span> 的问题。首先完全实现『**开－闭原则**』，实现了可扩展。其次更复杂的层次结构，可以应用于产品结果复杂的场合。

我们先回顾下 <span style="color:#fe6d2e;font-weight:bold">简单工厂模式</span> 实现的方式

```php
class PayFactory
{
	public function driver($type)
	{
		switch ($type) {
			case 'alipay':
				$pay = new Alipay();
				break;
			case 'wechat':
				$pay = new WechatPay();
				break;
		}
		return $pay;
	}
}

class Alipay
{
	public function pay()
	{
		return "使用Alipay付款";
	}
}

class WechatPay
{
	public function pay()
	{
		return "使用Wechat付款";
	}
}

// 客户端代码
$pay = (new PayFactory())->driver($type);
$actual = $pay->pay();
```



接下来我们换成 <span style="color:#fe6d2e;font-weight:bold">工厂方法模式</span>。

还是以支付方式为例，有多个支付方式，每种支付方式都有很多接口。

# 结构

![image-20191114233126911](/Users/martini/Library/Application%20Support/typora-user-images/image-20191114233126911.png)

# 角色

- **Product** （IPay）

    定义工厂方法所创建的对象的接口（定义支付方式的接口）。

- **ConcreteProduct** （AliPay、WechatPay）

    实现 Product 接口（实现支付接口的具体支付类）。

- **Creator**（IFactory）

    工厂类，申明一个工厂方法，该方法返回一个 Product 类型的对象。

    Creator 也可以定义个工厂方法的默认实现，返回一个默认的 ConcreteProduct 对象。

- **ConcreteCreator**（AliPayFactory、WechatPayFactory）

    重定义工厂方法以返回一个 ConcreteProduct 对象。

# 代码示例

## UML类图

![image-20191114223257561](/Users/martini/Library/Application%20Support/typora-user-images/image-20191114223257561.png)

## 代码

***IPay***

```php
<?php
namespace DesignPatterns\Creational\FactoryMethod\DemoOne;

interface IPay
{
    public function pay($money);
    public function refund($money);
}
```

***AliPay***

```php
<?php
namespace DesignPatterns\Creational\FactoryMethod\DemoOne;

class AliPay implements IPay
{
    public function pay($money)
    {
        return "AliPay付款{$money}元";
    }

    public function refund($money)
    {
        return "AliPay退款{$money}元";
    }
}
```

***WechatPay***

```php
<?php
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
```

***IFactory***

```php
<?php
namespace DesignPatterns\Creational\FactoryMethod\DemoOne;

interface IFactory
{
    public function driver();
}
```

***AliPayFactory***

```php
<?php
namespace DesignPatterns\Creational\FactoryMethod\DemoOne;

class AliPayFactory implements IFactory
{
    public function driver()
    {
        return new AliPay();
    }
}
```

***WechatPayFactory***

```php
<?php
namespace DesignPatterns\Creational\FactoryMethod\DemoOne;

class WechatPayFactory implements IFactory
{
    public function driver()
    {
        return new WechatPay();
    }
}
```

## 测试

***Tests\FactoryMethodTest***

```php
<?php
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
```



通过对比可以得到：

***工厂方法模式***，定义一个创建对象的接口，让子类确定实例化哪一个类。工厂方法使一个类的实例化延迟到其子类。

***简单工厂模式*** 的最大优点在于工厂类中包含了必要的逻辑判断，根据用户端的选择条件动态实例化相关的类，对于客户端来说，去除了与具体产品的依赖。

***工厂方法模式*** 实现时，客户端需要决定实例化哪一个工厂来实现支付类，选择判断的问题还是存在的，也就是说，工厂方法把简单工厂的内部逻辑判断移到了客户端代码来进行。你想要加功能，本来是改工厂类的，而现在是修改客户端。

# 缺点



# 参考资料

[《大话设计模式》php 版本](https://github.com/flyingalex/design-patterns-by-php)

[设计模式 : 可复用面向对象软件的基础](https://book.douban.com/subject/1052241/)

[图解设计模式](https://book.douban.com/subject/26933281)