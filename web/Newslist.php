<?php
namespace app\Home\controller;
use app\Home\model\NewsModel;

class Newslist extends Common
{
    public function index()
    {
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->index());
        return $this->fetch();
    }


    //========================================下拉-加载======================================================
    public function lists(){
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->Lists());
        return $this->fetch();
    }


    //========================================时光轴页面======================================================
    public function timelist(){
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->TimeList());
        return $this->fetch();
    }



    //========================================详情页面======================================================
    public function detail(){
        $NewsModel = new NewsModel();
        $msg = $NewsModel->Detail();

        $this->view->assign('id',input('id'));
        $this->view->assign('list',$msg['list']);
        $this->view->assign('content',$msg['content']);
        return $this->fetch();
    }




    //========================================搜索页面列表======================================================
    public function search(){
        $NewsModel = new NewsModel();
        $this->view->assign('title',input('title'));
        $this->view->assign('list',$NewsModel->Search());
        return $this->fetch();
    }

    //========================================搜索页面 下拉-加载=============================================
    public function searchlist(){
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->SearchList());
        return $this->fetch('search_list');
    }


    //========================================手机页面=============================================
//    public function phone(){
//        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
//        $list = db('list')
//            ->where('colum_id = 2')
//            ->order('id desc')
//            ->limit(5)
//            ->select();
//        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
//        foreach($list as $key=>&$v)   //key 是数字 \ v是内容
//        {
//            $str = $v['content'];
/*            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";*/
//            preg_match_all($pattern,$str,$match);
//            $v['img'] = $match[1];
//            $v['count'] = count($match[1]);
//        }
//
//        $this->view->assign('list',$list);
//        return $this->fetch('phone');
//    }
//
//    //拉取页面
//    public function phlist(){
//        $limit = input('limit')?input('limit'):0;
//        $p_id['p_id'] = input('p_id')!=''?array('eq',input('p_id')):array('neq', "100");
//        $list = db('list')
//            ->where('colum_id = 2')
//            ->where($p_id)
//            ->order('id desc')
//            ->limit($limit,5)
//            ->select();
//        //循环遍历拿到图片和图片数量  这里数量如果大于3则多图 小于3则单图
//        foreach($list as $key=>&$v)   //key 是数字 \ v是内容
//        {
//            $str = $v['content'];
/*            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";*/
//            preg_match_all($pattern,$str,$match);
//            $v['img'] = $match[1];
//            $v['count'] = count($match[1]);
//        }
//        $this->view->assign('list',$list);
//        return $this->fetch('phone_list');
//    }
//
//    //详情页
//    public function phdetail(){
//        $content = db('list')
//            ->where('id',input('id'))
//            ->select();
//        $this->view->assign('content',$content);
//        $this->view->assign('id',input('id'));
//        return $this->fetch('phone_detail');
//    }
}