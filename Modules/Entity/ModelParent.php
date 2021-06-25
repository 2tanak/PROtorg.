<?php
namespace Modules\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Modules\Entity\Traits\DateHelper;
//use Modules\Entity\Traits\FilterModel;
//use Modules\Entity\Traits\RoleModel;
//use Modules\Entity\Traits\ChangeModel;

//use Modules\Entity\Traits\LabelModel;
use Route;
//use App\Helper\CurrentLang;
use Cache;
class ModelParent extends Model {
    //use  FilterModel;
    protected $lang = false;
    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
		
       // $this->lang = CurrentLang::url();
		
    }

  

    protected function getTransField($field, $v){
		
    }

    function getTitleAttribute(){
        return $this->getTable();
    }

}
