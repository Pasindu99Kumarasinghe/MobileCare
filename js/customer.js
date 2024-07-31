

$(document).ready(function() {
    $('#customerName, #idNumber, #contactNumber, #email, #address').on('blur', function() {
        const criteria = $(this).val();
        const field = $(this).attr('id');
        if (criteria.length > 0) {
            $.ajax( {
                url: 'php/check_customer.php',
                type: 'POST',
                data: { criteria: criteria, field: field},
                success: function(response) {
                    if (response) {
                        const customer = JSON.parse(response);
                        $('#customerName').val(customer.cutomerName);
                        $('#idNumber').val(customer.idNumber);
                        $('#contactNumeber').val(customer.contactNumber);
                        $('#email').val(customer.email);
                        $('#address').val(customer.address);
                    }
                }

            });
        }
    });
});

$(document).ready(function() {
    // Fetch and display customer data when the page loads
    fetchCustomerData();

    // Form submission event handler
    $('#addCustomerForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'php/add_customer.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Customer added successfully!');
                $('#addCustomerForm')[0].reset();  // Reset the form
                fetchCustomerData();  // Refresh the customer list
            },
            error: function(error) {
                alert('Error adding customer: ' + error.responseText);
            }
        });
    });

    // Function to fetch and display customer data
    function fetchCustomerData() {
        $.ajax({
            url: 'php/view_customers.php',
            type: 'GET',
            success: function(response) {
                $('#customerTableBody').html(response);
            },
            error: function(error) {
                alert('Error fetching customer data: ' + error.responseText);
            }
        });
    }
});
