<?php namespace App\Http\Controllers;

use Adminlte3\Cart;
use Adminlte3\Models\Order;
use Adminlte3\Models\Product;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller {

	public function getIndex() {
//        Cart::purge();
//        exit();
		$items = Cart::all();

        $bread[] = [
            'url'  => route('cart'),
            'name' => 'Корзина'
        ];

        SEOMeta::setTitle('Корзина');
        SEOMeta::setDescription('Корзина');

        return view('cart.index', [
			'items' => $items,
            'sum' => Cart::sum(),
            'bread' => $bread,
		]);
	}

    public function getCartCheckout() {
        $items = Cart::all();

        return view('cart.checkout', [
            'items' => $items,
            'total' => Cart::sum(),
        ]);
    }



    protected function formatValidationErrors(Validator $validator): array
    {
		$msg = $validator->errors()->all('<p>:message</p>');

		return ['error' => true, 'msg' => implode('', $msg)];
	}
}
