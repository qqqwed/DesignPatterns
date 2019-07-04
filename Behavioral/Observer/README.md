# 观察者模式（Observer）

## 意图
定义对象间一对多的依赖关系，当对象的状态发生变化时，所有依赖于它的对象都得到通知并被自动更新。它使用的是低耦合的方式。

现在生活中离不开手机，每个人都有手机号，朋友联系你要用手机，你的银行卡也要绑定手机号等等。
那现在你换了一个手机号，朋友，银行都要知道你的手机号换了。这里就可以使用该模式。

## 适用性
* 当一个抽象模型有两个方面, 其中一个方面<font style="color:#296594;background-color:#cbe8f9;"> 依赖</font>于另一方面。将这二者封装在独立的对象中以使它们可以各自独立地改变和复用。
* 当对一个对象的改变需要同时<font style="color:#296594;background-color:#cbe8f9;"> 改变其它对象</font>, 而<font style="color:#296594;background-color:#cbe8f9;"> 不知道具体有多少对象</font>有待改变。
* <font style="color:#296594;background-color:#cbe8f9;"> 当一个对象必须通知其它对象，而它又不能假定其它对象是谁</font>。换言之，你不希望这些对象是紧密耦合的。
* 对象仅需要将自己的更新通知给其他对象而不需要知道其他对象的细节。

## 角色
>参与设计模式的成员都是一个角色

### 1.抽象主题（Subject）
- 它把所有 <font style="color:#296594;background-color:#cbe8f9;">观察者对象</font> 的引用保存在一个聚集里，每个主题都可以有任意数量的观察者。
- 抽象主题提供一个接口，可以 <span style="color:red">增加</span> 和  <span style="color:red">删除</span>  <font style="color:#296594;background-color:#cbe8f9;">观察者对象 </font>。

### 2.具体主题（Concrete Subject）
- 将有关 <span style="color:red">状态</span> 存入 <font style="color:#296594;background-color:#cbe8f9;">具体观察者对象</font>
- 在<font style="color:#296594;background-color:#cbe8f9;">具体主题</font> 内部状态改变时，给所有的登记过的 <font style="color:#296594;background-color:#cbe8f9;">观察者</font> 发出 <span style="color:red">通知</span>。

### 3.抽象观察者（Observer）
为所有的 <font style="color:#296594;background-color:#cbe8f9;">具体观察者</font> 定义一个接口，在得到主题通知时更新自己
### 4.具体观察者（Concrete Observer）
实现 <font style="color:#296594;background-color:#cbe8f9;">抽象观察者</font> 角色所要求的更新接口，以便使本身的状态与主题状态协调。

## 缺点
第一、如果一个被观察者对象有很多的直接和间接的观察者的话，将所有的观察者都通知到会花费很多时间。

第二、如果在被观察者之间有循环依赖的话，被观察者会触发它们之间进行循环调用，导致系统崩溃。在使用观察者模式是要特别注意这一点。

第三、如果对观察者的通知是通过另外的线程进行异步投递的话，系统必须保证投递是以自恰的方式进行的。

第四、虽然观察者模式可以随时使观察者知道所观察的对象发生了变化，但是观察者模式没有相应的机制使观察者知道所观察的对象是怎么发生变化的。

 
## 代码
下面我们通过一个模拟案例来演示 实现 Observer 设计模式上的威力。该案例模拟了一个网站的用户管理模块，该模块包括 3 个主要功能：

- 新增 1 个用户
- 把指定用户的密码变更为他所指定的新密码
- 在用户忘记密码时重置其密码

每当操作完其中一个功能后，都需要将密码告知用户。

除了传统的向用户发送 Email 这种手段外，

我们还需要向用户的手机发送短信，让他们更加方便地知道密码是什么。

假设我们的网站还有一套站内的消息系统，我们称之为小纸条，
在用户变更或重置密码后，向他们发送小纸条会令他们高兴的。

将密码告知用户的多种手段与用户密码的改变——无论是从无到有，用户主动变更，还是系统重置——形成了多对一的关系。

我们决定定义一个 User 类表示用户，实现需求中的 3 个功能。该类就是 Observer 设计模式中的目标（Subject）角色。我们还需要一组类，实现利用各种手段向用户发送新密码的功能，这些类就充当了 Observer 设计模式中的观察者（Observer）角色。
    
创建用户
* 发送Email
* 发送短消息

修改密码
* 发送Email
* 发送站内信

重置密码
* 发送Email
* 发送短消息
* 发送站内信

### 模拟案例的 UML 类图

![SPL_observer](/Users/martini/Documents/书房/SPL_observer.jpg)

尽管实际网站中的用户要有更多的属性，特别是通常需要用 ID 来标识每个用户，但是我们为了突出本文的主题，只保留了案例所需的属性。

其实，当目标所持有的状态（在本例中是用户的密码）更新时，如何通知观察者有两种方法。“拉”的方法和“推”的方法。SPL 使用的是“拉”的方法，观察者需要通过目标的引用（作为 update()方法的参数传入）来访问其属性。“拉”的方法需要让观察者更了解目标都拥有哪些属性，这增加了它们耦合度。而且主题也要对观察者门户大开，违背了封装性。解决的方法是在目标中提供一系列 getter 方法，如 getPassword()来让观察者获得用户的密码。

