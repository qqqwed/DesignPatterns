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