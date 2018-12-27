<?php
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('GET_STARTED', BotManController::class.'@startConversation');

$botman->hears('PAYBILL_PAYLOAD', function($bot){
  $bot->typesAndWaits(2);
  $bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
    	->addButton(ElementButton::create('Guess My Name')
    	    ->type('postback')
    	    ->payload('GUESS_MY_NAME')
    	)
    	->addButton(ElementButton::create('Show me the docs')
    	    ->url('http://botman.io/')
    	)
    );
});

$botman->hears('GUESS_MY_NAME', function($bot){
  $bot->typesAndWaits(2);
  $user=$bot->getUser();
  $id =$user->getId();
  $userName=$user->getFirstName().' '.$user->getLastName();
  $bot->reply('hello '.$userName);
  if(strpos(strtolower($userName), 'zayar') !== false){
    $bot->reply('u r my admin');
  }
});
