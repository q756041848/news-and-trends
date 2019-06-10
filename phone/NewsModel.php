<?php
namespace app\web\model;
use think\Model;

class NewsModel extends Model
{
    public function Index(){
        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
        $list = db('list')
            ->where('colum_id = 2')
            ->order('id desc')
            ->limit(5)
            ->select();
        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
        foreach($list as $key=>&$v)   //key 是数字 \ v是内容
        {
            $str = $v['content'];
            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            preg_match_all($pattern,$str,$match);
            $v['img'] = $match[1];
            $v['count'] = count($match[1]);
        }
        return $list;
    }

//    下拉-加载
    public function Lists(){
        $limit = input('limit')?input('limit'):0;
        $p_id['p_id'] = input('p_id')!=''?array('eq',input('p_id')):array('neq', "100");
        $list = db('list')
            ->where('colum_id = 2')
            ->where($p_id)
            ->order('id desc')
            ->limit($limit,5)
            ->select();
        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
        foreach($list as $key=>&$v)   //key 是数字 \ v是内容
        {
            $str = $v['content'];
            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            preg_match_all($pattern,$str,$match);
            $v['img'] = $match[1];
            $v['count'] = count($match[1]);
        }
        return $list;
    }

//    详情页
    public function Detail(){
        $content = db('list')->where('id',input('id'))->select();
        return $content;
    }
}