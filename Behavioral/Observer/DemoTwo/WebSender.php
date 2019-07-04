<?php
/**
 * Description:具体观察者 站内信发送类
 * Created by Martini
 * DateTime: 2019-07-04 23:13
 */

namespace DesignPatterns\Behavioral\Observer\DemoTwo;


class WebSender implements IObserver
{
	public $resultString;

	public function update(ISubject $subject)
	{
		$string = $subject->getUserInfo()['action'] . ": 向 {$subject->getUserInfo()['username']} 发送站内信成功";
		$this->resultString = $string;
	}
}