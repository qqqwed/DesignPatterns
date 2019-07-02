<?php
/**
 * Description: 支付策略 抽象接口类
 * Created by Martini
 * DateTime: 2019-07-02 13:39
 */

namespace DesignPatterns\Behavioral\Strategy;


interface PayStrategy
{
	/**
	 * 支付算法
	 * @return mixed
	 * @author Martini 2019-07-02 14:15
	 */
	public function payAlgorithm();
}