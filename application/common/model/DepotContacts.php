<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:25
 */

namespace app\common\model;

use think\Model;

class DepotContacts extends Model
{
    protected $name = 'depot_contacts';

    public function depot()
    {
        return $this->belongsTo('depot');
    }

    public function saveContacts($depot_id, $data)
    {
        if (!empty($data) && $depot_id) {
            $list = [];
            foreach ($data as $v) {
                if (empty($v['id'])) {
                    $v['depot_id'] = $depot_id;
                    array_push($list, $v);
                } else {
                    $this->allowField('name,email,avatar,type,tel')->save($v, ['id' => $v['id']]);
                }
            }
            $this->allowField('depot_id,name,email,avatar,type,tel')->saveAll($list);
        }
    }
}