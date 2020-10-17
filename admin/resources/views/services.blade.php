@extends('layouts.app')
@section('title','Services')

@section('content')







<button id="addNewbtn" class="btn btn-primary my-3 ml-5">Add New</button>

<div id="maindiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="service_table">


        </tbody>
      </table>

    </div>
  </div>
</div>
<div id="loaderdiv" class="container text-center">
  <div class="row">
    <div class="col-md-12 p-5">
      <img class="loader_img" src="{{asset('images/loader.svg')}}" alt="loader image">

    </div>
  </div>
</div>
<div id="wrongdiv" class="container text-center d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <h4>Something want wrong</h4>

    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this?</h5>
        <h6 id="serviceDeleteId" class="d-none"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
        <button id="serviceDeleteConfirmbtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5">
      <h6 id="serviceEditId" class="d-none"></h6>
      <h5 class="mb-4">Update Service</h5>
      <div id="serviceEditeForm" class="d-none">
        <input type="text" id="serviceNameId" class="form-control mb-4 d-block">
        <input type="text" id="serviceDesId" class="form-control mb-4 d-block">
        <input type="text" id="serviceImgId" class="form-control mb-4 d-block">
      </div>
      <img id="serviceEditLoader" class="serviceLoaderImg" src="{{asset('images/loader.svg')}}" alt="loader image">
      <h4 id="serviceEditwrong" class="d-none">Something want wrong</h4>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
        <button id="serviceUpdateConfirmbtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- add new service -->
<div class="modal fade" id="addNewServiceModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5">
      <h3>Add New Service</h3>
      <div id="serviceAddform" class="">
        <input type="text" id="serviceNameAddNew" class="form-control mb-4 d-block" placeholder="Add Service Name">
        <input type="text" id="serviceDesAddNew" class="form-control mb-4 d-block" placeholder="Add Service Description">
        <input type="text" id="serviceImgAddNew" class="form-control mb-4 d-block" placeholder="Add service img">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="serviceAddbtn" type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection



