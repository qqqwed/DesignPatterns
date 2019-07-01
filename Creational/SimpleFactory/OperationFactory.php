<?php
/**
 * Description: 简单工厂类
 * Created by Martini
 * DateTime: 2019-06-28 22:42
 */

namespace DesignPatterns\Creational\SimpleFactory;

class OperationFactory
{
	/**
	 * 创建操作对象
	 * @param $operate
	 *
	 * @return OperationAdd|OperationDiv|OperationMul|OperationSub|null
	 * @author Martini 2019-06-30 19:58
	 */
	public static function createOperate($operate) // Product 抽象产品
	{
        $obj = null;
        switch ($operate){
            case "+":
				$obj = new OperationAdd();
                break;
            case "-":
				$obj = new OperationSub();
                break;
            case "*":
				$obj = new OperationMul();
                break;
            case "/":
				$obj = new OperationDiv();
                break;
		}
		return $obj;
	}
}