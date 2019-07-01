<?php
/**
 * Description:
 * Created by Martini
 * DateTime: 2019-06-28 22:46
 */

namespace DesignPatterns\Creational\SimpleFactory;


class OperationMul
{
	public function getResult($number1, $number2)
	{
		return intval($number1 * $number2);
	}
}