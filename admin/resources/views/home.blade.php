@extends('layouts.app')
@section('title','Home')

@section('content')



<div class="homecard mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3>{{$totalVisitor}}</h3>
                        <h5 class="card-title">Total Visitor</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3>{{$totalService}}</h3>
                        <h5 class="card-title">Total Services</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3>{{$totalCourse}}</h3>
                        <h5 class="card-title">Total Courses</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3>{{$totalContact}}</h3>
                        <h5 class="card-title">Total Messages</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection