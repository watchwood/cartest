<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\CarService;


class ApiController extends Controller
{
    public function carPrice(Request $request) {
		
		// Validation could be kicked off into a separate layer in Laravel, and it is often done in large projects.  The extra complexity isn't needed here.
		$request->validate([
			'price' => 'numeric|required|min:1',
			'type' => [Rule::in(["common", "luxury"])],
		]);

		// Having the actual logic in a separate service layer from the controller is a common & often preferred design pattern in Laravel
		return response()->json([
			'basic' => CarService::getBasicFee($request->price, $request->type),
			'special' => CarService::getSpecialFee($request->price, $request->type),
			'association' => CarService::getAssociationFee($request->price),
			'storage' => CarService::getStorageFee(),
			'total' => CarService::getTotal($request->price, $request->type),
		]);
	}
}
