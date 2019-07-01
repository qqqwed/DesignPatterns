<?php

namespace DesignPatterns\Creational\SimpleFactory;


class OperationDiv
{
	public function getResult($number1, $number2)
	{
		return intval($number1 / $number2);
	}
}