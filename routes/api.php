<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// api notifications
Route::group(['prefix' => '/v1', 'namespace' => 'Api'], function () {
    // middleware
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::group(['prefix' => '/notifications'], function () {
            Route::post('/add', 'NotificationController@createNotification')->name('api_notification_add');
            Route::post('/read', 'NotificationController@readNotification')->name('api_notification_read');
            Route::get('/', 'NotificationController@getNotificationList')->name('api_notification_list_more');
            Route::get('/total-unread', 'NotificationController@countUnreadNotifications')->name('api_notification_count_unread');
        });
    });
});
