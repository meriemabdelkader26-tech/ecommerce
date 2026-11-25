@extends('layouts.base')

@section('title', 'Administration')
@section('content')
<section class="section-b-space">
    <div class="container">
        <h2 class="mb-4">Tableau de bord administrateur</h2>
        <div class="row g-3">
            @foreach([
                'Produits' => $stats['products'],
                'Categories' => $stats['categories'],
                'Clients' => $stats['customers'],
                'Commandes' => $stats['orders'],
                'Chiffre d\'affaires' => '$'.number_format($stats['revenue'], 2),
                'Stock faible' => $stats['low_stock'],
            ] as $label => $value)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted">{{ $label }}</h6>
                            <h3>{{ $value }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('admin.products.index') }}" class="btn btn-solid-default">Produits</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-solid-default">Categories</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-solid-default">Clients</a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-solid-default">Commandes</a>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h4>Commandes recentes</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead><tr><th>Numero</th><th>Client</th><th>Statut</th><th>Total</th></tr></thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name ?? $order->customer_name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>${{ number_format((float) $order->total, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4">Aucune commande.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
