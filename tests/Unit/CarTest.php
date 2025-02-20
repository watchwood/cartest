<?php

namespace Tests\Unit;
use App\Services\CarService;

use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    // In a production environment I could add more tests
    public function test_basic_fee(): void
    {
		$this->assertEquals(10, CarService::getBasicFee(50, "common"));
		$this->assertEquals(25, CarService::getBasicFee(250, "common"));
		$this->assertEquals(50, CarService::getBasicFee(1000, "common"));
		$this->assertEquals(25, CarService::getBasicFee(50, "luxury"));
		$this->assertEquals(50, CarService::getBasicFee(500, "luxury"));
		$this->assertEquals(200, CarService::getBasicFee(10000, "luxury"));
    }

    public function test_special_fee(): void
    {
		$this->assertEquals(20, CarService::getSpecialFee(1000, "common"));
		$this->assertEquals(40, CarService::getSpecialFee(1000, "luxury"));
    }

    public function test_association_fee(): void
    {
		$this->assertEquals(5, CarService::getAssociationFee(20));
		$this->assertEquals(5, CarService::getAssociationFee(500));
		$this->assertEquals(10, CarService::getAssociationFee(501));
		$this->assertEquals(10, CarService::getAssociationFee(1000));
		$this->assertEquals(15, CarService::getAssociationFee(1001));
		$this->assertEquals(15, CarService::getAssociationFee(3000));
		$this->assertEquals(20, CarService::getAssociationFee(3001));
    }

    public function test_storage_fee(): void
    {
		$this->assertEquals(100, CarService::getStorageFee());
    }

	
    public function test_totals(): void
    {
		$this->assertEquals(550.76, CarService::getTotal(398, "common"));
		$this->assertEquals(671.02, CarService::getTotal(501, "common"));
		$this->assertEquals(173.14, CarService::getTotal(57, "common"));
		$this->assertEquals(2167, CarService::getTotal(1800, "luxury"));
		$this->assertEquals(1287, CarService::getTotal(1100, "common"));
		$this->assertEquals(1040320, CarService::getTotal(1000000, "luxury"));
    }
}
