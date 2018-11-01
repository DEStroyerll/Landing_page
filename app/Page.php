<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //В свойстве $fillable предоставляем доступ для заполнения определенных полей.
    protected $fillable = ['name', 'alias', 'text', 'images'];
}
