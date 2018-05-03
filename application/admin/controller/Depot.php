<?php
namespace app\admin\controller;

use app\admin\facde\ElementUi;
use app\common\controller\AdminController;

class Depot extends AdminController
{

    public function getList()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\BaseListValidate');
        return \app\admin\facde\Depot::getlist(ElementUi::init($data));
    }

    public function get()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\DepotValidate.get');
        return \app\admin\facde\Depot::get($data);
    }

    /**
     * @powerlevel   1,2,3  @powerlevel
     * @return array
     */
    public function save()
    {
        $data = $this->request->param();
        if (isset($data['id']) && $data['id']) {
            $this->validate($data, 'app\admin\validate\DepotValidate.update');
            return ['id' => \app\admin\facde\Depot::update($data)];
        } else {
            $this->validate($data, 'app\admin\validate\DepotValidate.create');
            return ['id' => \app\admin\facde\Depot::create($data)];
        }
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function delete()
    {
        $data = $this->request->param();
        $this->validate($data, 'app\admin\validate\DepotValidate.delete');
        return \app\admin\facde\Depot::delete($data);
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function deleteSource()
    {
        $data = $this->request->param();
        deleteFile($data['path']);
        deleteFile($data['original_path']);
        \app\admin\facde\Depot::deleteSource($data['uid']);
        return json()->code(204);
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function deleteContact()
    {
        $data = $this->request->param();
        if (isset($data['avatar']) && $data['avatar']) {
            deleteFile($data['avatar']);
        }
        if (isset($data['id']) && $data['id']) {
            \app\admin\facde\Depot::deleteContact($data['id']);
        }
        return json()->code(204);
    }
}
