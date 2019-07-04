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