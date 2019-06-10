<?php
/**
 * Created by PhpStorm.
 * User: xiaob
 * Date: 2019/6/4
 * Time: 14:21
 */
namespace app\web\controller;
use app\web\model\NewsModel;
use think\Controller;

class Newslist extends controller
{
    //========================================手机页面=============================================
    public function index(){
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->Index());
        return $this->fetch('index');
    }

    //拉取页面
    public function lists(){
        $NewsModel = new NewsModel();
        $this->view->assign('list',$NewsModel->Lists());
        return $this->fetch();
    }

    //详情页
    public function detail(){
        $NewsModel = new NewsModel();
        $this->view->assign('content',$NewsModel->Detail());
        $this->view->assign('id',input('id'));
        return $this->fetch();
    }
}