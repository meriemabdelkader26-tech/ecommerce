@extends('layouts.base')

@section('title', 'Modifier un produit')
@section('content')
<section class="section-b-space">
    <div class="container">
        <h2>Modifier un produit</h2>
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('admin.products.update', $product) }}" class="row g-3">
            @csrf @method('PUT')
            <div class="col-md-6"><label class="form-label">Nom</label><input type="text" name="name" value="{{ $product->name }}" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Categorie</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)<option value="{{ $category->id }}" @selected($product->category_id === $category->id)>{{ $category->name }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-12"><label class="form-label">Description</label><textarea name="description" class="form-control">{{ $product->description }}</textarea></div>
            <div class="col-md-4"><label class="form-label">Prix</label><input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control" required></div>
            <div class="col-md-4"><label class="form-label">Ancien prix</label><input type="number" step="0.01" name="compare_at_price" value="{{ $product->compare_at_price }}" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">Stock</label><input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control" required></div>
            <div class="col-md-12"><input type="checkbox" name="is_active" value="1" @checked($product->is_active)> Actif</div>
            <div class="col-md-12"><button class="btn btn-solid-default" type="submit">Mettre a jour</button></div>
        </form>
    </div>
</section>
@endsection
