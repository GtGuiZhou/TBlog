<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午10:58
 */


crud_router_set('admin/article');

soft_delete_router_set('admin/article');

crud_router_set('api/article');

\think\facade\Route::get('api/article/star/:id','api/article/star')
    ->middleware('common/lib/StarValidateIpMiddle');