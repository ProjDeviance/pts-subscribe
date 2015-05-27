
@extends('layouts.main')

@section('title')
    Subscribers Management
@stop

@section('main')


<div class="row">
     @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Edit Subscriber
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      <div class="form-group @if ($errors->has('firstname')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Firstname</label>
            <div class="col-sm-10">
                {{ Form::text('firstname', $subscriber->firstname, array('class' => 'form-control', 'placeholder' => 'First Name','maxlength'=>'255')) }}
       
                @if ($errors->has('firstname')) 
                    <p class="help-block">{{ $errors->first('firstname') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
                 <br><br>
        <div class="form-group @if ($errors->has('lastname')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
                {{ Form::text('lastname', $subscriber->lastname, array('class' => 'form-control  ', 'placeholder' => 'Lastname','maxlength'=>'255')) }}
  
            @if ($errors->has('lastname')) 
                <p class="help-block">{{ $errors->first('lastname') }}</p>  
            @endif
        </div>
        </div>
        <br><br>
        
       <div class="form-group @if ($errors->has('municipality')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Municipality</label>
            <div class="col-sm-10">
                {{ Form::text('municipality', $subscriber->municipality, array('class' => 'form-control  ', 'placeholder' => 'Municipality/City','maxlength'=>'255')) }}
  
            @if ($errors->has('municipality')) 
                <p class="help-block">{{ $errors->first('municipality') }}</p>  
            @endif
        </div>
        </div>
        <br><br>
       
        <br><br>
        <div class="form-group @if ($errors->has('subscription_type')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Subscription Type</label>
            <div class="col-sm-10">
         <select name="subscription_type" class="form-control">
            
                <option value="0" @if($subscriber->rank==0) selected @endif >Basic</option>
             
                <option value="1" @if($subscriber->rank==1) selected @endif >Premium</option>
            </select>
                @if ($errors->has('subscription_type')) 
                    <p class="help-block">{{ $errors->first('subscription_type') }}</p> 
                @endif
        </div>
    </div>
    <br>
    <br>
                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$subscriber->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/subscribers" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
