@extends('layouts.main')

@section('content')
 

  <div class="card">
    <div class="card-header">Welcome to your Dashboard</div>
    <div class="card-body">



      @if (auth()->user()->client->product_purchase_session[0]->status=='pending')
          <div class="alert alert-fill alert-danger alert-icon bg-danger mb-0">
              <a href="{{route('client.my_profile')}}#details_card" style="text-decoration:none;"> 
                 <i class="icon fas fa-exclamation-triangle"></i> You've got {{count(auth()->user()->client->product_purchase_session)}} purchase request pending approval, click here to view </a>
          </div> 
      @endif


    </div>
  </div>

       

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row"> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$no_purchase_sesions}}<sup style="font-size: 20px"></sup></h3>

                <p>Purchase Sessions</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="{{route('client.my_profile')}}#details_card" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$no_transactions}}</h3>

                <p>Transactions</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="{{route('client.my_profile')}}#details_card" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$no_activities}}</h3>

                <p>Activities</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-options"></i>
              </div>
              <a href="JavaScript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
 
@endsection
