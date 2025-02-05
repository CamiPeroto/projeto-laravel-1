<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
       //indicar o nome da tabela
       protected $table = 'classes';

       //indicar quais colunas podem ser preenchidas
       protected $fillable = ['name', 'description', 'course_id'];
}
