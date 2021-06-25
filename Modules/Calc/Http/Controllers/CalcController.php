<?php

namespace Modules\Calc\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

use Modules\Calc\Traits\MainCrudMethod;

use Modules\Entity\Actions\Calc\CalcSaveAction as ModelCreateAction;

use Modules\Entity\Model\Calc\Calc as Model;

class CalcController extends Controller {
    use MainCrudMethod;
    protected $action_create = ModelCreateAction::class;
	protected $def_model = Model::class;

    //protected $action_update = ModelUpdateAction::class;
	
	
	
	
	 protected function validator(array $data)
    {
		//nullable
	$messages = [
      'oklad.required' => 'поле обязательно к заполнею',
	  'oklad.numeric' => 'значение должно быть числом',
	  'mount_norma.required' => 'поле обязательно к заполнею',
	  'mount_norma.numeric' => 'значение должно быть числом',
	  'mount_orabotka.required' => 'поле обязательно к заполнею',
	  'mount_orabotka.numeric' => 'значение должно быть числом',
	  'mzp.required' => 'поле обязательно к заполнею',
	  'mzp.not_in' => 'поле обязательно к заполнею',
	  'year.required' => 'поле обязательно к заполнею',
	  'year.numeric' => 'значение должно быть числом',
	  'calendar_month.required' => 'поле обязательно к заполнею',
	  'calendar_month.numeric' => 'значение должно быть числом',
	  'pensioner.required' => 'поле обязательно к заполнею',
	  'pensioner.not_in' => 'поле обязательно к заполнею',
	  'invalid.required' => 'поле обязательно к заполнею',
	  
     ];
        return \Validator::make($data, [
		 'oklad' => 'required|numeric',
         'mount_norma' => 'required|numeric',
	     'mount_orabotka' => 'required|numeric',
	     'mzp' => 'required|not_in:0',
	     'year'=>'required|numeric',
		 'calendar_month'=>'required|numeric',
		 'pensioner'=>'required|not_in:0',
		 'invalid'=>'required',
		 'mount_orabotka'=>'required',
        ],$messages);
    }
	
	
	
	
	
	
	
	
	
	
	
	
}
