//for visitor table
$(document).ready(function () {
    $('#VisitorDt').DataTable({"order":false});
    $('.dataTables_length').addClass('bs-select');
});


//for course page
function getCourseData() {
    axios.get('/getcourseData')
        .then(function (response) {
            if (response.status == 200) {
                $('#maindivcourses').removeClass('d-none');
                $('#loaderdivcourses').addClass('d-none');
                $('#courseDataTable').DataTable().destroy();
                $('#courses_table').empty();
                var jasonData = response.data;
                $.each(jasonData, function (i, item) {
                    $('<tr>').html(
                        "<td class='th-sm'>" + jasonData[i].course_name + "</td>" +
                        "<td class='th-sm'>" + jasonData[i].course_fee + "</td>" +
                        "<td class='th-sm'>" + jasonData[i].course_totalclass + "</td>" +
                        "<td class='th-sm'>" + jasonData[i].course_totalenroll + "</td>" +
                        "<td class='th-sm'><a class='coursesDetailsbtn' data-id=" + jasonData[i].id + "><i class='fa fa-eye'></i></a></td>" +
                        "<td class='th-sm'><a class='coursesEditbtn' data-id=" + jasonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                        "<td class='th-sm'><a class='coursesDeletebtn' data-id=" + jasonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#courses_table');
                });
                //course get delete id
                $('.coursesDeletebtn').click(function () {
                    var id = $(this).data('id');
                    $('#courseDeleteId').html(id);
                    $('#deleteModalCourse').modal('show');

                })
                //course update edit details
                $('.coursesEditbtn').click(function () {
                    var id = $(this).data('id');
                    $('#courseUpdateId').html(id);
                    courseUpdateDetails(id);
                    $('#updateCourseModal').modal('show');

                })
                $('#courseDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderdivcourses').addClass('d-none');
                $('#wrongdivcourses').removeClass('d-none');
            }

        })
        .catch(function (error) {
            $('#loaderdivcourses').addClass('d-none');
            $('#wrongdivcourses').removeClass('d-none');
        });
}

//add new course modal
$('#addNewCourse').click(function () {
    $('#addCourseModal').modal('show');
})
//catch course data from course modal
$('#CourseAddConfirmBtn').click(function () {
    var course_name = $('#CourseNameId').val();
    var course_des = $('#CourseDesId').val();
    var course_fee = $('#CourseFeeId').val();
    var course_enroll = $('#CourseEnrollId').val();
    var course_class = $('#CourseClassId').val();
    var course_link = $('#CourseLinkId').val();
    var course_img = $('#CourseImgId').val();

    courseAddNewData(course_name, course_des, course_fee, course_enroll, course_class, course_link, course_img);
})
function courseAddNewData(CourseName, CourseDes, CourseFee, CourseTotalenroll, CourseTotalClass, CourseLink, CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course Name is Empty.');
    } else if (CourseDes.length == 0) {
        toastr.error('Course Description is empty.');
    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is empty.');
    } else if (CourseTotalenroll.length == 0) {
        toastr.error('Course total enroll is empty.');
    } else if (CourseTotalClass.length == 0) {
        toastr.error('Course total class is empty.');
    } else if (CourseLink.length == 0) {
        toastr.error('Course link is empty.');
    } else if (CourseImg.length == 0) {
        toastr.error('Course image is empty.');
    }
    else {
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/courseAddNew', {
            course_name: CourseName,
            course_des: CourseDes,
            course_fee: CourseFee,
            course_totalenroll: CourseTotalenroll,
            course_totalclass: CourseTotalClass,
            course_link: CourseLink,
            course_img: CourseImg,
        })
            .then(function (response) {
                $('#CourseAddConfirmBtn').html("Add New");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('New Course Added.');
                        getCourseData();
                    } else {
                        $('#addNewServiceModel').modal('hide');
                        toastr.error('Added fail.');
                        getCourseData();
                    }
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Somthing want wrong.');
                }
            })
            .catch(function (error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Somthing want wrong.');
            });
    }

}

//course confirm delete
$('#courseDeleteConfirmbtn').click(function () {
    var id = $('#courseDeleteId').html();
    courseDelete(id);
})
function courseDelete(deleteId) {
    $('#courseDeleteConfirmbtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/courseDelete', {
        id: deleteId
    })
        .then(function (response) {
            $('#courseDeleteConfirmbtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteModalCourse').modal('hide');
                    toastr.success('Delete Success.');
                    getCourseData();
                } else {
                    $('#deleteModalCourse').modal('hide');
                    toastr.error('Delete Fail.');
                }
            }
        })
        .catch(function (error) {
            $('#deleteModalCourse').modal('hide');
            toastr.error('Delete Fail.');
        });
}

//course update details
function courseUpdateDetails(detailsId) {
    axios.post('/courseDetails', {
        id: detailsId
    })
        .then(function (response) {
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');
                var jasonData = response.data;
                $('#CourseNameUpdateId').val(jasonData[0].course_name);
                $('#CourseDesUpdateId').val(jasonData[0].course_des);
                $('#CourseFeeUpdateId').val(jasonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jasonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jasonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jasonData[0].course_link);
                $('#CourseImgUpdateId').val(jasonData[0].course_img);
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditwrong').removeClass('d-none');

            }
        })
        .catch(function (error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditwrong').removeClass('d-none');
        });
}
// course update confirm
$('#CourseUpdateConfirmBtn').click(function () {
    var id = $('#courseUpdateId').html();
    var course_name = $('#CourseNameUpdateId').val();
    var course_des = $('#CourseDesUpdateId').val();
    var course_fee = $('#CourseFeeUpdateId').val();
    var course_totalenroll = $('#CourseEnrollUpdateId').val();
    var course_totalclass = $('#CourseClassUpdateId').val();
    var course_link = $('#CourseLinkUpdateId').val();
    var course_img = $('#CourseImgUpdateId').val();

    courseUpdate(id, course_name, course_des, course_fee, course_totalenroll, course_totalclass, course_link, course_img);
})
//service update management
function courseUpdate(id, courseName, courseDes, courseFee, courseTotalenroll, courseTotalclass, courseLink, courseImg) {
    if (courseName.length == 0) {
        toastr.error('Course Name is Empty.');
    } else if (courseDes.length == 0) {
        toastr.error('Course Description is empty.');
    } else if (courseFee.length == 0) {
        toastr.error('Course fee is empty.');
    } else if (courseTotalenroll.length == 0) {
        toastr.error('Course enroll is empty.');
    } else if (courseTotalclass.length == 0) {
        toastr.error('Course class is empty.');
    } else if (courseLink.length == 0) {
        toastr.error('Course link is empty.');
    } else if (courseImg.length == 0) {
        toastr.error('course image is empty.');
    } else {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
        axios.post('/courseUpdate', {
            id: id,
            course_name: courseName,
            course_des: courseDes,
            course_fee: courseFee,
            course_totalenroll: courseTotalenroll,
            course_totalclass: courseTotalclass,
            course_link: courseLink,
            course_img: courseImg,
        })
            .then(function (response) {
                $('#CourseUpdateConfirmBtn').html("Update");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Success.');
                        getCourseData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update Fail.');
                        getCourseData();
                    }
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Somthing want wrong.');
                }
            })
            .catch(function (error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Somthing want wrong.');
            });
    }

}











