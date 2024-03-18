<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Product;
use Adminlte3\Models\ProductChar;
use Artesaos\SEOTools\Facades\SEOMeta;
use danog\MadelineProto\Tools;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;

class PageController extends Controller
{
    public function page()
    {
        return dd('PageController@page');
    }

    public function getCompareList()
    {
        SEOMeta::setTitle('Список сравнения');
        SEOMeta::setDescription('Список сравнения');

        $compare_ids = session('compare', []);
        $items = Product::whereIn('id', $compare_ids)->with(['images', 'catalog', 'chars'])->get();

        $compare_names = ProductChar::whereIn('product_id', $compare_ids)
            ->groupBy('name')
            ->get('name');

        return view('compare.index', compact('items', 'compare_names'));
    }

    public function getFavoritesList()
    {
        SEOMeta::setTitle('Список желаний');
        SEOMeta::setDescription('Список желаний');


        $favorites_ids = session('favorites', []);
        $items = Product::whereIn('id', $favorites_ids)->with(['images', 'catalog', 'chars'])->get();

        return view('favorites.index', compact('items'));
    }

    public function bot()
    {


//        $settings = (new \danog\MadelineProto\Settings\AppInfo)
//            ->setApiId(23379926)
//            ->setApiHash('9f86c0949a56a0e5abe3a4ee0b75f6c0');
        $MadelineProto = new \danog\MadelineProto\API('session.madeline');
        $MadelineProto->start();

//        $data = array(
//            'peer' => '@test4me',
//            'hash' => 0
//        );
//
//        $response = $MadelineProto->messages->getHistory($data);

//        $me = $MadelineProto->getSelf();
//        $MadelineProto->logger($me);
//
//        if (!$me['bot']) {
//            $MadelineProto->messages->sendMessage(peer: '@stickeroptimizerbot', message: "/start");
//
//            $MadelineProto->channels->joinChannel(channel: '@test4me');
//
//            try {
//                $MadelineProto->messages->importChatInvite(hash: 'https://t.me/+Por5orOjwgccnt2w');
//            } catch (\danog\MadelineProto\RPCErrorException $e) {
//                $MadelineProto->logger($e);
//            }
//        }
//        $MadelineProto->echo('OK, done!');


//        $bot = TelegraphBot::create(
//            [
//                'token' => '6244903952:AAEBTwqwkkX9zJX0Sa0Hls3g7G5CHsye55w',
//                'name' => 'My Bot Bot',
//            ]
//        );

//        $bot = TelegraphBot::fromId(3);
//        dd($bot->info());

        /** @var TelegraphBot $bot */
//        $bot->unregisterWebhook()->send();

        /** @var TelegraphChat $chat */
//        $chat = $bot->chats()->create(
//            [
//                'chat_id' => '001',
//                'name' => 'Chat 001',
//            ]
//        );
//        $chat = $bot->chats->first();

//        $chat->html("<strong>Hello!</strong>\n\nI'm here!")->send();
//        Telegraph::message('123hello1')->send();
//        $chat->message('hello')->send();

//        Telegraph::message('hello world')->send();

//        $token = "6244903952:AAEBTwqwkkX9zJX0Sa0Hls3g7G5CHsye55w";
//
//        $getQuery = array(
//            "chat_id" 	=> 1424625511,
//            "text"  	=> "Новое сообщение из формы",
//            "parse_mode" => "html"
//        );
//        $ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        $resultQuery = curl_exec($ch);
//        curl_close($ch);
//
//        echo $resultQuery;

        return view('pages.bot');
    }
}
