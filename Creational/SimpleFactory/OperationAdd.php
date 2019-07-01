<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationAdd
{
	public function getResult($number1, $number2)
	{
		return intval($number1 + $number2);
	}
}