<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午1:41
 */

use think\facade\Route;

Route::post('admin/upload/image','admin/upload/image')->allowCrossDomain(true);
Route::get('admin/upload','admin/upload/read');
Route::get('admin/upload/image','admin/upload/read');

Route::post('api/upload/image','api/upload/image')->allowCrossDomain(true);
Route::get('api/upload','api/upload/read');
Route::get('api/upload/image','api/upload/read');