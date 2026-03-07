<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table      = 'm_level';
    protected $primaryKey = 'level_id';

    protected $fillable = ['level_kode', 'level_nama'];

    // Relasi: satu level memiliki banyak user
    public function user()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}