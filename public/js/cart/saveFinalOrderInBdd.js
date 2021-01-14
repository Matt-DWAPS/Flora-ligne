// //Requête faite au moment ou l'utilisateur se log
// //Si l'utilisateur à un panier en cours en bdd alors elle récupère le panier en bdd
// //récupère le localstorage si il existe
// //Incrémente le localstorage avec les valeurs contenu dans le JSON de la table panier de la bdd
//

 $.ajax({
     url: '/Cart/saveOrderFinal',
     type: 'GET',
     dataType: 'JSON',
     success: function (data) {
         console.log(data);
         if (data == true){
             alert('Je suis ici');
             data.forEach(product => {
                 if (localStorage && localStorage.getItem('cart')){
                     alert('Panier existant ');
                     this.product = {};   //Création du tableau qui contiendra le produit
                     this.product.id = product.id;
                     this.product.name = product.name;
                     this.product.price = product.price;
                     this.product.quantity = product.quantity;
                     addToCart(product);
                 }else {
                     alert('aucun panier de créer, je le créer');
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
                     url: '/Cart/updateProductsBdd',
                     type: 'POST',
                     data: {data: localStorage.getItem('cart')},
                     success: function (data) {
                         alert('Panier localStorage enregistré en Bdd');
                         $.ajax({
                             url: '/Cart/saveProductInOrder',
                             type: 'POST',
                             data: {data: localStorage.getItem('cart')},
                             success: function (data) {
                                 alert('Commande validé ! Vous allé recevoir un mail de confirmation');
                                 localStorage.clear();
                                 window.location.replace('/Home')

                             },

                             error: function () {
                                 alert('Commande non validé veuillez ressayé');
                             }

                         });
                     },

                     error: function () {
                         alert('Sauvegarde du panier localStorage en Bdd échoué, veuillez rafraichir la page');
                     }

                 });
             } else {
                 alert('aucun panier en localstorage');
                 window.location.replace("/Home");
             }
         } else {
             //Aucun panier en bdd
             //Panier en local existant à la connexion
             //je créer mon panier en bdd avec les données du local
             if (localStorage && localStorage.getItem('cart')){
                 $.ajax({
                     url: '/Cart/saveLocalStorageInBdd',
                     type: 'POST',
                     data: {data: localStorage.getItem('cart')},
                     success: function (data) {
                         $.ajax({
                             url: '/Cart/saveProductInOrder',
                             type: 'POST',
                             data: {data: localStorage.getItem('cart')},
                             success: function (data) {
                                 alert('Commande validé ! Vous allé recevoir un mail de confirmation');
                                 localStorage.clear();
                                 window.location.replace('/Home')

                             },

                             error: function () {
                                 alert('Commande non validé veuillez ressayé');
                             }

                         });
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