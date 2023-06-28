@extends('vendor.backpack.theme-tabler.layouts.vertical')
@section('content')
    <div class="table-responsive">
    <table class="table table-vcenter card-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orderitems as $orderitem)          
            <tr>
            <td> {{$orderitem->date}}</td>
            <td> {{$orderitem->name}}</td>
            <td> {{$orderitem->qty}}</td>          
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
