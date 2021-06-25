<?php 
namespace Modules\Entity\Model\News;


use Illuminate\Http\Request;
//use Modules\Entity\Model\LibRequirement\LibRequirement;

use Cache;

trait Presenter {
	
 
   
	function getCityAr(){
		return LibCity::pluck('name', 'id')->toArray();

    }
	


function getPublishIndexAttribute($v){
	 return array_search($this->publish,['черновик'=>1,'активно'=>2]);
    }
	
	function getNameAttribute($v){
		return $this->getTransField('name', $v);
	  }
	
	function getDescriptionAttribute($v){
		return $this->getTransField('description', $v);
	  }
	  
	function getAnonsAttribute($v){
		return $this->getTransField('anons', $v);
	  }
	  
	
	


		  
		}
		