虽然“拉”的方法可能被认为更加正确，但是我们觉得让主题把用户的信息“推”过来更加方便。既然通过在重写 update()方法时加上第 2 个参数是行不通的，那么就从别的方向上着手。好在 PHP 在方法调用上有这样的特性，只要给定的参数（实参）不少于定义时指定的必选参数（没有默认值的参数），PHP 就不会报错。传入一个方法的参数个数，可以通过 func_num_args() 函数获取；多余的参数可以使用 func_get_arg()函数读取。注意该函数是从 0 开始计数的，即 0 表示第 1 个实参。利用这个小技巧，update()方法可以通过 func_get_arg(1)接收一个用户信息的数组，有了这个数组，就能知道邮件该发给谁，新密码是什么了

### 方式一：SPL 快速实现
使用 SPL 提供的 SplSubject和 SplObserver接口以及 SplObjectStorage类，快速实现 Observer 设计模式。

User.php    

```php
<?php
/**
 * Description: 具体主题（Concrete Subject）
 * Created by Martini
 * DateTime: 2019-07-04 10:49
 */

namespace DesignPatterns\Behavioral\Observer\DemoOne;


use SplObserver;

class User implements \SplSubject
{
	private $action;
	private $username;
	private $password;
	private $email;
	private $mobile;
	/**
	 * @var \SplObjectStorage
	 */
	private $observers;

	public function __construct($username, $password, $email, $mobile)
	{

		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->mobile = $mobile;

		$this->observers = new \SplObjectStorage();
	}

	public function attach(SplObserver $observer)
	{
		$this->observers->attach($observer);
	}

	public function detach(SplObserver $observer)
	{
		$this->observers->detach($observer);
	}

	public function notify()
	{
		$userInfo = [
			'action'  => $this->action,
			'username' => $this->username,
			'password' => $this->password,
			'email'    => $this->email,
			'mobile'   => $this->mobile
		];
		foreach ($this->observers as $observer) {
			$observer->update($this, $userInfo);
		}
	}


	public function create()
	{
		$this->action = __FUNCTION__;
		$this->notify();
	}

	public function changePassword($newPassword)
	{
		$this->action = __FUNCTION__;
		$this->password = $newPassword;
		$this->notify();
	}

	public function resetPassword()
	{
		$this->action = __FUNCTION__;
		$this->password = mt_rand(100000, 999999);
		$this->notify();
	}
}
```
为了节约篇幅，而且三个信息发送类非常相像，下面只给出其中一个的源代码，完整的源代码可以在 [Github]() 中得到。
EmailSender.php
```php
<?php
/**
 * Description: 具体观察者[Concrete Observer] 邮件发送类
 * Created by Martini
 * DateTime: 2019-07-04 13:58
 */

namespace DesignPatterns\Behavioral\Observer\DemoOne;



class EmailSender implements \SplObserver
{
	public $resultString;
	public function update(\SplSubject $subject)
	{
		if (func_num_args() === 2) {
			$userInfo = func_get_arg(1);
			$string = $userInfo['action'] . ": 向 {$userInfo['username']} 发送电子邮件成功";
			$this->resultString = $string;
		}
	}
}
```
测试

```php
<?php
/**
 * Description:观察者模式测试用例
 * 使用了 SPL 中的
 * @var \SplObserver
 * @var \SplSubject
 * 使用push的方式 主题直接将数据 推给 观察者
 * Created by Martini
 * DateTime: 2019-07-04 16:08
 */

namespace DesignPatterns\Behavioral\Observer\DemoOne\Tests;

use DesignPatterns\Behavioral\Observer\DemoOne\EmailSender;
use DesignPatterns\Behavioral\Observer\DemoOne\MobileSender;
use DesignPatterns\Behavioral\Observer\DemoOne\User;
use DesignPatterns\Behavioral\Observer\DemoOne\WebSender;
use PHPUnit\Framework\TestCase;

class ObserverDemoOneTest extends TestCase
{
	public function testObserver()
	{
		// 观察者们
		$emailSender = new EmailSender();
		$mobileSender = new MobileSender();
		$webSender = new WebSender();

		$user = new User('Martini', '123456', 'user1@domain.com', '15610002000');

		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		// 创建用户时,发送email和短信
		// 附加观察者
		$user->attach($emailSender);
		$user->attach($mobileSender);

		$user->create();


		$this->assertEquals('create: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('create: 向 Martini 发送短消息成功', $mobileSender->resultString);
		$this->assertEquals('', $webSender->resultString);

		// 用户忘记密码后重置密码，还需要通过站内小纸条通知用户
		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		$user->attach($webSender);
		$user->resetPassword();

		$this->assertEquals('resetPassword: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('resetPassword: 向 Martini 发送短消息成功', $mobileSender->resultString);
		$this->assertEquals('resetPassword: 向 Martini 发送站内信成功', $webSender->resultString);

		// 用户变更了密码，但是不要给他的手机发短信
		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		$user->detach($mobileSender);
		$user->changePassword('452213');
		$this->assertEquals('changePassword: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('changePassword: 向 Martini 发送站内信成功', $webSender->resultString);
		$this->assertEquals('', $mobileSender->resultString);
	}
}
```

