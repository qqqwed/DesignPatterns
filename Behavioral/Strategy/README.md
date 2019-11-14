# 策略模式（Strategy）
# 意图
对象有某个行为，但是在 **不同的场景** 下，该行为有 **不同的实现算法**。

就好比你去餐馆吃饭，首页你要通过菜单来选择你想吃的菜，根据你点的菜的不同，在厨房中去做不同的菜。同样是菜但是根据不同的菜名，有不同的做法。
# 适用性
* 需要在不同的情况下使用不同的策略（算法），或者在未来可能还要使用新的策略
* 对客户隐藏具体策略（算法）的具体的实现，彼此完全独立

# 实现方式
1. 定义抽象策略类，通常由一个接口或抽象类实现。
2. 具体策略类，封装了具体的算法和行为。
3. 环境类，持有一个策略类的引用，最终给客户端调用。

# 缺点
1. 客户端 <span style="color:red;font-weight:bold">必须知道所有的策略类</span> ，并自行选择使用哪一个策略类。
2. 策略模式造成很多的策略类，每个具体策略类都会产生一个新类 【可使用「享元模式」来减少对象的数量】

# 代码示例
## 支付方式

这里以 <font style="color:#F39019">支付</font> 为例，
我们在购买商品时，经常会选择不同支付方式来付款，这就是一种策略。

### UML类图

![image-20191112223237186](https://tva1.sinaimg.cn/large/006y8mN6ly1g8vmomx8ajj30dw0eqglx.jpg)

### **抽象策略类**

 **PayStrategy.php**

```php
<?php
/**
 * Description: 支付策略 抽象接口类
 * Created by Martini
 * DateTime: 2019-07-02 13:39
 */

namespace DesignPatterns\Behavioral\Strategy;

interface PayStrategy
{
	/**
	 * 支付算法
	 * @return mixed
	 * @author Martini 2019-07-02 14:15
	 */
	public function payAlgorithm();
}
```

### **具体策略类 **

**Alipay.php**

```php
<?php
/**
 * Description:[具体策略类(ConcreteStrategy)] 支付宝支付类
 * Created by Martini
 * DateTime: 2019-07-02 13:42
 */

namespace DesignPatterns\Behavioral\Strategy;

class Alipay implements PayStrategy
{
	public function payAlgorithm()
	{
		return '使用支付宝支付相关支付算法';
	}
}
```

### **具体策略类 **

**Wechatpay.php**

```php
<?php
/**
 * Description: [具体策略类(ConcreteStrategy)] 微信支付类
 * Created by Martini
 * DateTime: 2019-07-02 13:44
 */

namespace DesignPatterns\Behavioral\Strategy;

class Wechatpay implements PayStrategy
{
	public function payAlgorithm()
	{
		return '使用微信支付相关支付算法';
	}
}
```

### **环境类 **

**PayUtils.php**

```php
<?php
/**
 * Description:[环境类(Context)] 支付实用工具类
 * 用一个ConcreteStrategy具体策略类对象来配置
 * 维护一个对Strategy策略对象的引用. 可以定义一个接口来让Strategy访问它的数据
 * Created by Martini
 * DateTime: 2019-07-02 13:49
 */

namespace DesignPatterns\Behavioral\Strategy;

class PayUtils
{
	private $_strategy = null;

	public function __construct(PayStrategy $pay)
	{
		$this->_strategy = $pay;
	}

	/**
	 * 更改支付策略
	 * @param PayStrategy $pay
	 *
	 * @author Martini 2019-07-02 14:01
	 */
	public function setPayStrategy(PayStrategy $pay)
	{
		$this->_strategy = $pay;
	}

	/**
	 * 支付
	 * @return mixed
	 * @author Martini 2019-07-02 14:02
	 */
	public function pay()
	{
		return $this->_strategy->payAlgorithm();
	}
}
```

### 测试

```php
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
```