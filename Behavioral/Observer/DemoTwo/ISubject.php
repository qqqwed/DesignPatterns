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