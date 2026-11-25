@extends('layouts.base')

@section('title', 'Categories - Administration')
@section('content')
<section class="section-b-space">
    <div class="container">
        <h2>Categories</h2>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('admin.categories.store') }}" class="row g-2 mb-4">
            @csrf
            <div class="col-md-4"><input type="text" name="name" class="form-control" placeholder="Nom" required></div>
            <div class="col-md-6"><input type="text" name="description" class="form-control" placeholder="Description"></div>
            <div class="col-md-2"><button class="btn btn-solid-default w-100" type="submit">Ajouter</button></div>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Nom</th><th>Produits</th><th>Etat</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td><td>{{ $category->products_count }}</td>
                            <td>{{ $category->is_active ? 'Actif' : 'Inactif' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
    </div>
</section>
@endsection
