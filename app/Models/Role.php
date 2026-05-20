<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit (opsional tapi disarankan)
    protected $table = 'roles';

    // Mendefinisikan kolom mana saja yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama_role',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}