
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Subscribers Management
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Municipality</th>
                <th>Email</th>
                <th>Type</th>
                <th>Action </th>

            </tr>
        </thead>
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif

            @foreach($subscribers as $subscriber)


                <tr >
                    <td>{{ $subscriber->lastname.", ".$subscriber->firstname." "  }}</td>
                  
                    <td>{{$subscriber->municipality}} </td>
                    
                    <td>{{$subscriber->email }}</td>
                    <td>@if($subscriber->rank==0)
                        Basic
                        @elseif($subscriber->rank==1)
                        Premium
                        @endif
                    </td>
                    <td>
                        <a href="/admin/subscribers/edit/{{$subscriber->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                        @if($subscriber->status==1)
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $subscriber->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate">Deactivate</button>
                        @else
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="{{ '#activate_' . $subscriber->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate">Activate</button>
                        @endif
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $subscribers->links(); }}</center>

    </div>

   
</div>
</div>
</div>
</div>
</div>
    
  
    </div>







@stop

@section('dialogs')
@foreach($subscribers as $subscriber)
    <?php 
        $modalName = "deactivate";
        $message = "Are you sure you want to deactivate subscriber {$subscriber->firstname} {$subscriber->lastname} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $subscriber->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Deactivate</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/subscribers/deactivate/{{$subscriber->id}}" class="btn btn-warning" id="confirm">Deactivate </a>
                </div>
            </div>
        </div>
    </div>              

    <?php 
        $modalName = "activate";
        $message = "Are you sure you want to activate subscriber {$subscriber->firstname} {$subscriber->lastname} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $subscriber->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Activate</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/subscribers/activate/{{$subscriber->id}}" class="btn btn-success" id="confirm">Activate </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@stop