const format = /[@#$%^&*()_+\=\[\]{};':"\\|<>\/]+/;
const nameerr = "";
var error = "";
var image = "";
var id = location.pathname.split('/')[2];

async function getProduct() {
    var id = location.pathname.split('/')[2];
    let url = 'http://localhost/api/products/' + id;
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderProduct() {
    let product = await getProduct();
    let html = '';

    document.getElementById('id').innerHTML = product.product_id; 
    document.myform.name.value = product.name;
    document.myform.price.value = product.price;  
    document.myform.stock.value = product.stock;  
    document.myform.description.value = product.description; 
    
    showPreviewImage(product.img);
  
    let productcontainer = document.getElementById('products');
    productcontainer.innerHTML = html;
}

function showPreviewImage(url) {
    var oldimgcontainer = document.getElementById('imgcontainer');
    var imgcontainer = document.createElement('div');
    imgcontainer.classList.add("col-sm-12");
    imgcontainer.setAttribute('id', 'imgcontainer')
    var img = document.createElement('img');
    img.classList.add("img-fluid");

    img.src = url;
    imgcontainer.appendChild(img);

    var div = document.getElementById('imagepreview');

    div.replaceChild(imgcontainer, oldimgcontainer);
    image = url;
}

renderProduct();

function validateform() { 
    var name = document.myform.name.value;  
    var price = document.myform.price.value;
    var stock = document.myform.stock.value;
    var description=document.myform.description.value;  

    if(validatename(name)) {
        if(validateprice(price)) {
            if(validatestock(stock)) {
                if(validatedescription(description)) {
                    if(validateimage()) {
                        let data = {name: name, price: price, stock: stock, img: image, description: description};
                        fetch("/api/products/" + id, {
                        method: "PATCH",
                        headers: {'Content-Type': 'application/json'}, 
                        body: JSON.stringify(data)
                        }).then(res => {
                        console.log("Request complete! response:", res);
                        });

                        alert("Product is succesvol gewijzigd!");
                        window.location.replace("/allproducts");
                        return true;
                    }
                }
            }
        }
    }
    alert(error);
}  

function validateimage() {
    if(image==null || image=="") {
        error = "Voeg een afbeelding aan het product toe.";
    } else {
        return true;
    }
}

function validatename(name){  
    if (name==null || name==""){  
        error = "Naam is leeg \n";  
        return false;  
    } else if(name.length > 100) {
        error = "Naam is te lang \n";  
        return false;  
    } else if(name.length < 2) {
        error = "Naam is te kort \n";
        return false;  
    } else if(format.test(name)) {
        error = "Er staan characters in de naam die niet toegestaan zijn \n";
        return false;  
    } else {
        return true;
    }
}

function validatedescription(description){  

    if (description==null || description==""){  
        error = "Bescrijving is leeg \n";  
        return false;  
    } else if(description.length > 200) {
        error = "Bescrijving is te lang \n";  
        return false;  
    } else if(description.length < 2) {
        error = "Bescrijving is te kort \n";
        return false;  
    } else if(format.test(description)) {
        error = "Er staan characters in de beschrijving die niet toegestaan zijn \n";
        return false;  
    } else {
        return true;
    }
}

function validateprice(price){  

    if (isNaN(price) || price < 0) {
        error = "Price is niet correct";
    } else {
        return true;
    }
}

function validatestock(stock){  

    if (isNaN(stock) || stock < 0) {
        error = "stock is niet correct";
    } else {
        return true;
    }
}




function showPreviewImage(url) {
    var oldimgcontainer = document.getElementById('imgcontainer');
    var imgcontainer = document.createElement('div');
    imgcontainer.classList.add("col-sm-12");
    imgcontainer.setAttribute('id', 'imgcontainer')
    var img = document.createElement('img');
    img.classList.add("img-fluid");

    img.src = url;
    imgcontainer.appendChild(img);

    var div = document.getElementById('imagepreview');

    div.replaceChild(imgcontainer, oldimgcontainer);
    image = url;
}

