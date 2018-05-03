<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/7
 * Time: 21:25
 */

namespace app\common\model;

use think\Model;

class DepotSource extends Model
{
    protected $name = 'depot_source';

    public function depot()
    {
        return $this->belongsTo('depot');
    }

    public function saveSource($depot_id, $type = 1, $data)
    {
        if (!empty($data) && $depot_id) {
            $list = [];
            foreach ($data as $v) {
                if (empty($v['id'])) {
                    array_push($list, [
                        'name'          => $v['name'],
                        'type'          => $type,
                        'depot_id'      => $depot_id,
                        'size'          => $v['size'],
                        'status'        => $v['status'],
                        'uid'           => $v['uid'],
                        'path'          => $v['path'],
                        'original_path' => $v['original_path'],
                    ]);
                } else {
                    $this->allowField('path,name,uid,status,size,original_path')->save($v, ['id' => $v['id']]);
                }
            }
            $this->insertAll($list);
        }
    }
}