<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-10
 * Time: 下午2:50
 */
use think\facade\Route;

Route::get('api/SysConfigController/read/:key','api/SysConfigController/read');
Route::put('api/SysConfigController/update/:key','api/SysConfigController/update');

Route::get('admin/SysConfigController/read/:key','admin/SysConfigController/read');
Route::put('admin/SysConfigController/update/:key','admin/SysConfigController/update');