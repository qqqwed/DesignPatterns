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