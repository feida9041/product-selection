<?php

namespace app\admin\service;

use app\admin\page\BasePage;
use app\admin\service\helper\ListHelper;
use app\common\model\DepotContacts;
use app\common\model\DepotModel;
use app\common\model\DepotSource;
use think\Db;

class Depot extends BaseService
{
    use ListHelper;

    protected $model = DepotModel::class;

    protected function listField()
    {
        return 'id,name,continent,address,business,square_meter,create_time,manager_id';
    }

    public function getApilist(BasePage $page)
    {
        $where = $this->createSearch($page);
        $field = 'id,name,continent,address,business,square_meter,create_time';
        $list = $this->getModel()
            ->field($field)
            ->where($where)
            ->order($page->getOrder() !== null ?: $this->listDefaultOrder())
            ->paginate($page->getPageSize(), false, [
                'page' => $page->getPage(),
            ])->toArray();
        if ($list['total'] === 0) {
            $list = $this->getModel()
                ->field($field)
                ->where([])
                ->order($page->getOrder() !== null ?: $this->listDefaultOrder())
                ->paginate($page->getPageSize(), false, [
                    'page' => $page->getPage(),
                ])->toArray();
        }
        foreach ($list['data'] as &$v) {
            $path = DepotSource::where([
                'depot_id' => $v['id'],
                'type'     => 1,
            ])->field('path')->find();
            if ($path) {
                $path = $path['path'];
            }
            $v['photo'] = $path;
        }
        return $list;
    }

    protected function createSearch(BasePage $page)
    {
        $where = [];
        $search = $page->getSearch();
        if (isset($search['continent'])) {
            $where['continent'] = $search['continent'];
        }
        if (isset($search['name'])) {
            $where[] = ['name', 'like', '%' . $search['name'] . '%'];
        }
        if (isset($search['business'])) {
            $where[] = ['business', 'exp', '& ' . $search['business']];
        }
        return $where;
    }

    public function get($data)
    {
        $data = DepotModel::get($data['id'], ['source', 'contacts']);
        if ($data) {
            $data = $data->toArray();
            $source = $data['source'];
            $data['pdf'] = [];
            $data['photos'] = [];
            if (!empty($source)) {
                foreach ($source as $v) {
                    if ($v['type'] === 2) {
                        array_push($data['pdf'], $v);
                    } else if ($v['type'] === 1) {
                        array_push($data['photos'], $v);
                    }
                }
            }
            unset($data['source']);
        }
        return $data;
    }

    public function apiGet($data)
    {
        $data = $this->get($data);
        if (!empty($data['contacts'])) {
            foreach ($data['contacts'] as &$contact) {
                if (empty($contact['avatar'])) {
                    $contact['avatar'] = '/default.png';
                }
            }
        }
        return $data;
    }

    public function update($data)
    {
        Db::startTrans();
        $id = $data['id'];
        $this->getModel()->allowField('name,continent,address,business,square_meter,introduce')->save($data, ['id' => $id]);
        $this->setSourceAndContacts($id, $data);
        Db::commit();
        return $id;
    }

    protected function setSourceAndContacts($id, $data)
    {
        $source = new DepotSource();
        $source->saveSource($id, 1, $data['photos']);
        $source->saveSource($id, 2, $data['pdf']);
        $contacts = new DepotContacts();
        $contacts->saveContacts($id, $data['contacts']);
    }

    public function create($data)
    {
        Db::startTrans();
        $this->getModel()->allowField('name,continent,address,business,square_meter,introduce')->save($data);
        $id = $this->getModel()->id;
        $this->setSourceAndContacts($id, $data);
        Db::commit();
        return $id;
    }

    public function delete($data)
    {
        $num = 0;
        foreach (explode(',', $data['id']) as $id) {
            $result = $this->getModel()->where(['id' => $id])->find();
            if ($result) {
                $result->delete();
                DepotSource::where('depot_id', $id)->delete();
                DepotContacts::where('depot_id', $id)->delete();
                $num++;
            }
        }
        return $num;
    }

    public function deleteSource($uid)
    {
        return DepotSource::where('uid', $uid)->delete();
    }

    public function deleteContact($id)
    {
        return DepotContacts::where('id', $id)->delete();
    }
}