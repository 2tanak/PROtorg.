<?php
namespace Modules\Entity\Model\News;

use Modules\Entity\ModelParent;
use Modules\Entity\Traits\CheckTrans;

class Trans extends ModelParent {
    protected $table = 'trans_news';
	 protected $table_ru = 'news';
    protected $fillable = ['el_id', 'lang', 'description','name','anons','title'];
    //use CheckTrans;

    function getTransTableNameAttribute(){
        return 'galleries';
    }

    function getTransFiledsAttribute(){
       return  ['signature'];
    }
    
}
