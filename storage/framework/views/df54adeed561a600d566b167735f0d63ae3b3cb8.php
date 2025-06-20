<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer | DineMagik</title>
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
        <h2>Edit Customer</h2>

        <form method="POST" action="<?php echo e(route('customers.update', $customer->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <h4>Customer Info</h4>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="<?php echo e(old('name', $customer->name)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control"
                       value="<?php echo e(old('location', $customer->location)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                       value="<?php echo e(old('phone', $customer->phone)); ?>" required>
            </div>

            <h4>Business Details</h4>
            <div class="mb-3">
                <label for="business_name">Business Name</label>
                <input type="text" name="business_name" id="business_name" class="form-control"
                       value="<?php echo e(old('business_name', $customer->business_name)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="Restaurant" <?php echo e(old('type', $customer->type) == 'Restaurant' ? 'selected' : ''); ?>>Restaurant</option>
                    <option value="Villa" <?php echo e(old('type', $customer->type) == 'Villa' ? 'selected' : ''); ?>>Villa</option>
                    <option value="Hotel" <?php echo e(old('type', $customer->type) == 'Hotel' ? 'selected' : ''); ?>>Hotel</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="size">Size</label>
                <select name="size" id="size" class="form-select" required>
                    <option value="">Select Size</option>
                    <option value="small" <?php echo e(old('size', $customer->size) == 'small' ? 'selected' : ''); ?>>Small</option>
                    <option value="medium" <?php echo e(old('size', $customer->size) == 'medium' ? 'selected' : ''); ?>>Medium</option>
                    <option value="large" <?php echo e(old('size', $customer->size) == 'large' ? 'selected' : ''); ?>>Large</option>
                </select>
            </div>

            <h4>Extra Note</h4>
            <div class="mb-3">
                <textarea name="extra_note" class="form-control" rows="3"
                          placeholder="Enter any additional notes..."><?php echo e(old('extra_note', $customer->extra_note)); ?></textarea>
            </div>

            <div class="form-check mb-4">
                <input type="hidden" name="is_important" value="0">
                <input type="checkbox" name="is_important" id="isImportantCheckbox" class="form-check-input"
                       value="1" <?php echo e(old('is_important', $customer->is_important) ? 'checked' : ''); ?>>
                <label for="isImportantCheckbox" class="form-check-label">Mark as Important</label>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Customer</button>
                <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php /**PATH /Users/venurawijesooriya/Desktop/DineMagik/CustomerApp/resources/views/customers/edit.blade.php ENDPATH**/ ?>