document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('customerForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('php/add_customer.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Redirect to customer.html
                window.location.href = 'customer.html';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function loadCustomerList() {
        fetch('php/view_customer.php')
        .then(response => response.text())
        .then(data => {
            document.querySelector('table tbody').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Initial load of customer list
    loadCustomerList();
});
