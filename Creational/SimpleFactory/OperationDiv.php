<?php
/**
 * Description:
 * Created by Martini
 * DateTime: 2019-06-28 22:47
 */

namespace DesignPatterns\Creational\SimpleFactory;


class OperationDiv
{
	public function getResult($number1, $number2)
	{
		return intval($number1 / $number2);
	}
}