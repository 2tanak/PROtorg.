<?php
namespace Modules\Entity\Model\News;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;

class Home extends ModelParent {
    protected $table = 'news';
	
	
    protected $fillable = ['name','title','description','anons'];
	
    protected $filter_class = Filter::class; 
    use Presenter,CheckTrans;
    
    function relCity(){
        return $this->belongsTo('Modules\Entity\Model\LibCity\LibCity', 'city_id');
    }
	
	 function relInforms(){
        return $this->HasOne('Modules\Entity\Model\Informs\Informs', 'gid_id');
    }
	
	function relApplication(){
        return $this->hasOne('Modules\Entity\Model\Calendar\Application\Application', 'gallery_id','id');
    }
	
  function relTrans(){
        return $this->hasOne('Modules\Entity\Model\News\Trans', 'el_id');
    }
	
 function relEditedUser(){
        return $this->belongsTo('App\User', 'edited_user_id');
    } 
	
	   function getTransTableNameAttribute(){
        return $this->getTable();
    }
	  function getElIdAttribute(){
        return $this->id;
    }
/*
 function relTrans(){
        return $this->hasOne('Modules\Entity\Model\Gallery\TransGallery', 'el_id');
    }
*/
   

  
    


  
}
