<?php

namespace app\command;

use app\common\ext\RedisPool;
use app\common\model\SysConfigModel;
use Exception;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Log;

class SyncArticleTags extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('app\command\sync_article_tags');
        // 设置参数

    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $key = 'article:tags';
        $redis = RedisPool::instance();
        // 将mysql中的标签先同步到redis中
        try{
            $config = SysConfigModel::where('field',$key)->findOrFail();
            $tags = $config['value'];
            $redis->sAddArray($key,$tags);
            $tags = $redis->sMembers($key);
            $config->isUpdate(true)->save(['value' => $tags]);
            $output->writeln('同步文章标签完成');
            Log::notice('同步文章标签完毕');
        } catch (Exception $e){
            Log::error("同步文章标签失败:".$e->getMessage());
        }
    }
}
