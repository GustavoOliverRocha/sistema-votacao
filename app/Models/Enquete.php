<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    use HasFactory;
    protected $table = "enquete";
    protected $fillable = ['titulo','start_date','end_date'];
    
    public function opcoes(){
        return $this->hasMany(Opcao::class);
    }
}
