@extends('layouts.base')

@section('title', 'my-account')
@section('content')
<!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>User Dashboard</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Dashboard</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"><i class="fas fa-angle-right"></i>Orders</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="2-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button"><i class="fas fa-angle-right"></i>Wishlist</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="3-tab" data-bs-toggle="tab" data-bs-target="#save" type="button"><i class="fas fa-angle-right"></i>Saved
                                Address</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="4-tab" data-bs-toggle="tab" data-bs-target="#pay" type="button"><i class="fas fa-angle-right"></i>Payment</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"><i class="fas fa-angle-right"></i>Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"><i class="fas fa-angle-right"></i>Security</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dash">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title title title1 title-effect">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="welcome-msg">
                                        <h6 class="font-light">Hello, <span>MARK JECNO !</span></h6>
                                        <p class="font-light">From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information.</p>
                                    </div>

                                    <div class="order-box-contain my-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="{{ asset('assets/images/svg/box.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="{{ asset('assets/images/svg/box1.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">total order</h5>
                                                            <h3>3648</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="{{ asset('assets/images/svg/sent.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="{{ asset('assets/images/svg/sent1.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">pending orders</h5>
                                                            <h3>215</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="{{ asset('assets/images/svg/wishlist.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="{{ asset('assets/images/svg/wishlist1.png') }}" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">wishlist</h5>
                                                            <h3>63874</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h3>Account Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Contact Information</h4>
                                                    </div>
                                                    <div class="box-content">
                                                        @if (session('status'))
                                                            <div class="alert alert-success">{{ session('status') }}</div>
                                                        @endif
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                                                        @endif
                                                        <form method="POST" action="{{ route('profile.update') }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label" for="profile-name">Name</label>
                                                                <input id="profile-name" type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="profile-email">Email</label>
                                                                <input id="profile-email" type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="profile-phone">Phone</label>
                                                                <input id="profile-phone" type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-solid-default btn-sm">Update profile</button>
                                                        </form>
                                                        <hr>
                                                        <form method="POST" action="{{ route('password.update') }}" class="mt-3">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label" for="current-password">Current password</label>
                                                                <input id="current-password" type="password" name="current_password" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="new-password">New password</label>
                                                                <input id="new-password" type="password" name="password" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="confirm-password">Confirm new password</label>
                                                                <input id="confirm-password" type="password" name="password_confirmation" class="form-control" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-solid-default btn-sm">Change password</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Newsletters</h4><a href="javascript:void(0)">Edit</a>
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">You are currently not subscribed to any
                                                            newsletter.</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="box address-box">
                                                <div class="box-title">
                                                    <h4>Address Book</h4><a href="javascript:void(0)">Manage
                                                        Addresses</a>
                                                </div>
                                                <div class="box-content">
                                                    <div class="row g-4">
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Billing Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                billing address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Shipping Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                shipping address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
                            <div class="box-head mb-3">
                                <h3>My Order</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Order Id</th>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/1.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mt-0">#125021</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Outwear & Coats</p>
                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">Shipped</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/2.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="mt-0">#125367</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Outwear & Coats</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Pending</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/3.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125948</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">Shipped</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/4.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#127569</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">Shipped</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/5.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125753</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Canceled</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/6.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125021</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="danger-button btn btn-sm">Canceled</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="wishlist">
                            <div class="box-head mb-3">
                                <h3>My Wishlish</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Order Id</th>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/1.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125021</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Outwear & Coats</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/2.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125367</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Outwear & Coats</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/3.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125948</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/4.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#127569</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/5.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#127569</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Hoodie t-shirt</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.details') }}">
                                                    <img src="{{ asset('assets/images/fashion/product/front/6.jpg') }}" class="blur-up lazyload" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <p class="m-0">#125021</p>
                                            </td>
                                            <td>
                                                <p class="fs-6 m-0">Men's Sweatshirt</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">$49.54</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart') }}" class="btn btn-solid-default btn-sm fw-bold">Move to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade dashboard" id="save">
                            <div class="box-head">
                                <h3>Save Address</h3>
                                <button type="button" class="btn btn-solid-default btn-sm fw-bold ms-auto" id="add-address-button" data-bs-toggle="modal" data-bs-target="#addressModal"><i class="fas fa-plus"></i>
                                    Add New Address</button>
                            </div>
                            <div class="save-details-box">
                                <div class="row g-3">
                                    @forelse($addresses as $address)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="save-details">
                                                <div class="save-name">
                                                    <h5>{{ $address->recipient_name }}</h5>
                                                    <div class="save-position">
                                                        <h6>{{ $address->label }} @if($address->is_default)<span class="badge bg-success">Par defaut</span>@endif</h6>
                                                    </div>
                                                </div>
                                                <div class="save-address">
                                                    <p class="font-light">{{ $address->address_line_1 }}</p>
                                                    @if($address->address_line_2)<p class="font-light">{{ $address->address_line_2 }}</p>@endif
                                                    <p class="font-light">{{ $address->city }}@if($address->state), {{ $address->state }}@endif</p>
                                                    <p class="font-light">{{ $address->postal_code }}, {{ $address->country }}</p>
                                                </div>
                                                <div class="mobile">
                                                    <p class="font-light mobile">{{ $address->phone }}</p>
                                                </div>
                                                <div class="button d-flex gap-2">
                                                    <button type="button" class="btn btn-sm edit-address-button"
                                                        data-bs-toggle="modal" data-bs-target="#addressModal"
                                                        data-update-url="{{ route('addresses.update', $address) }}"
                                                        data-label="{{ $address->label }}"
                                                        data-recipient-name="{{ $address->recipient_name }}"
                                                        data-phone="{{ $address->phone }}"
                                                        data-address-line-1="{{ $address->address_line_1 }}"
                                                        data-address-line-2="{{ $address->address_line_2 }}"
                                                        data-city="{{ $address->city }}"
                                                        data-state="{{ $address->state }}"
                                                        data-postal-code="{{ $address->postal_code }}"
                                                        data-country="{{ $address->country }}"
                                                        data-is-default="{{ $address->is_default ? '1' : '0' }}">Modifier</button>
                                                    <form method="POST" action="{{ route('addresses.destroy', $address) }}"
                                                        onsubmit="return confirm('Supprimer cette adresse ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="font-light">Aucune adresse enregistree.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade dashboard" id="pay">
                            <div class="box-head">
                                <h3>Card & Payment</h3>
                                <button class="btn btn-solid-default btn-sm fw-bold ms-auto" data-bs-toggle="modal" data-bs-target="#addPayment"><i class="fas fa-plus"></i>
                                    Add New Card</button>
                            </div>

                            <div class="card-details-section">
                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="{{ asset('assets/images/payment-icon/1.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details card-visa">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="{{ asset('assets/images/payment-icon/2.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details dabit-card">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="{{ asset('assets/images/payment-icon/3.jpg') }}" class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment" href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                            <div class="box-head">
                                <h3>Profile</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                            </div>
                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Company Name</h6>
                                    </div>
                                    <div class="right">
                                        <h6>Surfside Media Fashion</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Country / Region</h6>
                                    </div>
                                    <div class="right">
                                        <h6>Downers Grove, IL</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Year Established</h6>
                                    </div>
                                    <div class="right">
                                        <h6>2018</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Total Employees</h6>
                                    </div>
                                    <div class="right">
                                        <h6>101 - 200 People</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Category</h6>
                                    </div>
                                    <div class="right">
                                        <h6>Clothing</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Street Address</h6>
                                    </div>
                                    <div class="right">
                                        <h6>549 Sulphur Springs Road</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">City/State</h6>
                                    </div>
                                    <div class="right">
                                        <h6>Downers Grove, IL</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Zip</h6>
                                    </div>
                                    <div class="right">
                                        <h6>60515</h6>
                                    </div>
                                </li>
                            </ul>

                            <div class="box-head mt-lg-5 mt-3">
                                <h3>Login Details</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                            </div>

                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Email Address</h6>
                                    </div>
                                    <div class="right">
                                        <h6>mark.jugal@gmail.com</h6>
                                    </div>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Phone No.</h6>
                                    </div>
                                    <div class="right">
                                        <h6>+1-202-555-0198</h6>
                                    </div>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                                </li>

                                <li class="mb-0">
                                    <div class="left">
                                        <h6 class="font-light">Password</h6>
                                    </div>
                                    <div class="right">
                                        <h6>●●●●●●</h6>
                                    </div>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane fade dashboard-security dashboard" id="security">
                            <div class="box-head">
                                <h3>Delete Your Account</h3>
                            </div>
                            <div class="security-details">
                                <h5 class="font-light mt-3">Hi <span> Mark Enderess,</span>
                                </h5>
                                <p class="font-light mt-1">We Are Sorry To Here You Would Like To Delete Your Account.
                                </p>
                            </div>

                            <div class="security-details-1 mb-0">
                                <div class="page-title">
                                    <h4 class="fw-bold">Note</h4>
                                </div>
                                <p class="font-light">Deleting your account will permanently remove your profile,
                                    personal settings, and all other associated information. Once your account is
                                    deleted, You will be logged out and will be unable to log back in.</p>

                                <p class="font-light mb-4">If you understand and agree to the above statement, and would
                                    still like to delete your account, than click below</p>

                                <button class="btn btn-solid-default btn-sm fw-bold rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Your
                                    Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user dashboard section end -->

    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="address-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('addresses.store') }}" id="address-form">
                    @csrf
                    <input type="hidden" name="_method" id="address-method" value="PUT" disabled>
                    <div class="modal-header">
                        <h5 class="modal-title" id="address-modal-title">Ajouter une adresse</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="address-label" class="form-label">Libelle</label>
                                <input id="address-label" name="label" class="form-control" maxlength="50" value="{{ old('label') }}" required>
                                @error('label')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-recipient-name" class="form-label">Nom du destinataire</label>
                                <input id="address-recipient-name" name="recipient_name" class="form-control" value="{{ old('recipient_name') }}" required>
                                @error('recipient_name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-phone" class="form-label">Telephone</label>
                                <input id="address-phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-line-1" class="form-label">Adresse</label>
                                <input id="address-line-1" name="address_line_1" class="form-control" value="{{ old('address_line_1') }}" required>
                                @error('address_line_1')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-line-2" class="form-label">Complement d'adresse</label>
                                <input id="address-line-2" name="address_line_2" class="form-control" value="{{ old('address_line_2') }}">
                                @error('address_line_2')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-city" class="form-label">Ville</label>
                                <input id="address-city" name="city" class="form-control" value="{{ old('city') }}" required>
                                @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-state" class="form-label">Region / Etat</label>
                                <input id="address-state" name="state" class="form-control" value="{{ old('state') }}">
                                @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-postal-code" class="form-label">Code postal</label>
                                <input id="address-postal-code" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                                @error('postal_code')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address-country" class="form-label">Pays</label>
                                <input id="address-country" name="country" class="form-control" value="{{ old('country') }}" required>
                                @error('country')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="address-is-default" name="is_default" value="1" @checked(old('is_default'))>
                                    <label class="form-check-label" for="address-is-default">Definir comme adresse par defaut</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-solid-default">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            var modal = document.getElementById('addressModal');
            var form = document.getElementById('address-form');
            var methodInput = document.getElementById('address-method');
            var fields = {
                label: document.getElementById('address-label'),
                recipient_name: document.getElementById('address-recipient-name'),
                phone: document.getElementById('address-phone'),
                address_line_1: document.getElementById('address-line-1'),
                address_line_2: document.getElementById('address-line-2'),
                city: document.getElementById('address-city'),
                state: document.getElementById('address-state'),
                postal_code: document.getElementById('address-postal-code'),
                country: document.getElementById('address-country')
            };

            modal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;

                if (!button) {
                    return;
                }

                form.reset();
                methodInput.disabled = true;
                form.action = @json(route('addresses.store'));
                document.getElementById('address-modal-title').textContent = 'Ajouter une adresse';

                if (!button.classList.contains('edit-address-button')) {
                    return;
                }

                form.action = button.dataset.updateUrl;
                methodInput.disabled = false;
                Object.keys(fields).forEach(function (field) {
                    fields[field].value = button.getAttribute('data-' + field.replace(/_/g, '-')) || '';
                });
                document.getElementById('address-is-default').checked = button.dataset.isDefault === '1';
                document.getElementById('address-modal-title').textContent = 'Modifier une adresse';
            });

            @if($errors->hasAny(['label', 'recipient_name', 'phone', 'address_line_1', 'address_line_2', 'city', 'state', 'postal_code', 'country', 'is_default']))
                bootstrap.Modal.getOrCreateInstance(modal).show();
            @endif
        })();
    </script>
    @endpush

    <!-- Subscribe Section Start -->
    <section class="subscribe-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="subscribe-details">
                        <h2 class="mb-3">Subscribe Our News</h2>
                        <h6 class="font-light">Subscribe and receive our newsletters to follow the news about our fresh
                            and fantastic Products.</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                    <div class="subsribe-input">
                        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="input-group">
                            @csrf
                            <input type="email" name="email" class="form-control subscribe-input" placeholder="Your Email Address" required>
                            <button class="btn btn-solid-default" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
@endsection
