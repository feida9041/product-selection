<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:32
 */

namespace app\common\controller;

use think\Controller;

abstract class AdminController extends Controller
{
    protected $batchValidate = true;
    protected $failException = true;
}