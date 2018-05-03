<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/4/2
 * Time: 22:29
 */

namespace app\admin\page;

class BasePage
{
    protected $page = 1;
    protected $pageSize = 10;
    protected $order = null;
    protected $search = [];

    public function init($data)
    {
        return $this;
    }

    public function setOrder($data)
    {
        return $this->search;
    }

    public function setSearch($data)
    {
        return $this->order;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getSearch()
    {
        return $this->search;
    }
}