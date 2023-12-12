<?php

namespace App\Http\Controllers;

use Adminlte3\Cart;
use Adminlte3\Models\Order;
use Adminlte3\Models\ParentCatalogFilter;
use Adminlte3\Models\Product;
use Adminlte3\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    //РАБОТА С КОРЗИНОЙ
    public function postCartAdd(Request $request): array
    {
        $id = $request->get('id');
        $qnt = $request->get('qnt');

        $product = Product::find($id);
        if ($product) {
            $product_item['id'] = $product->id;
            $product_item['name'] = $product->name;
            $product_item['qnt'] = $qnt;
            $product_item['price'] = $product->price;
            $product_item['url'] = $product->url;

            $image = $product->images()->first();
            if ($image) {
                $product_item['image'] = $image->thumb(1, $product->catalog->alias);
            } else {
                $product_item['image'] = ProductImage::NO_IMAGE;
            }

            Cart::add($product_item);
        }
        $header_cart = view('blocks.header_cart', ['cart_items' => Cart::all()])->render();
//        $btn = view('catalog.product_add_to_cart_btn', ['id' => $product->id])->render();

        return [
            'success' => true,
            'header_cart' => $header_cart,
        ];
    }

    public function postEditCartProduct(Request $request): array
    {
        $id = $request->get('id');
        $count = $request->get('count');
        /** @var Product $product */
        $product = Product::find($id);
        if ($product) {
            $product_item['image'] = $product->showAnyImage();
            $product_item = $product->toArray();
            $product_item['count'] = $count;
            $product_item['url'] = $product->url;

            Cart::add($product_item);
        }

        $popup = view('blocks.cart_popup', $product_item)->render();

        return ['cart_popup' => $popup];
    }

    public function postCartUpdate(Request $request): array
    {
        $id = $request->get('id');
        $qnt = $request->get('qnt');

        try {
            Cart::updateCount($id, $qnt);
            $cart = Cart::all();
            $item = $cart[$id];

            return [
                'success' => true,
                'current' => number_format($item['qnt'] * $item['price'], 0, '.', ' ') . ' ₽',
                'total' => number_format(Cart::sum(), 0, '.', ' ') . ' ₽'
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function postCartRemove(Request $request): array
    {
        $id = $request->get('id');
        Cart::remove($id);
        $header_cart = view('blocks.header_cart', ['cart_items' => Cart::all()])->render();
        return [
            'success' => true,
            'header_cart' => $header_cart
        ];
    }

    public function postCartPurge(): array
    {
        Cart::purge();
        $total = view('cart.table_row_total')->render();
        $header_cart = view('blocks.header_cart', ['innerPage' => true])->render();
        return [
            'success' => true,
            'total' => $total,
            'header_cart' => $header_cart
        ];
    }

    public function postCartCheckout(Request $request)
    {
        $data = $request->only([
            'name',
            'city',
            'address',
            'email',
            'index',
            'phone',
            'comment',
            'company'
        ]);
        $valid = Validator::make($data, [
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'index' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ], [
            'name.required' => 'Не указаны ваши ФИО!',
            'city.required' => 'Не указан город!',
            'address.required' => 'Не указан адрес!',
            'index.required' => 'Не указан индекс!',
            'email.required' => 'Не указан ваш e-mail адрес!',
            'email.email' => 'Не корректный e-mail адрес!',
            'phone.required' => 'Не заполнено поле Телефон',
        ]);
        if ($valid->fails()) {
            return ['success' => false, 'errors' => $valid->messages()];
        }

        $data['unique_id'] = md5(uniqid(rand(), true)) . '/' . time();

        $order = Order::create($data);
        $items = Cart::all();
        $total_sum = 0;
        $all_count = 0;
        foreach ($items as $item) {
            $order->products()->attach($item['id'], [
                'qnt' => $item['qnt'],
                'price' => $item['price']
            ]);
            $total_sum += $item['qnt'] * $item['price'];
            $all_count += $item['qnt'];
        }
        $order->update(['total_sum' => $total_sum]);

//		Mailer::sendNotification('mail.order',[
//			'order' => $order,
//			'items'	=> $items,
//			'all_count'	=> $all_count,
//			'all_summ'	=> $summ
//		], function($message){
//			$to = Settings::get('order_email');
//
//			/** @var Message $message */
//			$message->from('info@allant.ru', 'allant.ru - уведомления')
//				->to($to)
//				->subject('allant.ru - Новый заказ');
//		});

        Cart::purge();

        return [
            'success' => true,
            'msg' => 'Заказ успешно создан',
            'redirect' => route('ajax.cart.success', ['unique_id' => $order->unique_id])
        ];
    }

    public function getSuccess()
    {
        $unique_id = request()->get('unique_id');
        if (!$unique_id) {
            abort(404);
        }
        return view('cart.success', compact('unique_id'));
    }

    public function postFavorite(): array
    {
        $id = \request()->get('id');

        if (!$id) {
            return ['success' => false, 'msg' => 'Нет ID'];
        }

        $favorites = session('favorites', []);

        $added = false;
        if (!in_array($id, $favorites)) {
            session()->push('favorites', $id);
            $added = true;
        } else {
            foreach ($favorites as $key => $item) {
                if ($item == $id) {
                    unset($favorites[$key]);
                }
            }
            session()->forget('favorites');
            if (count($favorites)) {
                foreach ($favorites as $item) {
                    session()->push('favorites', $item);
                }
            }
        }

        $header_favorites = view('blocks.header_favorites')->render();

        return [
            'success' => true,
            'header_favorites' => $header_favorites,
            'added' => $added
        ];
    }

    public function postCompare(): array
    {
        $id = \request()->get('id');

        if (!$id) {
            return ['success' => false, 'msg' => 'Нет ID'];
        }

        $compare = session('compare', []);

        $added = false;
        if (!in_array($id, $compare)) {
            session()->push('compare', $id);
            $added = true;
        } else {
            foreach ($compare as $key => $item) {
                if ($item == $id) {
                    unset($compare[$key]);
                }
            }
            session()->forget('compare');
            if (count($compare)) {
                foreach ($compare as $item) {
                    session()->push('compare', $item);
                }
            }
        }
        $header_compare = view('blocks.header_compare')->render();

        return [
            'success' => true,
            'header_compare' => $header_compare,
            'added' => $added
        ];
    }

    public function postCompareDelete()
    {
        $id = \request()->get('id');

        if (!$id) {
            return ['success' => false, 'msg' => 'Нет ID'];
        }

        $compare = session('compare', []);
        foreach ($compare as $key => $item) {
            if ($item == $id) {
                unset($compare[$key]);
            }
        }
        session()->forget('compare');
        if (count($compare)) {
            foreach ($compare as $item) {
                session()->push('compare', $item);
            }
        }

        $header_compare = view('blocks.header_compare')->render();


        return [
            'success' => true,
            'header_compare' => $header_compare,
        ];
    }

}
