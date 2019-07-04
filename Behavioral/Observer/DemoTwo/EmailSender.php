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