<?php
/**
 * Description:[具体策略类(ConcreteStrategy)] 支付宝支付类
 * Created by Martini
 * DateTime: 2019-07-02 13:42
 */

namespace DesignPatterns\Behavioral\Strategy;


class Alipay implements PayStrategy
{
	public function payAlgorithm()
	{
		return '使用支付宝支付相关支付算法';
	}
}