@extends('layouts.app')
@section('title','Photo Gallery')

@section('content')

<button id="addNewPhotobtn" class="btn btn-primary mt-3 ml-5">Add New</button>

<div class="container-fluid">
    <div class="row photoRow">
      
    </div>
</div>

<!--add new photo modal-->
<div class="modal fade" id="addNewPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Your image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="imgInput" type="file">
        <img class="previewImg mt-2" id="imgPreview" src="{{asset('images/default-image.png')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
        <button id="savePhoto" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>













@endsection



@section('script')
<script type="text/javascript">
//add new service
$('#addNewPhotobtn').click(function () {
    $('#addNewPhoto').modal('show');

})

$('#imgInput').change(function () {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload=function (event) {
        var imgSrc = event.target.result;
        $('#imgPreview').attr('src',imgSrc)
    }
})

$('#savePhoto').on('click',function (){
    var photoFile = $('#imgInput').prop('files')[0];
    var formData = new FormData();
    formData.append('photo',photoFile);
    $('#savePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post("/photoUpload",formData).then(function (response) {
        $('#savePhoto').html("Save");
          if (response.status == 200) {
            if (response.data == 1) {
              $('#addNewPhoto').modal('hide');
              toastr.success('Photo Uploded Success.');
            } else {
              $('#addNewPhoto').modal('hide');
              toastr.error('Photo Upload fail.');
            }
          } else {
            $('#addNewPhoto').modal('hide');
              toastr.error('Photo Upload fail.');
          }
    }).catch(function (error){
        $('#addNewPhoto').modal('hide');
        toastr.error('Photo Upload fail.');
    })
})

loadPhoto();
function loadPhoto(){
    axios.get('/photoJSON').then(function (response){
        $.each(response.data,function (i,item) {
            $(" <div class='col-md-3'>").html(
                "<img class='imgOnRow p-1' src="+item['location']+">"
            ).appendTo('.photoRow')
        })
    }).catch(function (error){
       
    })
}

</script>
@endsection