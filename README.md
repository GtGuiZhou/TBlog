# 基于ThinkPHP制作的博客网站后台

## 2019年02月07日12:19:40
今天写了上传功能，上传功能需要注意的一点是，上传成功后生成的url为
{domain}/api/upload这个方法

## 2019年02月08日12:19:47
由于restfull的路由写法，容易造成路由解析误判，所以放弃使用restfull的Url写法。
例如
get方法的article/:id => article/index/read会导致
get方法的article/indexOfTrashed解析为上述路由
虽然可以指定id为数字类型，使得路由解析正确，但是万一以后id是字符串类型呢？
所以放弃了restfull的路由写法
