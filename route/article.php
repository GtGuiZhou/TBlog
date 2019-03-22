<?php
/**
 * Created by PhpStorm.
 * User: gt
 * Date: 19-2-7
 * Time: 下午10:58
 */


$register_curd = function ($rule) {
    think\facade\Route::get("$rule/read/:id","$rule/read");
    think\facade\Route::get("$rule/index","$rule/index");
    think\facade\Route::post("$rule/add","$rule/add")
        ->middleware(app\http\middleware\AddArticleTags::class);
    think\facade\Route::delete("$rule/delete/:id","$rule/delete");
    think\facade\Route::put("$rule/update/:id","$rule/update");
};

$register_curd('admin/article');

soft_delete_router_set('admin/article');

crud_router_set('api/article');

\think\facade\Route::get('api/article/star/:id','api/article/star')
    ->middleware('common/lib/StarValidateIpMiddle');