<?php
/**
 * Description:[环境类(Context)] 支付实用工具类
 * 用一个ConcreteStrategy具体策略类对象来配置
 * 维护一个对Strategy策略对象的引用. 可以定义一个接口来让Strategy访问它的数据
 * Created by Martini
 * DateTime: 2019-07-02 13:49
 */

namespace DesignPatterns\Behavioral\Strategy;


class PayUtils
{
	private $_strategy = null;

	public function __construct(PayStrategy $pay)
	{
		$this->_strategy = $pay;
	}

	/**
	 * 更改支付策略
	 * @param PayStrategy $pay
	 *
	 * @author Martini 2019-07-02 14:01
	 */
	public function setPayStrategy(PayStrategy $pay)
	{
		$this->_strategy = $pay;
	}

	/**
	 * 支付
	 * @return mixed
	 * @author Martini 2019-07-02 14:02
	 */
	public function pay()
	{
		return $this->_strategy->payAlgorithm();
	}
}