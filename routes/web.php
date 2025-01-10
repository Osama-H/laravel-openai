<?php

use App\ai\Chat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $chat = new Chat();

    $code = $chat->systemMessage('You are a helpful assistant.')
        ->send("Write a Code that explains the concept of recursion.");


    // same thing .. 

    // $sillyPoem = $chat->send('Cool, can you make it much sillier?');

    $sillyPoem = $chat->reply('Cool, can you make it much sillier?');

    return view('welcome', ['code' => $sillyPoem]);
});
