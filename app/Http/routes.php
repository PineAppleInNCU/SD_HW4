<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//message board   -   welcome//
Route::get('/','HomeController@index');
Route::post('make_message','WelcomeController@make_message');
//Route::post('test_route_2','WelcomeController@test_route_2');
Route::post('message_delete','WelcomeController@message_delete');
Route::post('message_delete_error','WelcomeController@message_delete_error');
Route::post('message_fix','WelcomeController@message_fix');
Route::post('reply_fix','WelcomeController@reply_fix');
//message board   -   welcome//


//reply - reply//
Route::post('reply','ReplyController@index');
Route::post('reply_reply','ReplyController@reply');
Route::post('reply_delete','ReplyController@reply_delete');
//reply - reply


/////////////register  login//////////////
Route::auth();
Route::get('/home', 'HomeController@index');
////////////login           //////////////



//////literature////////////
//現階段大家共用
Route::get('browse_all_message_literature/{academy}','Browse_literatureController@index');//依據academy欄位，進入不同學院的討論串總覽
Route::post('browse_all_message_literature/new_a_message','Browse_literatureController@new_a_message');//到新增討論串的頁面]
Route::post('browse_all_message_literature/upload_a_message','Browse_literatureController@upload_a_message');//新增討論串
Route::get('browse_all_message_literature/browse_one_message/{id}','Browse_literatureController@browse_one_message');//根據id，進入不同的討論串
Route::post('browse_all_message_literature/browse_one_message/reply','Browse_literatureController@reply');//進入回覆頁面
Route::post('browse_all_message_literature/browse_one_message/reply_reply','ReplyController@reply');//新增對留言的回應,修改留言，修改回覆，新增回覆
Route::post('make_sub_message','Browse_literatureController@make_sub_message');//新增留言
Route::post('browse_all_message_literature/browse_one_message/message_delete','Browse_literatureController@message_delete');//刪除留言
Route::post('browse_all_message_literature/browse_one_message/message_fix','Browse_literatureController@message_fix');//修改留言
Route::post('browse_all_message_literature/browse_one_message/reply_fix','Browse_literatureController@reply_fix');//修改回覆
Route::post('browse_all_message_literature/browse_one_message/reply_delete','Browse_literatureController@reply_delete');//刪除回覆
Route::post('browse_all_message_literature/test_polling','Browse_literatureController@test_polling');
//////literature////////////
//messenger//
Route::get('messenger','MessengerController@index');
Route::post('test_polling','MessengerController@test_polling');
Route::post('get_name','MessengerController@get_name');
Route::post('poll','MessengerController@poll');
//messenger//


//////new_message//////////
//大家共用
Route::get('new_message','new_messageController@index');
//////new_message//////////
