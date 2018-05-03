<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 19:45
 */

namespace app\admin\service\helper;

use app\common\exception\AdminException;

trait UpdateHelper
{

    protected function updateField()
    {
        return '*';
    }

    public function update($data)
    {
        $id = (int)$data['id'];
        $model = $this->getModel()->where('id', $id)->find();
        if ($model) {
            $this->getModel()->allowField($this->updateField())->save($data, ['id' => $id]);
            return $this->getModel()->id;
        } else {
            throw new AdminException(400, lang('DATA_NOT_FOUND'));
        }
    }
}