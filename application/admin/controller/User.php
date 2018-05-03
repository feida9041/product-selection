<?php
namespace app\admin\controller;

use app\common\controller\AdminController;
use app\admin\facde\ElementUi;

class User extends AdminController
{

    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        return \app\admin\facde\User::getlist(ElementUi::init($data));
    }

    public function get()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\UserValidate.get');
        return \app\admin\facde\User::get($data);
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function delete()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\UserValidate.delete');
        return \app\admin\facde\User::delete($data);
    }
}