<?php
namespace Modules\Entity\Actions\Calc;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;


class CalcSaveAction {
    private $model = false;
    private $request = false;

    function __construct(Model $model, Request $request){
        $this->model = $model; 
        $this->request = $request; 
    }

    function run(){
        $this->saveMain();
		
       
    }

    private function saveMain(){
        $ar = $this->request->all();
		
        $this->model->fill($ar);
        $this->model->save();
    }


 



}