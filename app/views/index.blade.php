@extends('layouts/main')

@section('title')
Online Procurement Tracking System
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Subscribers Portal
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" >
                        
                          <br>

                        <p>  The Iron Bank Online Portal is the premiere system that facilitates the management of your bank account. It provides you access to your account in the comforts of your own home, it allows fast processing of your transactions in both online and onsite and it keeps your banking data secure. This is all because we want to be serve you. Here in the Iron Bank, we make the best happen and we find ways.
                        </p>
     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Accounts Offered
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" >
                       
                          <br>

                        <p>  We offer savings and time deposit account services. To register follow the following steps:
                          <br>
                          1. Register online - <a href="/register">click here</a>
                          <br>
                          2. Go to our nearest branch and bring two government issued IDs.
                          <br>
                          3. Retrieve you ATM card from our branch by depositing the initial deposit.
                          <br>
                          4. Go to an ATM machine and change you pincode.
                          <br>
                          5. Enjoy using our services.
                        </p>
     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
@stop