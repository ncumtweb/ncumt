<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

trait ImageTrait
{
    /**
     * 存儲並優化圖片
     *
     * @param UploadedFile $file
     * @param string $folder_name
     * @param string $name
     * @return string 儲存圖片的路徑
     */
    public function storeImage(UploadedFile $file, string $folder_name, string $name): string
    {
        $upload_path = public_path() . '/' . $folder_name;
        $extension = $file->extension();
        $filename = $name . time() . '.' . $extension;

        // 確保文件夾存在
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $file->move($upload_path, $filename);

        // 優化圖片
        ImageOptimizer::optimize($upload_path . '/' . $filename);

        return $folder_name . '/' . $filename;
    }
}
