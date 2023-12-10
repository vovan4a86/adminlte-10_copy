<?php namespace Adminlte3;

use Adminlte3\Models\Product;
use Session;

class Cart {

    private static string $key = 'cart';

    public static function add($item): void
    {
        $cart = self::all();

        $cart[$item['id']] = $item;
        Session::put(self::$key, $cart);
    }

    public static function remove($id): void
    {
        $cart = self::all();
        unset($cart[$id]);
        Session::put(self::$key, $cart);
    }

    public static function ifInCart($id): bool {
        $cart = self::all();
        return isset($cart[$id]);
    }

    public static function updateCount($id, $qnt): void
    {
        $cart = self::all();
        if (isset($cart[$id])) {
            $cart[$id]['qnt'] = $qnt;
            Session::put(self::$key, $cart);
        }
    }

    public static function purge() {
        Session::put(self::$key, []);
    }

    public static function all(): array {
        $res = Session::get(self::$key, []);
        return is_array($res) ? $res : [];
    }

    public static function sum(): int {
        $cart = self::all();
        $sum = 0;
        foreach ($cart as $item) {
            $sum += $item['qnt'] * $item['price'];
        }
        return $sum;
    }

    public static function count(): int {
        $cart = self::all();
        return count($cart);
    }

    public static function total_weight(): int {
        $cart = self::all();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['weight'] * $item['count'];
        }

        return round($total);
    }
}
