

//Récuperation de l'id du produit et suppression en bdd
    function deleteThisProduct(idProduct) {
    //Lecture du tableau local
        let cart =JSON.parse(localStorage.getItem('cart'));
        //Redefinition a null de la ligne produit concerné
        cart.products[idProduct] = null;
        //Enregistrement du local avec la nouvelle valeur
        localStorage.setItem('cart', JSON.stringify(cart));

        //Redirection pour la suppression en bdd
        window.location.replace('/Cart/deleteProduct/'+idProduct);


    }
