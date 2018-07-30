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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/history', 'HistoryController@index')->middleware('auth');
Route::get('/getBookingList/{user_ID}', 'HistoryController@getBookingList');

Route::POST('/updateStatus', 'HistoryController@changeStatus');

Route::get('/idCard', 'IdCardController@index')->middleware('auth');

Route::get('/room/{roomID}', 'RoomController@index');
Route::get('/room/{roomID}/getBooking', 'RoomController@getBooking');
Route::POST('/bookRoom', 'RoomController@bookRoom');
Route::POST('/updateBookingTime', 'RoomController@updateBookingTime');


Route::get('/addRoom', 'RoomController@addRoomIndex');
Route::POST('/addRoom', 'RoomController@addRoom');
Route::get('/getRoomBackground/{path}', 'RoomController@getRoomBackground');

Route::get('/login', 'AuthController@loginPage');
Route::POST('/login', 'AuthController@login');

Route::get('/register', 'AuthController@registerPage');
Route::POST('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout');

//Admin 專用以下
Route::get('/bookingCalendar', 'BookingCalendarController@index')->middleware('admin');
Route::get('/getAllRoom', 'BookingCalendarController@getAllRoom');
Route::get('/getAllBooking', 'BookingCalendarController@getAllBooking');

Route::get('/bookingTable', 'BookingTableController@index')->middleware('admin');
Route::get('/getAllBookingList', 'BookingTableController@getAllBookingList');

Route::get('/userTable', 'UserTableController@index')->middleware('admin');
Route::get('/getAllUser', 'UserTableController@getAllUser');
Route::POST('/deleteUser', 'UserTableController@deleteUser');

Route::get('/roomTable', 'RoomTableController@index')->middleware('admin');
Route::get('/getRoomList', 'RoomTableController@getRoomList');
Route::POST('/deleteRoom', 'RoomTableController@deleteRoom');

//iOS
Route::POST('/iOSLogin', 'iOSController@iOSLogin');
Route::POST('/iOSRegister', 'iOSController@iOSRegister');
Route::GET('/iOSGetRoomList', 'iOSController@iOSGetRoomList');
Route::GET('/iOSGetBookingListByRoomID/{roomID}', 'iOSController@iOSGetBookingListByRoomID');
Route::GET('/iOSGetBookingListByUserID/{userID}', 'iOSController@iOSGetBookingListByUserID');
Route::GET('/iOSGetBookingByBookingID/{bookingID}','iOSController@iOSGetBookingByBookingID');
Route::POST('/iOSUpdateStatus', 'iOSController@iOSUpdateStatus');
Route::POST('/iOSBookRoom', 'iOSController@iOSBookRoom');
Route::POST('/iOSDeleteRoom', 'iOSController@iOSDeleteRoom');
Route::POST('/iOSAddRoom', 'iOSController@iOSAddRoom');


//Android
Route::POST('/AndroidLogin', 'AndroidController@AndroidLogin');
Route::POST('/AndroidRegister', 'AndroidController@AndroidRegister');
Route::GET('/AndroidGetRoomList', 'AndroidController@AndroidGetGetRoomList');
Route::GET('/AndroidGetBookingList/{roomID}', 'AndroidController@AndroidGetBooking');
Route::POST('/AndroidBookRoom', 'AndroidController@AndroidBookRoom');
