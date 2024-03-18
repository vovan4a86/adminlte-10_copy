<?php

// PHP 8.2+ is required.

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

$settings = (new \danog\MadelineProto\Settings\AppInfo)
    ->setApiId(23379926)
    ->setApiHash('9f86c0949a56a0e5abe3a4ee0b75f6c0');

$MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
$MadelineProto->start();

$me = $MadelineProto->getSelf();
$MadelineProto->logger($me);

if (!$me['bot']) {
//    $MadelineProto->messages->sendMessage(peer: '@stickeroptimizerbot', message: "/start");

    $MadelineProto->channels->joinChannel(channel: '@MadelineProto');

    try {
        $MadelineProto->messages->importChatInvite(hash: 'https://t.me/+Por5orOjwgccnt2w');
//        $dialogs = $MadelineProto->getFullDialogs();
//        foreach ($dialogs as $dialog) {
//            $MadelineProto->logger($dialog);
//            break;
//        }
    } catch (\danog\MadelineProto\RPCErrorException $e) {
        $MadelineProto->logger($e);
    }
}
$MadelineProto->echo('OK, done!');
