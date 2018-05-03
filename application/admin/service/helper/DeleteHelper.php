<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 13:49
 */

namespace app\admin\service\helper;

trait DeleteHelper
{
    protected function deleteCondition($id, $data)
    {
        return [
            'id' => $id
        ];
    }

    public function delete($data)
    {
        $num = 0;
        foreach (explode(',', $data['id']) as $id) {
            $data = $this->getModel()->where($this->deleteCondition($id, $data))->find();
            if (!empty($data)) {
                $data->delete();
                $num++;
            }
        }
        return $num;
    }
}