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

                        <p>  The Online Procurement Tracking System facilitates the procurement processes for the municipal level of government in the Philippines. It contain the following features:
                        
                        (Basic)
                        -Users Management
                        -Office Management
                        -Designation Management
                        -Workflow Management
                        -Purchase Request Management
                        -Tasks Flow Module
                        -Purchase Request Search 

                        (Premium)
                        -Report Generator Module 
                        -Document Attachment Support
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
                    Plans Offered
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" >
                       
                          <br>

                        <p>  We offer basic and premium plans. To register follow the following steps:
                          <br>
                          1. Register online - <a href="/register">click here</a>
                          <br>
                          2. Deposit to account no 93183191414 the amount specified.
                          <br>
                          3. Email us at pts@gmail.com the reference code of your deposit transaction.
                          <br>
                          4. Await our confirmation.
                          <br>
                          5. Login to the PTS using your registered credentials.
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