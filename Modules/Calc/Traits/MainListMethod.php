<?php
namespace Modules\Calc\Traits;

use Illuminate\Http\Request;

trait MainListMethod  {
    public function index(Request $request) {
		
	
        return view('calc::index');
    

	
    }
}

