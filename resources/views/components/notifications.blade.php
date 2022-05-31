@extends('layouts.main')

@section('content')
  

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1> <i class="fas fa-bullhorn"></i> My Notifications</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
    
    
      @php
          $notification_icon_array = array( 
          'new_purchase_reg' => 'fas fa-shopping-cart',
          'purchase_session_approved' => 'fas fa-legal',
          'new_client_web_reg' => 'ion ion-person-add',
          'new_client_agt_reg' => 'ion ion-person-add',
          );
      @endphp
    
    
      <!-- Main content -->
      <section class=""> 
            
            <div class="note_board bg-white"> <div class="dropdown-divider"></div>
                @foreach (auth()->user()->notification()->paginate(20)->sortDesc() as $notification)
                <a href="{{route('resolve_notification', ['id'=>$notification->id])}}" class="dropdown-item note_each">
                   <i class="{{$notification_icon_array[$notification->type]}}"></i> {!!$notification->message!!}
                  <span class="float-right text-muted text-sm"> {{$notification->created_at}} </span>
                </a> <div class="dropdown-divider"></div>
                @endforeach 
            </div>
        


            <div class="row">
                <div class="col-12">
                  {{ auth()->user()->notification()->paginate(20)->links() }} 
                </div>
            </div>
      </section>

 

 

@endsection
