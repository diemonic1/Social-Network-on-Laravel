<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

date_default_timezone_set( 'Europe/Moscow' );

Route::get('/', 'HomeController@index')->name('home.index')->middleware('notAuthenticated');

route::group(['namespace' => 'Dialogue', 'middleware' => 'authenticated'], function (){
    Route::get('/dialogues', 'IndexController')->name('dialogues.index');
    Route::get('/getAllDialogues', 'getAllDialoguesController')->name('dialogues.getAllDialogues');
    Route::get('/dialogues/Search={key}', 'getAllDialoguesController')->name('dialogues.search');

    Route::get('/dialogues/Create={user}', 'CreateController')->name('dialogues.create');

    Route::get('/dialogues/{dialogue}', 'ShowController')->name('dialogues.show')->middleware('showDialogue');
    Route::get('/showInDialogue/{dialogue}/{messageToShow?}', 'ShowController')->name('dialogues.showInDialogue')->middleware('showDialogue');

    Route::post('/dialogues/{dialogue}', 'StoreController')->name('dialogues.store');

    Route::get('/dialogues/GetMessages/{dialogue}', 'GetMessagesController')->name('dialogues.GetMessages')->middleware('showDialogue');
    Route::get('/dialogueTyping', 'TypingController')->name('dialogues.typing');
});

route::group(['namespace' => 'Message', 'middleware' => 'authenticated'], function (){
    Route::get('/SearchMessage', 'SearchByMessageController')->name('message.search');
    Route::get('/SearchMessage={key}', 'IndexController')->name('message.showSearchResults');

    Route::patch('/dialogues/{message}', 'UpdateController')->name('message.update');

    Route::delete('/dialogues/{message}', 'DestroyController')->name('message.delete');
});

route::group(['namespace' => 'User', 'middleware' => 'authenticated'], function (){
    Route::get('/user/edit', 'EditController')->name('user.edit');
    Route::patch('/user/update', 'UpdateController')->name('user.update');

    Route::get('/userGender/edit', 'EditGenderController')->name('user.editGender');
    Route::patch('/userGender/update', 'UpdateGenderController')->name('user.updateGender');

    Route::get('/userAvatar/edit', 'EditAvatarController')->name('user.editAvatar');
    Route::patch('/userAvatar/update', 'UpdateAvatarController')->name('user.updateAvatar');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('notAuthenticated');
