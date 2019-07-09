@extends('layout')

@section('title', 'Payment Cancelled')

@section('content')
    <div class="alert alert-danger" role="alert">
        Payment Has Been Cancelled
    </div>

    <div class="text-center">
        <a href="{{url('/')}}" class="btn btn-info">&lt;Home</a>
    </div>
@endsection
