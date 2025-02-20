<?php

namespace App\Services;

use Exception;

// I know there's a bunch of fancy syntax toys in the newer PHP versions, but the project is so small that the complexity isn't *really* needed
class CarService 
{
	// Don't need to think about extra types here since those are validated in the Controller before the runtime gets this far
    public static function getBasicFee($price, $type) {
		if ($type=="common"){
			return round(max(10, min(50, $price/10)), 2);
		}
		else if ($type=="luxury"){
			return round(max(25, min(200, $price/10)), 2);
		}
	}

    public static function getSpecialFee($price, $type) {
		if ($type=="common"){
			return round($price*.02, 2);
		}
		else if ($type=="luxury"){
			return round($price*.04, 2);
		}
	}

    public static function getAssociationFee($price) {
		if ($price <= 500){
			return 5;
		}
		else if ($price <= 1000){
			return 10;
		}
		else if ($price <= 3000){
			return 15;
		}
		else {
			return 20;
		}
	}

	// Why a function instead of a constant or variable?  Less refactoring if the value becomes dynamic in the future
    public static function getStorageFee() {
		return 100;
	}
	
    public static function getTotal($price, $type) {
		return $price
			+ static::getBasicFee($price, $type)
			+ static::getSpecialFee($price, $type)
			+ static::getAssociationFee($price)
			+ static::getStorageFee();
	}
}
