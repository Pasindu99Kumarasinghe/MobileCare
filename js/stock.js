document.addEventListener('DOMContentLoaded', function() {
    const addForm = document.querySelector('form[action="php/add_stock.php"]');
    const deleteForm = document.getElementById('deleteStockForm');

    addForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(addForm);

        fetch('php/add_stock.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                loadStockData();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    deleteForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(deleteForm);

        fetch('php/delete_stock.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                loadStockData();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function loadStockData() {
        fetch('php/view_stock.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('stockTableBody').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Initial load of stock data
    loadStockData();
});
