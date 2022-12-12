@extends('admin.master.masterar')
@section('name')
الشروط والاجكام
@endsection
@section('content')

<div class="row">

    <!-- right column -->
    <div class="col-md-12">
      <!-- general form elements disabled -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title" style="float: right;">تعديل الشروط والاجكام</h3>
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
          <form enctype="multipart/form-data" role="form" method="POST" action="{{ route('admin.rule.update') }}">
            @csrf

            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label> سياسة الاستلام عربي</label>
                  <textarea class="form-control"  name="deliver_policy_ar" rows="3" placeholder="Enter ...">{{ $data->deliver_policy_ar }}</textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                    <label> سياسة الاستلام انجليزي</label>
                  <textarea class="form-control"  name="deliver_policy_en" rows="3" placeholder="Enter ...">{{ $data->deliver_policy_en }}</textarea>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                    <label> سياسة الاسترجاع عربي</label>
                  <textarea class="form-control"  name="return_policy_ar" rows="3" placeholder="Enter ...">{{ $data->return_policy_ar }}</textarea>
                </div>
              </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label> سياسة الاسترجاع انجليزي</label>
                    <textarea class="form-control"  name="return_policy_en" rows="3" placeholder="Enter ...">{{ $data->return_policy_en }}</textarea>
                  </div>
                </div>


              </div>


              <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">

                    <input type="submit" class="btn btn-info" name="" value="تعديل الشروط و الاحكام" placeholder="Enter ...">
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
