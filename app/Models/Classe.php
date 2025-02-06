<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
       //indicar o nome da tabela
       protected $table = 'classes';

       //indicar quais colunas podem ser preenchidas
       protected $fillable = ['name', 'description', 'order_classe', 'course_id', ];
       
       //Criar relacionamento entre um e muitos 
       public function course()
       {
        return $this->belongsTo(Course::class);
       }
}
