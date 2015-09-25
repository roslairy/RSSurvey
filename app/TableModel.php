<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableModel extends Model
{
    //默认绑定数据表
    protected  $table='NewData';
    public $timestamps = false;
   
}
