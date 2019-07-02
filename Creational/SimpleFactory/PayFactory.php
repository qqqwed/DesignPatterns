<?php
/**
 * Description:支付工厂类
 * Created by Martini
 * DateTime: 2019-07-02 10:13
 */

namespace DesignPatterns\Creational\SimpleFactory;


class PayFactory
{
	public $pay;

	/**
	 * 根据支付支付平台实例化对象
	 * @param $type
	 *
	 * @return Alipay|WechatPay
	 * @author Martini 2019-07-02 10:37
	 */
	public function driver($type)
	{
		switch ($type) {
			case 'alipay':
				$this->pay = new Alipay();
				break;
			case 'wechat':
				$this->pay = new WechatPay();
				break;
		}
		return $this->pay;
	}
}