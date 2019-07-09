@extends('layout')

@section('title', 'Payment Completed')

@section('content')
    <div class="alert alert-success" role="alert">
        Payment Successfully Completed
    </div>

    <div class="text-center">
        <a href="{{url('/')}}" class="btn btn-info">&lt;Home</a>
    </div>
@endsection
