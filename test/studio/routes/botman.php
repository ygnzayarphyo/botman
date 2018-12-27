<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('GET_STARTED', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('GET STARTED', BotManController::class.'@startConversation');

$botman->hears('PAYBILL_PAYLOAD',function($bot){
  $bot->reply('Thank you.');
});
