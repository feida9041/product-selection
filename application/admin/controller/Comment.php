<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:33
 */
namespace app\admin\controller;

use app\admin\facde\ElementUi;
use app\common\controller\AdminController;

class Comment extends AdminController
{

    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        return \app\admin\facde\Comment::getlist(ElementUi::init($data));
    }

    public function get()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\CommentValidate.get');
        return \app\admin\facde\Comment::get($data);
    }

    public function export()
    {
        header("Content-type: text/html; charset=utf-8");
        header('Content-Type: application/vnd.ms-excel,charset=utf-8');
        header("Content-Disposition: attachment; filename=csv.csv");
        header('Cache-Control: max-age=0');
        $list = \app\admin\facde\Comment::export([]);
        $fp = fopen('php://output', 'a');
        foreach ($list as $val) {
            fputcsv($fp, $val);
        }
    }

    /**
     * @powerlevel   1,2,3  @powerlevel
     * @return array
     */
    public function update()
    {
        $data = $this->request->param();
        $data['status'] = 1;
        $this->validate($data, 'app\admin\validate\CommentValidate.update');
        return ['id' => \app\admin\facde\Comment::update($data)];
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function delete()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\CommentValidate.delete');
        return \app\admin\facde\Comment::delete($data);
    }
}