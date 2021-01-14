$(function ($) {
    this.totalProductsCart = $('#totalCartProduct');
    if (localStorage && localStorage.getItem('cart')){
        let cart = JSON.parse(localStorage.getItem('cart'));

        this.totalCart = 0;
        cart.products.forEach(product => {
            if (product != null){
                this.name = product.name;
                this.price = product.price;
                this.quantity =product.quantity;

                this.totalProduct = product.quantity * product.price;
                this.totalCart = this.totalCart + this.totalProduct;

            }
        })
        this.totalProductsCart.html(this.totalCart + " €");

    }
});