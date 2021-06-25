<?php
namespace Modules\Calc\Traits;

use Illuminate\Http\Request;

use Session;

use Illuminate\Support\Facades\Validator;

trait MainCreateMethod
{
    public function saveCreate(Request $request)
    {
        try
        {
            $validator = $this->validator($request->all());
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)->withInput();
            };

            //dd(144);
            $arr = ['нет', '1-группа', '2-группа', '3-группа'];
            $massiv = 'people';
			$active_nalog = [];
            $zp = $request->oklad;
            $zp_25mrp = 2917 * 25; //25mrp 72925
            $zp_882mrp = 2917 * 882; //882mrp2 572 794
            $mzp = 42500; //минимальная зароботная плата
			//dd($request->all());
            $pensioner = $request->pensioner == 1 ? true : false;
            if ($request->invalid)
            {
				
                $invalid = $arr[$request->invalid];

                if ($invalid == '1-группа' || $invalid == '2-группа')
                {
					
                    $massiv = 'invalid_1_2';
                }
                if ($invalid == '3-группа')
                {
                    $massiv = 'invalid_3';
                }
            }
			if ($pensioner)
            {
                $massiv = 'pensioner';
            }

            if ($request->invalid && $pensioner)
            {
			
                $massiv = 'pensioner_invalid';
            }


            //вычисление налогов
            //медицинское страхование
            $nalog_vocm = ($zp / 100) * 2;
            //пенсионные взносы
            $nalog_opv = ($zp / 100) * 10;
            //Социальные отчисления (СО)
            $nalog_co = ($zp - $nalog_opv) / 100 * 3.5;

            //Индивидуальный подоходный налог
            if ($request->mzp == 1)
            {
                $nalog_ipn = ($zp - ($nalog_opv + $nalog_vocm + $mzp)) / 100 * 10;
            }
            else
            {
                $nalog_ipn = ($zp - ($nalog_opv + $nalog_vocm)) / 100 * 10;
            }
            //если заработная плата меньше 25МРП
            if ($zp < $zp_25mrp)
            {
				
                if ($request->mzp == 1)
                {
                    $nalog_ipn = ($zp - ($nalog_opv + $nalog_vocm + $mzp)) / 100 * 90;
				
                }
                else
                {
                    $nalog_ipn = ($zp - ($nalog_opv + $nalog_vocm)) / 100 * 90;
                }
            }

            //вычисление заработной платы с учетом налогов
            switch ($massiv)
            {
                case 'pensioner':
                    {
                            //подоходный налог
                            $zp = $zp - $nalog_ipn;
							$active_nalog['ipn']=$nalog_ipn;
                        break;
                    }
                case 'pensioner_invalid':
                    {
						
                        //не облагается налогами
                        break;
                    }
                case 'invalid_1_2':
                    {
                        //Социальные отчисления
                        $zp = $zp - $nalog_co;
						$active_nalog['co']=$nalog_co;
                        if ($zp > $zp_882mrp)
                        {//если зарплата превышает 882mrp
                            //подоходный налог
                            $zp = $zp - $nalog_ipn;
							$active_nalog['ipn']=$nalog_ipn;
                        }
                        break;
                    }
                case 'invalid_3':
                    {
                        //пенсионные взносы
                        $zp = $zp - $nalog_opv;
						$active_nalog['opv']=$nalog_opv;
                        //размер зарплаты с учетом Социальные отчисления
                        $zp = $zp - $nalog_co;
						$active_nalog['co']=$nalog_co;
                        if ($zp > $zp_882mrp)
                        {//если зарплата превышает 882mrp
                            //подоходный налог
							$active_nalog['ipn']=$nalog_ipn;
                            $zp = $zp - $nalog_ipn;
                        }
                        break;
                    }
                default:
                    {
                        //размер зарплаты с учетом налогов
                        //зарплата после вычета пенсионные взносы
                        $zp = $zp - $nalog_opv;
						$active_nalog['opv']=$nalog_opv;
                        //зарплата после вычета медицинское страхование
                        $zp = $zp - $nalog_vocm;
						$active_nalog['vocmc']=$nalog_vocm;
                        //размер зарплаты с учетом подоходный налог
                        $zp = $zp - $nalog_ipn;
						$active_nalog['ipn']=$nalog_ipn;
                        //размер зарплаты с учетом Социальные отчисления
                        $zp = $zp - $nalog_co;
						$active_nalog['co']=$nalog_co;

                        break;
                    }
                }
                $active_nalog['massiv']=$massiv;
                $active_nalog['zp']=$zp;
				$active_nalog['oklad']=$request->oklad;

                $request
                    ->request
                    ->add($active_nalog);

                //сохранение в базе point-2
                $action = new $this->action_create(new $this->def_model() , $request);
                $action->run();
                return redirect()
                    ->back()
                    ->with(['otvet'=>$request->all(),'active_nalog'=>$active_nalog]);
            }
            catch(\Exception $e)
            {
                dd($e->getMessage());
                return redirect()
                    ->back()
                    ->with('error', $e->getMessage());
            }

            //dd($request->all());
            
        }
    }
    
