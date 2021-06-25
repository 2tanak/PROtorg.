@extends('calc::layouts.master')

@section('content')
    <style>
	.clearfix {
	clear: both;
}
	</style>
	
	<!-- Button trigger modal -->
	<!----
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Запустить модальное окно
</button>
------>
<div class="container">
<br><br>
@if (session('otvet'))
 <div class="row">
  <div class='col-md-6'>
    <div class="alert alert-success">
	   @php
	     $arr =['нет','1-группа','2-группа','3-группа'];
	   @endphp
      <p>Оклад - {{session('otvet')['oklad']}} тенге</p>
	  <p>Норма дней в месяц - {{session('otvet')['mount_norma']}}</p>
	  <p>Отработанное количество дней  - {{session('otvet')['mount_orabotka']}}</p>
	  <p>Имеется ли налоговый вычет 1 МЗП  - {{session('otvet')['mzp'] == 1 ? 'да' : 'нет'}}</p> 
	  <p>Календарный год  - {{session('otvet')['year']}}</p>
	  <p>Календарный месяц  - {{session('otvet')['calendar_month']}}</p>
	  <p>Является ли сотрудник пенсионером  - {{session('otvet')['pensioner'] == 1 ? 'да' : 'нет'}}</p>
      <p>Является ли сотрудник инвалидом  - {{ $arr[session('otvet')['invalid']] }}</p>
	   

    </div>
	</div>
	<div class='col-md-6'>
    <div class="alert alert-success">
	
	@if(session('active_nalog'))
	@php
	echo '<p>Оклад - '.session('active_nalog')['oklad'].'</p>';
	
	     switch(session('active_nalog')['massiv']){
			 
			 
			 case 'pensioner':{
				 echo 'пенсионер';
				  
				 break;
			 }
			 
			 case 'pensioner_invalid':{
				 echo 'Инвалид и пенсионер';
				   echo '<p>не облагается налогом</p>';
				 break;
			 }
			 
			 case 'invalid_1_2':{
				 echo 'Инвалид 1 или 2 группы';
				 if(isset(session('active_nalog')['ipn'])){
					 echo '<p>, зарплата превысила 882мрп</p>';
				 }
				 break;
			 }
			 
			 case 'invalid_3':{
				 echo '<p>Инвалид 3 группы</p>';
				 if(isset(session('active_nalog')['ipn'])){
					 echo '<p>, зарплата превысила 882мрп</p>';
				 }
				 break;
			 }
			 default:{
				 $zp_25mrp = 2917 * 25; //25mrp 72925
				 if($zp_25mrp > session('active_nalog')['oklad']){
					 echo '<p>зарплата меньше 25мрп + (90%ипн)</p>';
				 }

				
				 break;
			 }
			 
		 }
	  @endphp
	  
	  @foreach(session('active_nalog') as $key=>$value)
	  
	  <p>{{$key == 'opv' ? $value.' пенсионые отчисления ОПВ' :''}}</p>
	  <p>{{$key == 'vocmc' ? $value.' медицинское страхование ВОСМС' :''}}</p>
	  <p>{{$key == 'ipn' ? $value.' подоходный налог ИПН' :''}}</p>
	  <p>{{$key == 'co' ? $value.' социальные отчисления CO' :''}}</p>
	  
	  

	  <p>{{$key == 'zp' && count(session('active_nalog')) !=1 ? $value.' зарплата на руки' :''}}</p>

	 
	  @endforeach
     @endif

    </div>
	</div>
	
	</div>
