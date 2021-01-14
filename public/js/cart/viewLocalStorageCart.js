$(function ($) {


    this.totalProductsCart = $('#totalCartProduct'); //Balise html ou le prix total s'affichera
    //On verifie qu'il y a bien un localStorage panier d'enregistrer
    if (localStorage && localStorage.getItem('cart')){
        let cart = JSON.parse(localStorage.getItem('cart'));

        //Initialisation du prix total à 0
        this.totalCart = 0;
        //On itère sur la panier local
        cart.products.forEach(product => {
            //Si le produit n'est pas null
            if (product != null){
                //Ont enregistre dans les variables les elements du localStorage nécessaire
                this.name = product.name;
                this.price = product.price;
                this.quantity =product.quantity;

                //On multiplie la quantité de chaque produit par son prix
                this.totalProduct = product.quantity * product.price;
                // On enregistre le prix total de tout les produits
                this.totalCart = this.totalCart + this.totalProduct;

            }
        })

        //On affiche le prix total dans le html
        this.totalProductsCart.html(this.totalCart + " €");

    }


});