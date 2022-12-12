@extends('admin.master.masterar')
@section('name')
الاقسام
@endsection
@section('content')

<div class="row">

    <!-- right column -->
    <div class="col-md-12">
      <!-- general form elements disabled -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title" style="float: right;">اضافة قسم</h3>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- /.card-header -->
        <div class="card-body">
          <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.category.update') }}">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <input type="hidden"  value="{{ $category->id }}" name="id" id="">
                <!-- text input -->
                <div class="form-group">
                  <label>الاسم العربي</label>
                  <input type="text" class="form-control" value="{{ $category->name_ar }}" name="name_ar" placeholder="Enter ...">
                </div>
              </div>
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>الاسم الانجليزي</label>
                  <input type="text" class="form-control" value="{{ $category->name_en }}" name="name_en" placeholder="Enter ...">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                  <label>الوصف العربي</label>
                  <textarea class="form-control"  name="des_ar" rows="3" placeholder="Enter ...">{{ $category->des_ar }}</textarea>
                </div>
              </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>الوصف الانجليزي</label>
                    <textarea class="form-control" name="des_en" rows="3" placeholder="Enter ...">{{ $category->des_en }}</textarea>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>الصورة</label>
                    <input type="file" id="img" class="form-control" name="img" placeholder="Enter ...">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <img class="" width="100px" height="100px" id="showimage" src="{{  (!empty($category->img)) ? url($category->img) : url('upload/no_image.jpg')  }}" alt="">

                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">

                    <input id="showimage" type="submit" class="btn btn-info" name="" value="تعديل القسم" placeholder="Enter ...">
                  </div>
                </div>

              </div>



            <!-- end row -->





          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
  <br>
  <br>
  <br>
  <br>
@endsection
@section('script')
<script>

    $(document).ready(function(){

        $('#img').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showimage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);

        });

    });
</script>
@endsection
