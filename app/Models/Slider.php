<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // 1. Khai báo tên bảng (quan trọng)
    protected $table = 'slider';

    // 2. Khai báo khóa chính là RowID (vì mặc định Laravel tìm id)
    protected $primaryKey = 'RowID';

    // 3. Các cột được phép thêm/sửa
    protected $fillable = [
        'Name', 'Images', 'Sort', 'Status'
    ];
}