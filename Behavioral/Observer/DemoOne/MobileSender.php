<?php
/**
 * Description: 具体观察者[Concrete Observer] 短消息发送
 * Created by Martini
 * DateTime: 2019-07-04 16:01
 */

namespace DesignPatterns\Behavioral\Observer\DemoOne;


class MobileSender implements \SplObserver
{
	public $resultString;
	public function update(\SplSubject $subject)
	{
		if (func_num_args() === 2) {
			$userInfo = func_get_arg(1);
			$string =  $userInfo['action'] . ": 向 {$userInfo['username']} 发送短消息成功";
			$this->resultString = $string;
		}
	}
}