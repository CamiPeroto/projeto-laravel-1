<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;



class Course extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;
    use SoftDeletes;
    
    //indicar o nome da tabela
    protected $table = 'courses';

    //indicar quais colunas podem ser preenchidas
    protected $fillable = ['name', 'price'];

    //Criar relacionamento entre um e muitos 
    public function classe()
    {
        return $this->hasMany(Classe::class);
    }
}
