<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function getAdmin(){
        return self::havingRole('admin')
        ->first();
    }

    public function getID(){
        return $this->id;
    }

    public function scopeHavingRole($query,$slug)
    {
        $query->where('name',$slug);
    }

}
