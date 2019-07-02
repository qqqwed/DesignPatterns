<?php
/**
 * Description: 支付宝支付
 * Created by Martini
 * DateTime: 2019-07-02 10:30
 */

namespace DesignPatterns\Creational\SimpleFactory;


class Alipay
{
	public function pay()
	{
		return "使用Alipay付款";
	}
}