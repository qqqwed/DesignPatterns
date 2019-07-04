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