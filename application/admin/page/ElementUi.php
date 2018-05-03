<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/31
 * Time: 14:46
 */

namespace app\admin\page;

class ElementUi extends BasePage
{
    public function init($data)
    {
        $this->page = isset($data['page']) ? $data['page'] : $this->page;
        $this->pageSize = isset($data['pageSize']) ? $data['pageSize'] : $this->pageSize;
        $this->order = $this->setOrder($data);
        $this->search = $this->setSearch($data);
        return $this;
    }

    public function setOrder($data)
    {
        if (!isset($data['order']) || !isset($data['sort']) || !$data['sort'] || !$data['order']) {
            return null;
        }
        $sort = $data['sort'] == 'descending' ? 'desc' : 'asc';
        return $data['order'] . ' ' . $sort;
    }

    public function setSearch($data)
    {
        if (!isset($data['search'])) {
            return [];
        }
        foreach ($data['search'] as $key => $val) {
            if ($val === '') {
                unset($data['search'][$key]);
            }
        }
        return $data['search'];
    }
}