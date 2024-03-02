// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();


/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

// load more event
document.addEventListener('DOMContentLoaded', function() {
    var loadMoreBtn = document.getElementById('load-more-btn');
    var offset = 6;

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', loadMoreProductsUrl + '?offset=' + offset, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var products = JSON.parse(xhr.responseText);
                    displayMoreProducts(products);
                    offset+=6;
                }
            };
            xhr.send();
        });
    }
});

// load products by category
document.getElementById('category').addEventListener('change', function() {
    var categoryName = this.value;

    var xhr = new XMLHttpRequest();
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            var products = JSON.parse(xhr.responseText);
            displayProducts(products);
        }
    }

    xhr.open('GET', '/store/' + categoryName);
    xhr.send();
});

// display products
function displayProducts(products) {
    var productContainer = document.getElementById('product-container');
    if (productContainer) {
        productContainer.innerHTML = '';

        products.forEach(function(product) {
            var productHtml = `
                <div class="col-sm-6 col-lg-4 product-item">
                    <div class="box">
                        <div class="img-box">
                            <img src="${product.images[0]}" alt="${product.name}">
                        </div>
                        <div class="detail-box">
                            <span class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            </span>
                            <a href="">
                                ${product.name}
                            </a>
                            <div class="price_box">
                                <h6 class="price_heading">
                                    ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)} <span>đ</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>`;
            productContainer.innerHTML += productHtml;
        });
    }
}

function displayMoreProducts(products) {
    var productContainer = document.getElementById('product-container');
    if (productContainer) {

        products.forEach(function(product) {
            var productHtml = `
                <div class="col-sm-6 col-lg-4 product-item">
                    <div class="box">
                        <div class="img-box">
                            <img src="${product.images[0]}" alt="${product.name}">
                        </div>
                        <div class="detail-box">
                            <span class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            </span>
                            <a href="">
                                ${product.name}
                            </a>
                            <div class="price_box">
                                <h6 class="price_heading">
                                    ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)} <span>đ</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>`;
            productContainer.innerHTML += productHtml;
        });
    }
}

