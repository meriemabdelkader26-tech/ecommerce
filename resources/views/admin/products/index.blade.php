@extends('layouts.base')

@section('title', 'Produits - Administration')
@section('content')
<section class="section-b-space">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Produits</h2>
            <a href="{{ route('admin.products.create') }}" class="btn btn-solid-default">Ajouter</a>
        </div>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Nom</th><th>Categorie</th><th>Prix</th><th>Stock</th><th>Etat</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>${{ number_format((float) $product->price, 2) }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->is_active ? 'Actif' : 'Inactif' }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-secondary">Modifier</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
</section>
@endsection
