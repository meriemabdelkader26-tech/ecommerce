@extends('layouts.base')

@section('title', 'Clients - Administration')
@section('content')
<section class="section-b-space">
    <div class="container">
        <h2>Clients</h2>
        @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Nom</th><th>Email</th><th>Telephone</th><th>Inscription</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td><td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td><td>{{ $customer->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $customers->links() }}
    </div>
</section>
@endsection
