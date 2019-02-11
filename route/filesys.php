<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午1:41
 */

use think\facade\Route;

Route::post('admin/filesys/upload','admin/filesys/upload')->allowCrossDomain(true);
Route::get('admin/filesys/read','admin/filesys/read');
Route::get('admin/filesys/index','admin/filesys/index');
Route::delete('admin/filesys/delete','admin/filesys/delete');

Route::post('api/filesys/upload','api/filesys/upload')->allowCrossDomain(true);
Route::get('api/filesys/read','api/filesys/read');