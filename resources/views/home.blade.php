@extends('layout')

@section('title', 'MyNotePaper - Laravel Skrill Payment Gateway Integration with LaraSkrill')

@section('content')
    <div class="text-center" style="margin-bottom: 25px;">
        <a href="{{url('make-payment')}}" class="btn btn-info">Make Payment</a> <a href="{{url('do-refund')}}"
                                                                                   class="btn btn-danger">Do
            Refund</a>
    </div>
    @php
        $skrill_payments = DB::table('skrill_payments')->orderBy('id', 'desc')->get();
    @endphp
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">MB Transaction ID</th>
            <th scope="col">Amount</th>
            <th scope="col">Customer Email</th>
            <th scope="col">Created At</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($skrill_payments))
            @foreach($skrill_payments as $skrill_payment)
                <tr>
                    <td>{{$skrill_payment->id}}</td>
                    <td>{{$skrill_payment->mb_transaction_id}}</td>
                    <td>{{$skrill_payment->amount}} ({{$skrill_payment->currency}})</td>
                    <td>{{$skrill_payment->customer_email}}</td>
                    <td>{{$skrill_payment->created_at}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
