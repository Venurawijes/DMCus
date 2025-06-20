<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Customers | DineMagik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .filter-btn { min-width: 80px; }
        .customer-card {
            position: relative;
            background: #fff;
            border-radius: 25px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: box-shadow 0.2s ease-in-out;
        }
        .customer-card:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.12);
        }
        .important-dot {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 12px;
            height: 12px;
            background: #FFC107;
            border-radius: 50%;
        }
        .important-label {
            position: absolute;
            top: 12px;
            right: 35px;
            font-weight: 600;
            color: #856404;
            font-size: 14px;
        }
        .section-title {
            font-weight: bold;
            margin: 15px 0 5px;
            border-bottom: 1px solid #ddd;
            color: #444;
        }
        .extra-note {
            margin-top: 10px;
            padding: 10px;
            background: #f9f9f9;
            border-left: 4px solid #007bff;
            white-space: pre-wrap;
        }
        .important-text {
            margin-top: 10px;
            font-weight: bold;
            color: #856404;
            background: #fff3cd;
            padding: 6px 10px;
            border-radius: 8px;
            display: inline-block;
        }
        #customerDetails {
            display: none;
            margin-top: 30px;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
<div class="container py-4">

    <div class="text-center mb-4">
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="DineMagik" height="60" />
        <div class="tagline">Effortless Orders, Delightful Dining</div>
    </div>

    <input
        type="text"
        id="searchInput"
        class="form-control mb-3"
        placeholder="Search customers..."
        onkeyup="filterCustomers()"
    />

    <div class="d-flex justify-content-between mb-3">
        <select id="locationFilter" class="form-select filter-btn" onchange="filterCustomers()">
            <option value="">All Locations</option>
            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($location); ?>"><?php echo e($location); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select id="importanceFilter" class="form-select filter-btn" onchange="filterCustomers()">
            <option value="">All Priority</option>
            <option value="1">Important</option>
            <option value="0">Normal</option>
        </select>

        <select id="typeFilter" class="form-select filter-btn" onchange="filterCustomers()">
            <option value="">All Types</option>
            <option value="Restaurant">Restaurant</option>
            <option value="Villa">Villa</option>
            <option value="Hotel">Hotel</option>
        </select>
    </div>

    <div class="d-grid mb-4">
        <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-primary">Add Customer</a>
    </div>

    <div id="customerList" class="row">
        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-4">
                <div
                    class="customer-card"
                    data-customer='<?php echo json_encode($customer, 15, 512) ?>'
                    onclick="showCustomerDetails(this)"
                    data-location="<?php echo e($customer->location); ?>"
                    data-important="<?php echo e($customer->is_important ? '1' : '0'); ?>"
                    data-type="<?php echo e($customer->type); ?>"
                >
                    <strong class="customer-name"><?php echo e($customer->name); ?></strong><br />
                    <strong>Business Name:</strong> <span class="business-name"><?php echo e($customer->business_name); ?></span><br />
                    <small><?php echo e($customer->location); ?></small><br />

                    <?php if($customer->is_important): ?>
                        <span class="important-dot"></span>
                        <span class="important-label">Important</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div id="customerDetails"></div>

</div>

<script>
    let lastScrollPosition = 0;

    function filterCustomers() {
        const search = document.getElementById('searchInput').value.toLowerCase();
        const location = document.getElementById('locationFilter').value;
        const importance = document.getElementById('importanceFilter').value;
        const type = document.getElementById('typeFilter').value;

        document.querySelectorAll('#customerList .customer-card').forEach(card => {
            const name = card.querySelector('.customer-name').textContent.toLowerCase();
            const business = card.querySelector('.business-name').textContent.toLowerCase();
            const loc = card.dataset.location;
            const imp = card.dataset.important;
            const typ = card.dataset.type;

            const matchesSearch = name.includes(search) || business.includes(search);
            const matchesLocation = !location || loc === location;
            const matchesImportance = !importance || imp === importance;
            const matchesType = !type || typ === type;

            card.parentElement.style.display = (matchesSearch && matchesLocation && matchesImportance && matchesType) ? '' : 'none';
        });
    }

    function showCustomerDetails(element) {
        const customer = JSON.parse(element.getAttribute('data-customer'));
        lastScrollPosition = window.scrollY;

        const detailSection = document.getElementById('customerDetails');
        detailSection.style.display = 'block';

        detailSection.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>${customer.business_name}</h4>
                <div class="d-flex align-items-center">
                    <a href="/customers/${customer.id}/edit" class="btn btn-sm btn-warning me-2">Edit Customer</a>
                    <form action="/customers/${customer.id}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                        <button type="submit" class="btn btn-sm btn-danger me-2">Delete</button>
                    </form>
                    <button class="btn btn-sm btn-outline-secondary" onclick="closeCustomerDetails()">Close</button>
                </div>
            </div>

            <div class="section-title">Customer Info</div>
            <p><strong>Name:</strong> ${customer.name}</p>
            <p><strong>Location:</strong> ${customer.location}</p>
            <p><strong>Phone:</strong> ${customer.phone ?? 'N/A'}</p>
            <br />
            <div class="section-title">Business Info</div>
            <p><strong>Business Name:</strong> ${customer.business_name}</p>
            <p><strong>Type:</strong> ${customer.type}</p>
            <p><strong>Size:</strong> ${customer.size ?? 'N/A'}</p>

            ${
                customer.extra_note && customer.extra_note.trim()
                    ? `<div class="extra-note"><strong>Note:</strong> ${customer.extra_note.replace(/\n/g, '<br>')}</div>`
                    : ''
            }

            ${
                customer.is_important
                    ? `<div class="important-text">Marked as Important</div>`
                    : ''
            }
        `;

        window.scrollTo({ top: detailSection.offsetTop - 80, behavior: 'smooth' });
    }

    function closeCustomerDetails() {
        const detailSection = document.getElementById('customerDetails');
        detailSection.style.display = 'none';
        detailSection.innerHTML = '';
        window.scrollTo({ top: lastScrollPosition, behavior: 'smooth' });
    }
</script>

</body>
</html>
<?php /**PATH /Users/venurawijesooriya/Desktop/DineMagik/CustomerApp/resources/views/customers/index.blade.php ENDPATH**/ ?>