### 方式二、常规方式 实现
ISubject.php
```php
<?php
/**
 * Description: 主题接口
 * Created by Martini
 * DateTime: 2019-07-04 20:43
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo;


interface ISubject
{
	/**
	 * 附加观察者
	 * @param IObserver $observer
	 *
	 * @return mixed
	 * @author Martini 2019-07-04 23:23
	 */
	public function attach(IObserver $observer);

	/**
	 * 解除观察者
	 * @param IObserver $observer
	 *
	 * @return mixed
	 * @author Martini 2019-07-04 23:23\
	 */
	public function detach(IObserver $observer);

	/**
	 * 通知观察者
	 * @return mixed
	 * @author Martini 2019-07-04 20:46
	 */
	public function notify();
}
```
IObserver.php
```php
<?php
/**
 * Description: 观察者接口
 * Created by Martini
 * DateTime: 2019-07-04 20:51
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo;


interface IObserver
{
	public function update(ISubject $subject);
}
```
User.php
```php
<?php
/**
 * Description: 具体主题类
 * Created by Martini
 * DateTime: 2019-07-04 20:47
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo;


class User implements ISubject
{
	private $observers = [];
	private $userInfo = [];

	public function __construct($username, $password, $email, $mobile)
	{
		$this->userInfo = [
			'username' => $username,
			'password' => $password,
			'email'    => $email,
			'mobile'   => $mobile
		];
	}

	public function attach(IObserver $observer)
	{
		if (!in_array($observer, $this->observers, true)) {
			$this->observers[] = $observer;
		}
	}

	public function detach(IObserver $observer)
	{
		foreach ($this->observers as $k => $v) {
			if ($v === $observer) {
				unset($this->observers[$k]);
			}
		}
	}

	public function notify()
	{
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}
	}

	public function getUserInfo()
	{
		return $this->userInfo;
	}

	public function create()
	{
		$this->userInfo['action'] = __FUNCTION__;
		$this->notify();
	}

	public function changePassword($newPassword)
	{
		$this->userInfo['action'] = __FUNCTION__;
		$this->userInfo['password'] = $newPassword;
		$this->notify();
	}

	public function resetPassword()
	{
		$this->userInfo['action'] = __FUNCTION__;
		$this->userInfo['password'] = mt_rand(100000, 999999);
		$this->notify();
	}
}
```
EmailSender.php
```php
<?php
/**
 * Description:具体观察者 邮件发送类
 * Created by Martini
 * DateTime: 2019-07-04 23:12
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo;


class EmailSender implements IObserver
{
	public $resultString;

	public function update(ISubject $subject)
	{
		$string = $subject->getUserInfo()['action'] . ": 向 {$subject->getUserInfo()['username']} 发送电子邮件成功";
		$this->resultString = $string;
	}
}
```
测试
```php
<?php
/**
 * Description: 观察者模式测试用例
 * 使用pull的方式去 向主题获取数据 (即getter)
 * Created by Martini
 * DateTime: 2019-07-04 23:41
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo\Tests;


use DesignPatterns\Behavioral\Observer\DemoTwo\EmailSender;
use DesignPatterns\Behavioral\Observer\DemoTwo\MobileSender;
use DesignPatterns\Behavioral\Observer\DemoTwo\User;
use DesignPatterns\Behavioral\Observer\DemoTwo\WebSender;
use PHPUnit\Framework\TestCase;

class ObserverDemoTwoTest extends TestCase
{
	public function testObserver()
	{
		$user = new User('Martini', '123456', 'user1@domain.com', '15610002000');
		// 观察者们
		$emailSender = new EmailSender();
		$mobileSender = new MobileSender();
		$webSender = new WebSender();


		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		// 创建用户时,发送email和短信
		// 附加观察者
		$user->attach($emailSender);
		$user->attach($mobileSender);

		$user->create();


		$this->assertEquals('create: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('create: 向 Martini 发送短消息成功', $mobileSender->resultString);
		$this->assertEquals('', $webSender->resultString);

		// 用户忘记密码后重置密码，还需要通过站内小纸条通知用户
		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		$user->attach($webSender);
		$user->resetPassword();

		$this->assertEquals('resetPassword: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('resetPassword: 向 Martini 发送短消息成功', $mobileSender->resultString);
		$this->assertEquals('resetPassword: 向 Martini 发送站内信成功', $webSender->resultString);

		// 用户变更了密码，但是不要给他的手机发短信
		//初始化
		$emailSender->resultString = $mobileSender->resultString = $webSender->resultString = null;

		$user->detach($mobileSender);
		$user->changePassword('452213');
		$this->assertEquals('changePassword: 向 Martini 发送电子邮件成功', $emailSender->resultString);
		$this->assertEquals('changePassword: 向 Martini 发送站内信成功', $webSender->resultString);
		$this->assertEquals('', $mobileSender->resultString);
	}
}
```