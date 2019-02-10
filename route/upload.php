<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午1:41
 */

use think\facade\Route;

Route::post('admin/upload/file','admin/upload/file')->allowCrossDomain(true);
Route::get('admin/upload/read','admin/upload/read');

Route::post('api/upload/file','api/upload/file')->allowCrossDomain(true);
Route::get('api/upload/read','api/upload/read');