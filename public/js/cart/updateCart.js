$.ajax({
    url: '/Dashboard/getProductsInCartInBdd',
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
        data.forEach(product => {
            console.log(product);
             function addToCart(product) {
                 // Recuperaton du panier dans le local storage
                 if (localStorage && localStorage.getItem('cart')) {
                     // Lecture du panier dans le local storage
                     let cart = JSON.parse(localStorage.getItem('cart'));

                     //Si l'id produit et déja défini
                     if (cart.products[product.id] != undefined) {
                         console.log('id defini en cart');
                         //Ont remplace la quantité du panier par celle ajouté au panier
                         cart.products[product.id].quantity = cartCustomer.product.quantity;

                         // cart.products.forEach(product => {
                         //     console.log(cart.products[product.id].quantity);
                         // });
                         localStorage.setItem('cart', JSON.stringify(cart));
                         cartCustomer.numberProductInCart.html(cart.products[product.id]);
                     } else {
                         console.log('id non defini');
                         cart.products[product.id] = product;
                         localStorage.setItem('cart', JSON.stringify(cart));
                         $('#quantity_product_cart').html(cart.products[product.id]);
                         cartCustomer.numberProductInCart.html(cart.products[product.id]);
                     }
                     //console.log(cart.products);
                 }
             }
        })
        console.log(data);
// appel la fonction addtocart après avoir foreach le data
        $.ajax({
            url: '/Dashboard/updateProductsBdd',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                console.log('ici je passe dans mon compelte');
                // rediriger la personne sur index
// appel la fonction addtocart
            },

            error: function () {
                console.log('erreur data no found')

            }

        });
    },

    error: function () {
        console.log('erreur data no found')
    },

    complete: function () {


    }


});