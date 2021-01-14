//Requête faite au moment ou l'utilisateur se log
//Si l'utilisateur à un panier en cours en bdd alors elle récupère le panier en bdd
//récupère le localstorage si il existe
//Incrémente le localstorage avec les valeurs contenu dans le JSON de la table panier de la bdd

$.ajax({
    url: '/Dashboard/getProductsInCartInBdd',
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
        if (!storageAvailable('localStorage')) {
            alert("Impossible d'enregistrer votre panier!");
        }

        // Si panier en bdd
        if (data == true){
            data.forEach(product => {
                // Si Mon panier existe en local
                if (localStorage && localStorage.getItem('cart')){

                    this.product = {};   //Création du tableau qui contiendra le produit
                    this.product.id = product.id;
                    this.product.name = product.name;
                    this.product.price = product.price;
                    this.product.quantity = product.quantity;
                    addToCart(product);
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
            //Une fois la bdd enregistré dans le localStorage
            //Cette requête va supprimer en bdd les lignes de la table customer_has_product
            if (localStorage && localStorage.getItem('cart')){
                $.ajax({
                    url: '/Dashboard/updateProductsBdd',
                    type: 'POST',
                    data: {data: localStorage.getItem('cart')},
                    success: function (data) {
                        alert('Panier localStorage enregistré en Bdd');
                        window.location.replace("/Home");
                    },

                    error: function () {
                        alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez rafraichir la page');
                    }

                });
            } else {
                window.location.replace("/Home");
            }
        } else {
            //Aucun panier en bdd
            //Panier en local existant à la connexion
            //je créer mon panier en bdd avec les données du local
            if (localStorage && localStorage.getItem('cart')){
                $.ajax({
                    url: '/Dashboard/saveLocalStorageInBdd',
                    type: 'POST',
                    data: {data: localStorage.getItem('cart')},
                    success: function (data) {
                        window.location.replace("/Home");
                    },

                    error: function () {
                        alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez rafraichir la page');
                    }

                });
            } else {
                window.location.replace("/Home");
            }
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
                if (cart.products[product.id] != undefined) {

                    //Ont incrémente la quantité du produit localstorage avec le produit de bdd
                    //En transformant les string en nombre pour le calcul
                    cart.products[product.id].quantity = parseInt(cart.products[product.id].quantity) + parseInt(product.quantity);
                    // On retransforme le resultat en string
                    cart.products[product.id].quantity =(""+ cart.products[product.id].quantity) ;

                    if (product != null) {
                        //On ajoute les lignes de produit pour affiché la quantité sur le panier dropdown
                        this.numberProductInCart++;
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    this.numberProductInCartId.html(this.numberProductInCart);
                } else {
                    cart.products[product.id] = product;
                    localStorage.setItem('cart', JSON.stringify(cart));
                    this.numberProductInCartId.html(this.numberProductInCart);
                }
            }
        }



    },

    error: function () {
        //Si aucun produit en base de données
        alert('aucun produit en bdd');
        window.location.replace("/Home");
    },

    complete: function () {


    }


});