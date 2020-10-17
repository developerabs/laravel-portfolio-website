@extends('layouts.app')
@section('title','Courses')

@section('content')

<button id="addNewCourse" class="btn btn-primary mt-3 ml-5">Add New</button>
<div id="maindivcourses" class="d-none">
  <div class="container">
    <div class="row">
      <div class="col-md-12 p-5">
        <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Name</th>
              <th class="th-sm">Fee</th>
              <th class="th-sm">Class</th>
              <th class="th-sm">Enroll</th>
              <th class="th-sm">Details</th>
              <th class="th-sm">Edit</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="courses_table">

            
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<div id="loaderdivcourses" class="container text-center">
  <div class="row">
    <div class="col-md-12 p-5">
      <img class="loader_img" src="{{asset('images/loader.svg')}}" alt="loader image">

    </div>
  </div>
</div>
<div id="wrongdivcourses" class="container text-center d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <h4>Something want wrong</h4>

    </div>
  </div>
</div>
<!--add new courses modal-->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
              <input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
              <input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
              <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
            </div>
            <div class="col-md-6">
              <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
              <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
              <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- courses update derails modal-->
<div class="modal fade " id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
        <div id="courseEditForm" class="container d-none">
          <h6 id="courseUpdateId" class="d-none"></h6>
          <div class="row">
            <div class="col-md-6">
              <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
              <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
              <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
              <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
            </div>
            <div class="col-md-6">
              <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
              <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
              <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
            </div>
          </div>
        </div>
        <img id="courseEditLoader" class="serviceLoaderImg" src="{{asset('images/loader.svg')}}" alt="loader image">
        <h4 id="courseEditwrong" class="d-none">Something want wrong</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>
<!--delete courses modal-->
<div class="modal fade" id="deleteModalCourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do You Want to Delete this?</h5>
        <h6 id="courseDeleteId" class="d-none"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
        <button id="courseDeleteConfirmbtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>










@endsection



@section('script')
<script type="text/javascript">
  getCourseData()
</script>
@endsection