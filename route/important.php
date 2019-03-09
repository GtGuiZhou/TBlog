<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-13
 * Time: 下午2:41
 */

use think\facade\Route;

crud_router_set('admin/important');

soft_delete_router_set('admin/important');

Route::get('admin/important/unlock/:id/:secret_key','admin/important/unlock');