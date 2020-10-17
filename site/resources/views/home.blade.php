@extends('layouts.app')
@section('title','Home')


@section('content')

    //this is home page banner area from component > HomeBanner
    @include('component.HomeBanner')


    @include('component.HomeService')

    @include('component.HomeCource')

    @include('component.HomeProject')

    @include('component.HomeContact')

    @include('component.HomeBlog')





@endsection
