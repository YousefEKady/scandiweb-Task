<form action="/scandiwebTask/public/product/store" method="post" id="product_form">
    <?php
    require_once 'errors.php';
    ?>
    <!-- Save and Cancel Buttons -->
    <div class="d-flex justify-content-between align-items-center">
        <h1>Product Add</h1>
        <div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="/scandiwebTask/public/product/index" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
    <hr />
    <!-- SKU, Name, Price Inputs -->
    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" id="sku" placeholder="SKU">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price ($)</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Price">
    </div>

    <!-- Type Switcher -->
    <div class="mb-3">
        <label for="productType" class="form-label">Type</label>
        <select name="type" class="form-select" id="productType" onchange="showDynamicSection()">
            <option value="" selected disabled>Select Type</option>
            <option value="DVD">DVD</option>
            <option value="Furniture">Furniture</option>
            <option value="Book">Book</option>
        </select>
    </div>

    <!-- Dynamic Section: DVD -->
    <div id="DVD" class="dynamic-section" style="display: none;">
        <div class="mb-3">
            <label for="size" class="form-label">Size (MB)</label>
            <input name="size" type="number" class="form-control" id="size" placeholder="Size in MB">
        </div>
        <p class="text-muted">"Please provide the size of the DVD in MB"</p>
    </div>

    <!-- Dynamic Section: Furniture -->
    <div id="Furniture" class="dynamic-section" style="display: none;">
        <div class="mb-3">
            <label for="height" class="form-label">Height (CM)</label>
            <input name="height" type="number" class="form-control" id="height" placeholder="Height in CM">
        </div>
        <div class="mb-3">
            <label for="width" class="form-label">Width (CM)</label>
            <input name="width" type="number" class="form-control" id="width" placeholder="Width in CM">
        </div>
        <div class="mb-3">
            <label for="length" class="form-label">Length (CM)</label>
            <input name="length" type="number" class="form-control" id="length" placeholder="Length in CM">
        </div>
        <p class="text-muted">"Please provide dimensions in HxWxL format"</p>
    </div>

    <!-- Dynamic Section: Book -->
    <div id="Book" class="dynamic-section" style="display: none;">
        <div class="mb-3">
            <label for="weight" class="form-label">Weight (KG)</label>
            <input name="weight" type="number" class="form-control" id="weight" placeholder="Weight in KG">
        </div>
        <p class="text-muted">"Please provide the weight of the book in KG"</p>
    </div>
</form>

<script>
function showDynamicSection() {
    // Get the selected product type
    const selectedType = document.getElementById('productType').value;

    // Hide all dynamic sections
    const dynamicSections = document.querySelectorAll('.dynamic-section');
    dynamicSections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the relevant section based on the selected type
    if (selectedType) {
        const selectedSection = document.getElementById(selectedType);
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }
}
</script>