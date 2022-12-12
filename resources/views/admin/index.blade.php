@php
if ( Config::get('app.locale') == 'ar'){
    $master = 'admin.master.masterar';
}else {
    $master = 'admin.master.master';
}
@endphp
@extends('admin.master.masterar')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $new->count() }}</h3>

            <p>طلبات جديدة</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.order.index.new') }}" class="small-box-footer">كل الطلبات الجديدة <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $delivered->count() }}</h3>

            <p>طلبات منتهية</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{ route('admin.order.index.delivered') }}" class="small-box-footer">كل الطلبات المنتهية<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $users->count() }}</h3>

            <p>المستخدمين</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ route('admin.user.index') }}" class="small-box-footer">كل المستخدمين <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $products->count() }}</h3>

            <p>المنتجات</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{ route('admin.product.index') }}" class="small-box-footer">كل المنتجات <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $categories->count() }}</h3>

                  <p> الاقسام</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">كل الاقسام<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $cleanings->count() }}</h3>

                  <p>طرق التنظيف</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('admin.cleaning.index') }}" class="small-box-footer">كل طرق التنظيف<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->

          </div>
          <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->


  @endsection
