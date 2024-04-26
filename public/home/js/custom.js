// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

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
    document.getElementById("btn-submit-payment").addEventListener("click", function() {
        document.getElementById("order-form").submit();
    });
});

// handle payment event
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.payment-select-2').style.display = 'none';

    document.getElementById('btn-check-payment').addEventListener('click', function() {

        document.querySelector('.payment-select-1').style.display = 'none';
        document.getElementById('cart').style.display = 'none';

        document.querySelector('.payment-select-2').style.display = 'block';
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

