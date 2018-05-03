<?php
namespace app\admin\controller;

use app\common\controller\AdminController;
use app\admin\facde\ElementUi;

class Query extends AdminController
{

    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        return \app\admin\facde\Query::getlist(ElementUi::init($data));
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function delete()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\QueryValidate.delete');
        return \app\admin\facde\Query::delete($data);
    }
}