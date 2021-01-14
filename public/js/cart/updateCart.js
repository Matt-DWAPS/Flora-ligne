//Requête faite au moment ou l'utilisateur se log
//Récupère en bdd le panier s'il existe
//récupère le localstorage si il existe

$.ajax({
    url: '/Dashboard/getProductsInCartInBdd',
    type: 'GET',
    dataType: 'JSON',
    success: function (data, statut) {
        if (!storageAvailable('localStorage')) {
            alert("Impossible d'enregistrer votre panier!");
        }
        if (data){
            //Si l'utilisateur à un panier en cours en bdd
            // alors la fonction getProductsInCartInBdd
            // récupère le panier en bdd
            //On itère sur chaque produit
            data.forEach(product => {
                // Si Mon panier existe en local
                if (localStorage && localStorage.getItem('cart')){
                    this.product = {};   //Création du tableau qui contiendra le produit
                    this.product.id = product.id;
                    this.product.name = product.name;
                    this.product.price = product.price;
                    this.product.quantity = product.quantity;
                    addToCartExistBeforeConnection(product);
                }else { //Si il existe pas je le créer
                    this.cart = {}; //Création du panier
                    this.cart.products = [];    //Création du tableau qui contiendra les lignes de produits
                    this.product = {};   //Création du tableau qui contiendra le produit
                    this.product.id = product.id;
                    this.product.name = product.name;
                    this.product.price = product.price;
                    this.product.quantity = product.quantity;
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                    addToCart(product);
                }
            });
            //Une fois la bdd synchronisé avec le localStorage
            // On supprimer en bdd les lignes de la table customer_has_product
            // On enregistre le localStorage dans la bdd
            $.ajax({
                url: '/Dashboard/updateProductsBdd',
                type: 'POST',
                data: {data: localStorage.getItem('cart')},
                success: function (data) {
                    window.location.replace("/Home");
                },
                error: function () {
                    alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez rafraichir la page');
                },
                complete: function (){
                }
            });
        } else {
             //L'utlisateur n'a aucun panier en bdd
             //Panier en local existant à la connexion
             //je créer mon panier en bdd avec les données du local
             if (localStorage && localStorage.getItem('cart')){
                 $.ajax({
                     url: '/Dashboard/saveLocalStorageInBdd',
                     type: 'POST',
                     data: {data: localStorage.getItem('cart')},
                     success: function (data) {
                         data.forEach(product => {
                             //Mon panier existe en local
                                 this.product = {};   //Création du tableau qui contiendra le produit
                                 this.product.id = product.id;
                                 this.product.name = product.name;
                                 this.product.price = product.price;
                                 this.product.quantity = product.quantity;
                                 addToCart(product);

                         });
                         window.location.replace("/Home");
                     },

                     error: function () {
                         alert('Sauvegarde du panier localStorage en Bdd échoué');
                     }

                 });
             }
             //L'utilisateur n'a ni panier en local ni en bdd
             window.location.replace("/home");
         }

        function storageAvailable(type) {
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


        function addToCart(product) {
            this.numberProductInCartId = $('#quantity_product_cart');
            this.numberProductInCart = 0;
            // Recuperaton du panier dans le local storage
            if (localStorage && localStorage.getItem('cart')) {
                // Lecture du panier dans le local storage
                let cart = JSON.parse(localStorage.getItem('cart'));
                //Si l'id produit et déja défini
                cart.products[product.id] = product;
                cart.products.forEach(product => {
                    //Si le produit n'est pas null
                    if (product != null) {
                            //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                            this.numberProductInCart++;
                    }
                });
                localStorage.setItem('cart', JSON.stringify(cart));
                this.numberProductInCartId.html(this.numberProductInCart);

            }
        }

        function addToCartExistBeforeConnection(product) {
            this.numberProductInCartId = $('#quantity_product_cart');
            this.numberProductInCart = 0;
            // Recuperaton du panier dans le local storage
            if (localStorage && localStorage.getItem('cart')) {
                // Lecture du panier dans le local storage
                let cart = JSON.parse(localStorage.getItem('cart'));
                //Si l'id produit et déja present en local
                if (cart.products[product.id] != undefined) {
                    // Ont met a jour la quantité du produit local + la bdd dans le localStorage
                    cart.products[product.id].quantity = parseInt(cart.products[product.id].quantity) + parseInt(product.quantity);
                    cart.products.forEach(product => {
                        //Si le produit n'est pas null
                        if (product != null) {
                            //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                            this.numberProductInCart++;
                        }
                    });
                    localStorage.setItem('cart', JSON.stringify(cart));
                } else {
                    cart.products[product.id] = product;
                    cart.products.forEach(product => {
                        //Si le produit n'est pas null
                        if (product != null) {
                            //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                            this.numberProductInCart++;
                        }
                    });
                    localStorage.setItem('cart', JSON.stringify(cart));
                    this.numberProductInCartId.html(this.numberProductInCart);
                }
            }
        }


    },

    error: function () {
        alert('Un problème est survenue, veuillez ressayer');
         window.location.replace("/Home");
    },

    complete: function () {


    }


});