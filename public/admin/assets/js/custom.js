document.addEventListener("DOMContentLoaded", function() {
    // click submit
    const btnReportSearch = document.getElementById('btn-report-search');

    if(btnReportSearch) {
        btnReportSearch.addEventListener("click", function() {
            document.getElementById("form-report").submit();
        });
    }

    // click add more event
    const btnAddMore = document.getElementById('btn-add-more');

    if(btnAddMore) {
        btnAddMore.addEventListener('click', function(event) {
            event.preventDefault();
            var productGroup = document.querySelector('.product-group').cloneNode(true);
            var btnRemove = document.createElement('button');
            btnRemove.classList.add('btn', 'btn-danger', 'btn-remove');
            btnRemove.type = 'button';
            btnRemove.textContent = 'Xóa';
            productGroup.appendChild(btnRemove);


            var inputs = productGroup.querySelectorAll('input, textarea, select');
            inputs.forEach(function(input) {
                input.value = '';
            });

            var btnGroup = document.querySelector('#btn-add-more');
            btnGroup.parentNode.insertBefore(productGroup, btnGroup);
        });
    }

    // click remove product-group
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-remove')) {
            e.target.closest('.product-group').remove();
        }
    });
});


