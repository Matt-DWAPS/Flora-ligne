class CustomerCart {
    constructor() {

        this.inputQty = $('#qty');  //Input number pour la quantité du produit
        //Balise "span" qui contient la quantité dans le panier
        this.numberProductInCartId = $('#quantity_product_cart');
        this.numberProductInCart = 0;
        this.inputQty.attr("value", "1");   //Initialisation de l'attribut value de l'input number à 1
        this.emptyProductInCart = $('#cart-msg_empty');

        this.cart = {}; //Création du panier
        this.cart.products = [];    //Création du tableau qui contiendra les lignes de produits

        this.product = {};   //Création du tableau qui contiendra le produit
        this.product.id = id;
        this.product.name = name;
        this.product.price = price;
        this.product.quantity = "";


        this.initSettings();

        document.getElementById('qty-minus').addEventListener('click', function () {
            cartCustomer.selectQtyMinProduct();
        });

        document.getElementById('qty-plus').addEventListener('click', function () {
            cartCustomer.selectQtyMaxProduct();
        });

        // Au clic sur le boutton ajouter au panier etant connecté
         document.getElementById('add-product-to-cart').addEventListener('click', function () {
             //Si localStorage Ont récupere le produit
             if (localStorage.cart){
                 cartCustomer.getProduct();


                 //Requête faite au moment ou l'utilisateur ajoute un produit dans son panier
                 // On supprimer en bdd les lignes de la table customer_has_product
                 // On enregistre le localStorage dans la bdd
                 let products = JSON.parse(localStorage.getItem('cart')).products;

                 $.ajax({
                     url: '/Shop/updateProductsBdd',
                     type: 'POST',
                     data: {
                         data: JSON.stringify(products)
                     },
                     success: function (data) {

                     },
                     error: function () {
                         alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez ressayer');
                     },
                     complete: function () {

                     }
                 });
             } else { //Sinon ont créer le localStorage et ont ajoute le produit
                 localStorage.setItem('cart', JSON.stringify(cartCustomer.cart));    //On créer le panier localStorage
                 cartCustomer.getProduct();


                 //Requête faite au moment ou l'utilisateur ajoute un produit dans son panier
                 // On supprimer en bdd les lignes de la table customer_has_product
                 // On enregistre le localStorage dans la bdd
                 let products = JSON.parse(localStorage.getItem('cart')).products;
                 $.ajax({
                     url: '/Shop/updateProductsBdd',
                     type: 'POST',
                     data: {
                         data: JSON.stringify(products)
                     },
                     success: function (data) {

                     },
                     error: function () {
                         alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez ressayer');
                     },
                     complete: function () {

                     }
                 });

             }

         });

    } // Fin du constructeur
    // Initialisation
    initSettings() {
        if (!this.storageAvailable('localStorage')) {
            console.log("Impossible d'enregistrer votre panier !");
        }
    }

    //Check du localStorage
    storageAvailable(type) {
        try {
            let storage = window[type],
                x = '__storage_test__';
            storage.setItem(x, x);
            storage.removeItem(x);
            return true;
        } catch (e) {
            return false;
        }
    }

    //Récupère la quantité du produit ajouter au panier
    getProduct(){
        //On récupère la valeur de l'input number
        cartCustomer.product.quantity = $('#qty').val();

        //On ajoute le tableau produit au panier
        this.addToCart(this.product);
    }

    // Ajoute le produit au panier
    addToCart(product) {
        // Si le localstorage existe Recuperaton du panier dans le local storage
        if (localStorage && localStorage.getItem('cart')) {
            // Lecture de la chaine de caractère  est construction de l'objet js du panier
            let cart = JSON.parse(localStorage.getItem('cart'));

            //Si l'id produit existe dans le panier
            if (cart.products[product.id] != undefined) {
                //Ont incrémente la quantité du panier avec celle qui vient d'être ajouté au panier
                cart.products[product.id].quantity = parseInt(cart.products[product.id].quantity) + parseInt(cartCustomer.product.quantity);

                //On converti le tableau en une chaine JSON et ont l'injecte dans le localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
            } else {
                //Si le produit n'existe pas dans le panier
                // On créer le tableau contenant le produit
                cart.products[product.id] = product;
                //ont boucle sur chaque produit
                cart.products.forEach(product => {
                    //Si le produit n'est pas null
                    if (product != null) {
                        //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                        this.numberProductInCart++;
                    }
                });
                //On converti le tableau en une chaine JSON et ont l'injecte dans le localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
                //On met a jour la quantité de produit présent dans le panier dans la vue
                this.numberProductInCartId.html(this.numberProductInCart);
                //On cache la div "votre panier ne contient aucun produit
                this.emptyProductInCart.css('display', 'none');
            }

        }
    }

    // Décremente la quantité du produit avant ajout au panier
    selectQtyMinProduct(){
            let qty = cartCustomer.inputQty.val();
            if (!isNaN(qty) && qty > 1){
                cartCustomer.inputQty.val(parseInt(cartCustomer.inputQty.val())-1);
                //Mise a jour du value de l'input quantity
                cartCustomer.inputQty.attr("value", cartCustomer.inputQty.val());
                cartCustomer.product.quantity --;
            } else {
                return false;
            }
        //Si c'est un number & supérieur à 1 on décrémente de 1

    }

    // Incrémente la quantité du produit avant ajout au panier
    selectQtyMaxProduct(){

            let qty = cartCustomer.inputQty.val();
            //Si c'est un number & inferieur à 1 on incrémente de 1
            if (!isNaN(qty) && qty < 10){
                cartCustomer.inputQty.val(parseInt(cartCustomer.inputQty.val())+1);
                //Mise a jour du value de l'input quantity
                cartCustomer.inputQty.attr("value", cartCustomer.inputQty.val());
                //Ont met a jour le produit dans le tableau
                cartCustomer.product.quantity ++;
            } else {
                return false;
            }

    }



}
