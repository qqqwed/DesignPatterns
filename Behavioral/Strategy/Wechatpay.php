<?php
/**
 * Description: [具体策略类(ConcreteStrategy)] 微信支付类
 * Created by Martini
 * DateTime: 2019-07-02 13:44
 */

namespace DesignPatterns\Behavioral\Strategy;


class Wechatpay implements PayStrategy
{
	public function payAlgorithm()
	{
		return '使用微信支付相关支付算法';
	}
}