@endif
   <form action="{{ route('calc_save') }}" method="post">

  <div class="form-group">
  <div class="row">
  <div class='col-md-6'>
 <div class="form-group">
    <label for="exampleInputEmail1">Оклад в тенге</label>
    <input type="number"
	class="form-control" 
	name='oklad' 
	value="{{old('oklad') ? old('oklad') : ''}}"
	placeholder="Оклад в тенге">
	@if ($errors->has('oklad'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('oklad') }}</strong>
   </span>
    @endif
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Норма дней в месяц</label>
    <input type="number" 
	name='mount_norma' 
	value="{{old('mount_norma') ? old('mount_norma') : 22}}"
	class="form-control" 
	placeholder="Норма дней в месяц">
	@if ($errors->has('mount_norma'))
  <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('mount_norma') }}</strong>
   </span>
    @endif
	
  </div>
  </div>
  
  <div class='col-md-6'>
  <div class="form-group">
    <label for="exampleInputPassword1">Отработанное количество дней</label>
    <input type="number" 
	name='mount_orabotka' 
	value="{{old('mount_orabotka') ? old('mount_orabotka') : 22}}"
	class="form-control" 
	placeholder="Отработанное количество дней">
	@if ($errors->has('mount_orabotka'))
    <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('mount_orabotka') }}</strong>
   </span>
    @endif
	
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlSelect1">Имеется ли налоговый вычет 1 МЗП</label>
    <select name="mzp" class="form-control" id="exampleFormControlSelect1">
	 <option value="0" >не выбрано</option>
      <option {{old('mzp') == 1 ? 'selected' : ''}}  value="1" >да</option>
      <option  {{old('mzp') == 2 ? 'selected' : ''}} value="2" >нет</option>
  </select>
  @if ($errors->has('mzp'))
    <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('mzp') }}</strong>
   </span>
    @endif
  </div>
  <div class='clearfix'></div>
<br><br><br>
 </div>


 <div class='col-md-6'>
   <div class="form-group">
    <label for="exampleInputPassword1">Календарный год</label>
    <input type="number" name='year' value="{{old('year') ? old('year') : 365}}"
	class="form-control" placeholder="Календарный год">
	@if ($errors->has('year'))
    <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('year') }}</strong>
   </span>
    @endif
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Календарный месяц</label>
    <input type="number" name='calendar_month' 
	value="{{old('calendar_month') ? old('calendar_month') : 30}}"
	class="form-control" placeholder="Календарный месяц">
	@if ($errors->has('calendar_month'))
    <span class="calendar_month">
     <strong style='color:#a94442'>{{ $errors->first('calendar_month') }}</strong>
   </span>
    @endif
  </div>
  </div>
  <div class='col-md-6'>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Является ли сотрудник пенсионером</label>
    <select name="pensioner" class="form-control" id="exampleFormControlSelect1">
	 <option value="0" >не выбрано</option>
      <option {{old('mzp') == 1 ? 'selected' : ''}} value="1" >да</option>
      <option {{old('mzp') == 2 ? 'selected' : 'selected'}}  value="2" >нет</option>
  </select>
  	@if ($errors->has('pensioner'))
    <span class="calendar_month">
     <strong style='color:#a94442'>{{ $errors->first('pensioner') }}</strong>
   </span>
    @endif
  </div>
  
    <div class="form-group">
    <label for="exampleFormControlSelect1">Является ли сотрудник инвалидом, если да то какой группы.</label>
    <select name="invalid" class="form-control" id="exampleFormControlSelect1">
	 <option value="0" {{old('mzp') == 0 ? 'selected' : 'selected'}}>нет</option>
      <option {{old('mzp') == 1 ? 'selected' : ''}} value="1" >1-группа</option>
      <option {{old('mzp') == 2 ? 'selected' : ''}}  value="2" >2-группа</option>
	  <option  {{old('mzp') == 3 ? 'selected' : ''}} value="3" >3-группа</option>
  </select>
  @if ($errors->has('invalid'))
    <span class="help-block">
     <strong style='color:#a94442'>{{ $errors->first('invalid') }}</strong>
   </span>
    @endif
  </div>
  </div>
 <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class='col-md-12'>
  <button type="submit" class="btn btn-primary">ОТПРАВИТЬ</button>
  </div>
  <br><br>
   </div>
  </div>
  </div>
</form>

@endsection
