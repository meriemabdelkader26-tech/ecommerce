<div class="modal fade" id="quick-view" tabindex="-1" aria-labelledby="quick-view-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quick-view-title">Apercu du produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-5">
                        <img id="quick-view-image" src="" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-7">
                        <h3 id="quick-view-name"></h3>
                        <p id="quick-view-description" class="font-light"></p>
                        <p class="theme-color fw-bold">$<span id="quick-view-price"></span></p>
                        <p>Stock disponible : <span id="quick-view-stock"></span></p>
                        <div class="d-flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('cart.store') }}" id="quick-view-cart-form">
                                @csrf
                                <input type="hidden" name="product_id" id="quick-view-product-id">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-solid-default" id="quick-view-cart-button">Ajouter au panier</button>
                            </form>
                            @auth
                                <form method="POST" action="{{ route('wishlist.store') }}" id="quick-view-wishlist-form">
                                    @csrf
                                    <input type="hidden" name="product_id" id="quick-view-wishlist-product-id">
                                    <button type="submit" class="btn btn-outline-secondary">Ajouter aux favoris</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Se connecter pour ajouter aux favoris</a>
                            @endauth
                            <a href="#" id="quick-view-details" class="btn btn-link">Voir la fiche complète</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
