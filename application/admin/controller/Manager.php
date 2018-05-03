<?php

namespace app\admin\controller;

use app\admin\facde\ElementUi;
use app\common\controller\AdminController;
use think\facade\Session;

class Manager extends AdminController
{

    public function logout()
    {
        Session::destroy();
        return json()->code(204);
    }

    /**
     * @powerlevel   1  @powerlevel
     * @return array
     */
    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        return \app\admin\facde\Manager::getlist(ElementUi::init($data));
    }

    /**
     * @powerlevel   1  @powerlevel
     * @return array
     */
    public function get()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\ManagerValidate.get');
        return \app\admin\facde\Manager::get($data);
    }

    /**
     * @powerlevel   1  @powerlevel
     * @return array
     */
    public function save()
    {
        $data = $this->request->param();
        if ($data['id']) {
            $this->validate($data, 'app\admin\validate\ManagerValidate.update');
            return ['id' => \app\admin\facde\Manager::update($data)];
        } else {
            $this->validate($data, 'app\admin\validate\ManagerValidate.create');
            return ['id' => \app\admin\facde\Manager::create($data)];
        }
    }

    /**
     * @powerlevel   1  @powerlevel
     * @return array
     */
    public function delete()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\ManagerValidate.delete');
        return \app\admin\facde\Manager::delete($data);
    }
}