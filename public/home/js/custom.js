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
// show fee delivery
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.btn-type-order').addEventListener('click', function(event) {
        event.preventDefault();
        var selectedOption = document.querySelector('.js-example-basic-single').value;

        if (selectedOption === "Ship tận nơi") {
            var totalPriceSpan = document.querySelector('.cart__total li:first-child span');
            var total_price = parseFloat(totalPriceSpan.textContent.trim().replace('đ', '').replace(',', ''));

            var fee = 15000;
            var total_payment = total_price + fee;

            document.querySelector('.cart__fee').classList.add('show');
            document.querySelector('.cart__total li:nth-child(3) span').textContent = total_payment.toLocaleString('en-US') + 'đ';
        } else {
            document.querySelector('.cart__fee').classList.remove('show');
            document.querySelector('.cart__total li:nth-child(3) span').textContent = document.querySelector('.cart__total li:first-child span').textContent;
        }
    });
});

// click submit
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btn-submit-order").addEventListener("click", function() {
        document.getElementById("order-form").submit();
    });
});

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

