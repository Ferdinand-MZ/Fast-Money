<!-- resources/views/transactions/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transactions</h1>

        @if($transactions->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No transactions available.</p>
        @endif
    </div>
@endsection
