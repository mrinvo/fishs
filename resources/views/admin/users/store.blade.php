@extends('admin.master.masterar')
@section('name')
المنتجات
@endsection
@section('content')

<div class="row">

    <!-- right column -->
    <div class="col-md-12">
      <!-- general form elements disabled -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title" style="float: right;">اضافة منتج</h3>
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
          <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.product.store') }}">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>الاسم العربي</label>
                  <input type="text" class="form-control" name="name_ar" placeholder="Enter ...">
                </div>
              </div>
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>الاسم الانجليزي</label>
                  <input type="text" class="form-control" name="name_en" placeholder="Enter ...">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                  <label>الوصف العربي</label>
                  <textarea class="form-control" name="description_ar" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>الوصف الانجليزي</label>
                    <textarea class="form-control" name="description_en" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>


              </div>

              <div class="row">
                <div class="col-sm-4">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>السعر</label>
                    <input type="number" class="form-control" name="price" placeholder="Enter ...">
                  </div>
                </div>
                <div style="display: flex; align-items:end;" class="col-sm-4">

                    <div class="form-group">
                        <div  class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="show" value="1" name="have_discount">
                          <label for="show" class="custom-control-label">تخفيض</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="hide" value="0" name="have_discount" checked>
                          <label for="hide" class="custom-control-label">بدون تخفيض</label>
                        </div>

                      </div>

                  </div>

                  <div style="display: none" id="box" class="col-sm-4">
                    <!-- textarea -->
                    <div class="form-group">
                      <label> السعر المخفض</label>
                      <input type="number" class="form-control" name="discounted_price" placeholder="Enter ...">
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

                    <input type="submit" class="btn btn-info" name="" value="اضف منتج" placeholder="Enter ...">
                  </div>
                </div>

              </div>






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
    const box = document.getElementById('box');

function handleRadioClick() {
  if (document.getElementById('show').checked) {
    box.style.display = 'block';
  } else {
    box.style.display = 'none';
  }
}

const radioButtons = document.querySelectorAll('input[name="have_discount"]');
radioButtons.forEach(radio => {
  radio.addEventListener('click', handleRadioClick);
});

</script>
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
