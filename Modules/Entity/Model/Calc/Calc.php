<?php

namespace Modules\Entity\Model\Calc;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Modules\Entity\ModelParent;

//use Modules\Entity\Traits\CheckTrans;

class Calc extends ModelParent
{
	public $table = 'calc';
     use HasFactory;
     protected $fillable = ['opv','ipn','zp','vocmc','ocmc','co'];
     
    //protected $filter_class = Filter::class; 
    
    
}
