<?php
namespace app\Home\model;
use think\Model;

class NewsModel extends Model
{
    public function index(){
        //banner 可以指定条件 与下面无异
        //列表 and 时光轴 and banner三张小图
        $list = db('list')
            ->where('colum_id = 2')
            ->order('id desc')
            ->limit(5)
            ->select();

            foreach($list as $key=>&$v)
            {
                //正则匹配文中img
                $str = $v['content'];
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
                preg_match_all($pattern,$str,$match);
                $v['img'] = $match[1];          //文章中图片地址
                $v['count'] = count($match[1]); //文章中图片数量
            }
        return $list;
    }


    //========================================下拉-加载======================================================
    public function Lists(){
        //page
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


    //========================================时光轴======================================================
    public function TimeList(){
        $list = db('list')
            ->where('colum_id = 2')
            ->order('id desc')
            ->limit(5)
            ->select();

        foreach($list as $key=>&$v)
        {
            //正则匹配文中img
            $str = $v['content'];
            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
            preg_match_all($pattern,$str,$match);
            $v['img'] = $match[1];          //文章中图片地址
            $v['count'] = count($match[1]); //文章中图片数量
        }
        return $list;
    }


    //========================================详情页面======================================================
    public function Detail(){
        //时光轴
        $list = db('list')
            ->where('colum_id = 2')
            ->order('id desc')
            ->limit(5)
            ->select();
            foreach($list as $key=>&$v)
            {
                $str = $v['content'];
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
                preg_match_all($pattern,$str,$match);
                $v['img'] = $match[1];
                $v['count'] = count($match[1]);
            }

        //文章内容
        $content = db('list')->where('id',input('id'))->select();
        $msg = ['list'=>$list, 'content'=>$content];
        return $msg;
    }


    //========================================搜索页面列表======================================================
    public function Search(){
        $title['title'] = input('title')==''?array('like', "%".input('title')."%"):array('neq', "*");
        $list = db('list')
            ->where('colum_id = 2')
            ->where($title)
            ->limit(2)
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


    //========================================搜索页面 下拉-加载=============================================
    public function SearchList(){
        $title['title'] = input('title')?array('like', "%".input('title')."%"):array('neq', "*");
        $limit = input('limit')?input('limit'):0;
        $list = db('list')
            ->where('colum_id = 2')
            ->where($title)
            ->limit($limit,2)
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

}