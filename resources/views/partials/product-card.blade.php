<div class="product-box">
    <div class="img-wrapper">
        <div class="front">
            <a href="{{ route('product.details', $product->slug) }}">
                <img src="{{ asset($product->images->first()?->path ?? 'assets/images/fashion/product/front/1.jpg') }}"
                    class="bg-img blur-up lazyload" alt="{{ $product->name }}">
            </a>
        </div>
        <div class="cart-wrap">
            <ul>
                <li>
                    <form method="POST" action="{{ route('cart.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="addtocart-btn border-0 bg-transparent" aria-label="Ajouter {{ $product->name }} au panier" @disabled($product->stock_quantity < 1)>
                            <i data-feather="shopping-cart"></i>
                        </button>
                    </form>
                </li>
                <li>
                    <button type="button" class="quick-view-trigger border-0 bg-transparent"
                        data-bs-toggle="modal" data-bs-target="#quick-view"
                        data-product-id="{{ $product->id }}"
                        data-product-name="{{ $product->name }}"
                        data-product-price="{{ number_format((float) $product->price, 2, '.', '') }}"
                        data-product-description="{{ $product->description }}"
                        data-product-image="{{ asset($product->images->first()?->path ?? 'assets/images/fashion/product/front/1.jpg') }}"
                        data-product-stock="{{ $product->stock_quantity }}"
                        data-product-url="{{ route('product.details', $product->slug) }}"
                        aria-label="Voir rapidement {{ $product->name }}">
                        <i data-feather="eye"></i>
                    </button>
                </li>
                <li>
                    @auth
                        <form method="POST" action="{{ route('wishlist.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="wishlist border-0 bg-transparent" aria-label="Ajouter {{ $product->name }} aux favoris">
                                <i data-feather="heart"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="wishlist" aria-label="Connectez-vous pour ajouter {{ $product->name }} aux favoris">
                            <i data-feather="heart"></i>
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
    <div class="product-detail">
        <a href="{{ route('product.details', $product->slug) }}">
            <h6 class="font-light">{{ $product->category->name }}</h6>
            <h3>{{ $product->name }}</h3>
        </a>
        <h4 class="font-light mt-1">
            @if($product->compare_at_price)
                <del>${{ number_format((float) $product->compare_at_price, 2) }}</del>
            @endif
            <span class="theme-color">${{ number_format((float) $product->price, 2) }}</span>
        </h4>
        <p class="font-light">Stock: {{ $product->stock_quantity }}</p>
        <div class="d-flex gap-2 mt-2">
            <form method="POST" action="{{ route('cart.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-solid-default btn-sm" @disabled($product->stock_quantity < 1)>Ajouter au panier</button>
            </form>
            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-sm btn-outline-secondary">Details</a>
        </div>
    </div>
</div>
