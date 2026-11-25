@extends('layouts.base')

@section('title', 'Commandes - Administration')
@section('content')
<section class="section-b-space">
    <div class="container">
        <h2>Commandes</h2>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Numero</th><th>Client</th><th>Total</th><th>Statut</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>${{ number_format((float) $order->total, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="d-flex gap-2">
                                    @csrf @method('PUT')
                                    <select name="status" class="form-select">
                                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                                            <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-solid-default" type="submit">Mettre a jour</button>
                                </form>
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
</section>
@endsection
