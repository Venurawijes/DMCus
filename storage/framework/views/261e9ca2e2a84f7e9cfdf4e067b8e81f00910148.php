<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer | DineMagik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        h2 {
            margin-bottom: 25px;
        }
        h4 {
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            font-size: 1.2rem;
            color: #333;
        }
        label {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="form-card">
        <h2>Add New Customer</h2>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('customers.store')); ?>">
            <?php echo csrf_field(); ?>

            <h4>Customer Info</h4>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                       value="<?php echo e(old('location')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                       value="<?php echo e(old('phone')); ?>" required>
            </div>

            <h4>Business Details</h4>
            <div class="mb-3">
                <label for="business_name">Business Name</label>
                <input type="text" name="business_name" id="business_name" class="form-control"
                       value="<?php echo e(old('business_name')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="Restaurant" <?php echo e(old('type') == 'Restaurant' ? 'selected' : ''); ?>>Restaurant</option>
                    <option value="Villa" <?php echo e(old('type') == 'Villa' ? 'selected' : ''); ?>>Villa</option>
                    <option value="Hotel" <?php echo e(old('type') == 'Hotel' ? 'selected' : ''); ?>>Hotel</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="size">Size</label>
                <select name="size" id="size" class="form-select" required>
                    <option value="">Select Size</option>
                    <option value="small" <?php echo e(old('size') == 'small' ? 'selected' : ''); ?>>Small</option>
                    <option value="medium" <?php echo e(old('size') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                    <option value="large" <?php echo e(old('size') == 'large' ? 'selected' : ''); ?>>Large</option>
                </select>
            </div>

            <h4>Extra Note</h4>
            <div class="mb-3">
                <textarea name="extra_note" class="form-control" rows="3"
                          placeholder="Enter any additional notes..."><?php echo e(old('extra_note')); ?></textarea>
            </div>

            <div class="form-check mb-4">
                <input type="hidden" name="is_important" value="0">
                <input type="checkbox" name="is_important" id="is_important" class="form-check-input"
                       value="1" <?php echo e(old('is_important') ? 'checked' : ''); ?>>
                <label for="is_important" class="form-check-label">Mark as Important</label>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Add Customer</button>
                <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php /**PATH /Users/venurawijesooriya/Desktop/DineMagik/CustomerApp/resources/views/customers/create.blade.php ENDPATH**/ ?>