@section('script')
<script type="text/javascript">
  getServiceData();
  //for service page
  function getServiceData() {
    axios.get('/getServiceData')
      .then(function(response) {
        if (response.status == 200) {
          $('#maindiv').removeClass('d-none');
          $('#loaderdiv').addClass('d-none');
          $('#serviceDataTable').DataTable().destroy();
          $('#service_table').empty();
          var jasonData = response.data;
          $.each(jasonData, function(i, item) {
            $('<tr>').html(
              "<td class='th-sm'><img class='table-img' src=" + jasonData[i].service_img + "></td>" +
              "<td class='th-sm'>" + jasonData[i].service_name + "</td>" +
              "<td class='th-sm'>" + jasonData[i].service_des + "</td>" +
              "<td class='th-sm'><a class='serviceEditbtn' data-id=" + jasonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
              "<td class='th-sm'><a class='serviceDeletebtn' data-id=" + jasonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#service_table');
          });
          //service get delete id
          $('.serviceDeletebtn').click(function() {
            var id = $(this).data('id');
            $('#serviceDeleteId').html(id);
            $('#deleteModal').modal('show');

          })

          //service update edit details
          $('.serviceEditbtn').click(function() {
            var id = $(this).data('id');
            $('#serviceEditId').html(id);
            serviceUpdateDetails(id);
            $('#editModal').modal('show');

          })
          $('#serviceDataTable').DataTable({"order":false});
          $('.dataTables_length').addClass('bs-select');

        } else {
          $('#loaderdiv').addClass('d-none');
          $('#wrongdiv').removeClass('d-none');
        }

      })
      .catch(function(error) {
        $('#loaderdiv').addClass('d-none');
        $('#wrongdiv').removeClass('d-none');
      });
  }

  //service confirm delete
  $('#serviceDeleteConfirmbtn').click(function() {
    var id = $('#serviceDeleteId').html();
    serviceDelete(id);
  })

  function serviceDelete(deleteId) {
    $('#serviceDeleteConfirmbtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/serviceDelete', {
        id: deleteId
      })
      .then(function(response) {
        $('#serviceDeleteConfirmbtn').html("Delete");
        if (response.status == 200) {
          if (response.data == 1) {
            $('#deleteModal').modal('hide');
            toastr.success('Delete Success.');
            getServiceData();
          } else {
            $('#deleteModal').modal('hide');
            toastr.error('Delete Fail.');
            getServiceData();
          }
        }
      })
      .catch(function(error) {
        $('#deleteModal').modal('hide');
        toastr.error('Delete Fail.');
        getServiceData();
      });
  }
  //service update details
  function serviceUpdateDetails(detailsId) {
    axios.post('/serviceDetails', {
        id: detailsId
      })
      .then(function(response) {
        if (response.status == 200) {
          $('#serviceEditeForm').removeClass('d-none');
          $('#serviceEditLoader').addClass('d-none');
          var jasonData = response.data;
          $('#serviceNameId').val(jasonData[0].service_name);
          $('#serviceDesId').val(jasonData[0].service_des);
          $('#serviceImgId').val(jasonData[0].service_img);
        } else {
          $('#serviceEditLoader').addClass('d-none');
          $('#serviceEditwrong').removeClass('d-none');

        }
      })
      .catch(function(error) {

      });
  }

  // service update confirm
  $('#serviceUpdateConfirmbtn').click(function() {
    var id = $('#serviceEditId').html();
    var name = $('#serviceNameId').val();
    var des = $('#serviceDesId').val();
    var img = $('#serviceImgId').val();

    serviceUpdate(id, name, des, img);
  })
  //service update management
  function serviceUpdate(serviceId, serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
      toastr.error('Service Name is Empty.');
    } else if (serviceDes.length == 0) {
      toastr.error('Service Description is empty.');
    } else if (serviceImg.length == 0) {
      toastr.error('Service image is empty.');
    } else {
      $('#serviceUpdateConfirmbtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
      axios.post('/serviceUpdate', {
          id: serviceId,
          name: serviceName,
          des: serviceDes,
          img: serviceImg,
        })
        .then(function(response) {
          $('#serviceUpdateConfirmbtn').html("Update");
          if (response.status == 200) {
            if (response.data == 1) {
              $('#editModal').modal('hide');
              toastr.success('Update Success.');
              getServiceData();
            } else {
              $('#editModal').modal('hide');
              toastr.error('Update Fail.');
              getServiceData();
            }
          } else {
            $('#editModal').modal('hide');
            toastr.error('Somthing want wrong.');
          }
        })
        .catch(function(error) {
          $('#editModal').modal('hide');
          toastr.error('Somthing want wrong.');
        });
    }

  }


  //add new service
  $('#addNewbtn').click(function() {
    $('#addNewServiceModel').modal('show');

  })
  // catch add new service data 
  $('#serviceAddbtn').click(function() {
    var name = $('#serviceNameAddNew').val();
    var des = $('#serviceDesAddNew').val();
    var img = $('#serviceImgAddNew').val();

    serviceAddNewData(name, des, img);
  })

  function serviceAddNewData(serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
      toastr.error('Service Name is Empty.');
    } else if (serviceDes.length == 0) {
      toastr.error('Service Description is empty.');
    } else if (serviceImg.length == 0) {
      toastr.error('Service image is empty.');
    } else {
      $('#serviceAddbtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
      axios.post('/serviceAddNew', {
          name: serviceName,
          des: serviceDes,
          img: serviceImg,
        })
        .then(function(response) {
          $('#serviceAddbtn').html("Add New");
          if (response.status == 200) {
            if (response.data == 1) {
              $('#addNewServiceModel').modal('hide');
              toastr.success('New Service Added.');
              getServiceData();
            } else {
              $('#addNewServiceModel').modal('hide');
              toastr.error('Added fail.');
              getServiceData();
            }
          } else {
            $('#addNewServiceModel').modal('hide');
            toastr.error('Somthing want wrong.');
          }
        })
        .catch(function(error) {
          $('#addNewServiceModel').modal('hide');
          toastr.error('Somthing want wrong.');
        });
    }

  }
</script>
@endsection