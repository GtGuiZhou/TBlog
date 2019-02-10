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

## 2019年02月08日14:30:31
### php的另一种遍历方法
current：用来获取数组当前项
next:用来将数组内部的指针指向下一项
key:用来获取当前项的指针
~~~
<?php
$array = array(
    'fruit1' => 'apple',
    'fruit2' => 'orange',
    'fruit3' => 'grape',
    'fruit4' => 'apple',
    'fruit5' => 'apple');

// this cycle echoes all associative array
// key where value equals "apple"
while ($fruit_name = current($array)) {
    if ($fruit_name == 'apple') {
        echo key($array).'<br />';
    }
    next($array);
}
?>
~~~
## 2019年02月08日14:54:21
发现v5.1.34的thinkphp框架软删除有问题，进行了修正

## 2019年02月08日15:14:16
发现thinkphp框架的软删除字段时间不会自动转换，所以要手动转换
~~~
  public function getDeleteTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }
~~~