<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:35
 */

namespace app\admin\service;

use app\admin\page\BasePage;
use think\Model;

class BaseService
{
    protected $model = Model::class;
    protected $modelInstance = null;

    /**
     * @return Model
     */
    protected function getModel()
    {
        if ($this->modelInstance === null) {
            $this->modelInstance = new $this->model;
        }
        return $this->modelInstance;
    }

    public function set($data, $value = null)
    {
        if (is_string($data)) {
            if (property_exists($this, $data)) {
                $this->{$data} = $value;
            }
        }
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $val;
                }
            }
        }
        return $this;
    }
}