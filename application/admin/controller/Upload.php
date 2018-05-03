<?php
/**
 * Created by PhpStorm.
 * User: feida
 * Date: 2018/3/27
 * Time: 23:32
 */

namespace app\admin\controller;

use app\common\exception\AdminException;
use think\File;
use think\Image;

class Upload
{

    /**
     * @powerlevel   1,2,3  @powerlevel
     * @return array
     */
    public function upload($type = null)
    {
        $image = ['size' => 614400, 'ext' => ['gif', 'jpg', 'jpeg', 'png']];
        if ($type == 'pdf') {
            $validata = ['size' => 52428800, 'ext' => 'pdf'];
        } else {
            $validata = $image;
        }
        $file = request()->file('file');
        if ($file instanceof File) {
            $fileSize = $file->getSize();
            $filename = $file->getInfo('name');
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->validate($validata)->move(UPLOAD_DIR);
            if ($info) {
                $path = $info->getSaveName();
                $ext = $info->getExtension();
                if (in_array($ext, $image['ext'])) {  //生成缩略图
                    $origin_path = getFilePath($path);
                    $thumbnail_path = getThumbnailFilePath($path);
                    $dir = UPLOAD_DIR . '/' . dirname($thumbnail_path);
                    if (!is_dir($dir)) {
                        mkdir($dir);
                    }
                    $image = Image::open($origin_path);
                    $image->thumb(200, 200, Image::THUMB_SCALING)->save(UPLOAD_DIR . '/' . $thumbnail_path);
                    return json([
                        'path'          => $thumbnail_path,
                        'original_path' => $path,
                        'name'          => $filename,
                        'size'          => $fileSize,
                    ]);
                } else {
                    return json([
                        'path'          => $path,
                        'name'          => $filename,
                        'size'          => $fileSize,
                        'original_path' => '',
                    ]);
                }
            } else {
                // 上传失败获取错误信息
                throw new AdminException(400, $file->getError());
            }
        } else {
            throw new AdminException(400, '没有选择任何文件');
        }
    }

    /**
     * @powerlevel   1,2  @powerlevel
     * @return array
     */
    public function delete($path = null)
    {
        deleteFile($path);
        return json()->code(204);
    }
}