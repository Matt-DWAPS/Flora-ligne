$(function ($) {
    this.numberProductInCartId = $('#quantity_product_cart');
    this.numberProductInCart = 0;
    this.numberProductInCartId.html(this.numberProductInCart);
    this.emptyProductInCart = $('#cart-msg_empty'); //Div qui affiche le message aucun produit dans le panier



    this.product = {};   //Création du tableau qui contiendra les produit
    this.product.id;
    this.product.name;
    this.product.price;
    this.product.quantity = "";

    if (localStorage && localStorage.getItem('cart')) {
        // Lecture de la chaine de caractère  est construction de l'objet js du panier
        let cart = JSON.parse(localStorage.getItem('cart'));



        //Si l'id produit existe dans le panier
        if (cart.products != undefined) {

            //ont boucle sur chaque produit
            cart.products.forEach(product => {
                //Si le produit n'est pas null
                if (product != null) {

                    //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                    this.numberProductInCart++;
                }
            });
            //On met a jour la quantité de produit présente dans le panier dans la vue
            this.numberProductInCartId.html(this.numberProductInCart);
            this.emptyProductInCart.css('display', 'none');
        } else {
            this.numberProductInCartId.html(this.numberProductInCart);

        }
    }
    //Si aucun produit dans le panier ont affiche le message dans le dropdown menu panier
    if(this.numberProductInCart === 0){
        this.emptyProductInCart.css('display', 'block');
        this.emptyProductInCart.html('Votre panier ne contient aucun produit');
    }

});