async function getProducts() {
    let url = 'http://localhost/api/products';
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderProducts() {
    let products = await getProducts();
    let html = '';
    products.forEach(product => {
        let htmlSegment = `<div class="product card mt-5 mb-5">
                            <div class="card-body">
                                <img class="card-img-top img-fluid" src="${product.img}" >
                                <h3>Productnummer: ${product.product_id}</h3>
                                <h2>${product.name}</h2>
                                <div class="">
                                    <h6>${product.description}</h6>
                                </div>
                                <div class="">
                                    <h5> Voorraad: ${product.stock}<h5>
                                </div>
                                <div class="">
                                    <h5>€ ${product.price}</h5>
                                </div>
                                </div>

                            <div class="card-footer row m-0 w-100">
                                <div class="col-sm-6">
                                <a class="btn btn-primary" href="/productedit/${product.product_id}" class="button">
                                    Wijzig product
                                </a>
                                </div>
                                <div class="col-sm-6">
                                    <button onclick="deleteProduct(${product.product_id})" class="float-right btn btn-danger">Verwijder product</button>
                                </div>
                            </div>


                        </div>`;

        html += htmlSegment;
    });

    let productcontainer = document.getElementById('products');
    productcontainer.innerHTML = html;
}

function deleteProduct(id) {
    if(confirm("Weet u zeker dat u het product wilt verwijderen?")) {
        fetch("/api/products/" + id, {
        method: "DELETE",
        headers: {'Content-Type': 'application/json'}, 
        }).then(res => {
        console.log("Request complete! response:", res);
        });
        alert("Product is succesvol verwijdert!");
        renderProducts();
        return true;
    }
}

renderProducts();