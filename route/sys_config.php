<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-10
 * Time: 下午2:50
 */
use think\facade\Route;

Route::get('api/SysconfigController/read/:key','api/SysconfigController/read');
Route::put('api/SysconfigController/update/:key','api/SysconfigController/update');

Route::get('admin/SysconfigController/read/:key','admin/SysconfigController/read');
Route::put('admin/SysconfigController/update/:key','admin/SysconfigController/update');