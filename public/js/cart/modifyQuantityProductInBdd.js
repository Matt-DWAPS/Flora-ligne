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

