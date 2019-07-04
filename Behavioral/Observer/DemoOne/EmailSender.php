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