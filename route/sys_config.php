<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-10
 * Time: 下午2:50
 */
use think\facade\Route;

Route::get('api/sysconfig/read/:key','api/Sysconfig/read');
Route::put('api/sysconfig/update/:key','api/Sysconfig/update');
Route::get('admin/sysconfig/read/:key','admin/Sysconfig/read');
Route::put('admin/sysconfig/update/:key','admin/Sysconfig/update');