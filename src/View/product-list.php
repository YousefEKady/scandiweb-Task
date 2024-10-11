<form action="/scandiwebTask/public/product/delete" method="post">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Product List</h1>
        <div>
            <a href="/scandiwebTask/public/product/create" class="btn btn-primary">ADD</a>
            <button type="submit" class="btn btn-danger">MASS DELETE</button>
        </div>
    </div>
    <hr>
    <div class="row my-4">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <input type="checkbox" class="form-check-input delete-checkbox" name="sku[]"
                        value="<?= $product['sku'] ?>">
                    <div class="text-center">
                        <h5 class="card-title"><strong>SKU:</strong> <?= $product['sku'] ?></h5>
                        <p class="card-text"><strong>Name:</strong> <?= $product['name'] ?></p>
                        <p class="card-text"><strong>Price:</strong> <?= $product['price'] ?> $</p>
                        <p class="card-text"><strong>Type:</strong> <?= $product['type'] ?></p>
                        <?php if ($product['type'] === 'DVD'): ?>
                        <p class="card-text"><strong>Size:</strong> <?= $product['size'] ?> MB</p>
                        <?php elseif ($product['type'] === 'Furniture'): ?>
                        <p class="card-text"><strong>Dimension:</strong>
                            <?= $product['height'] . " * " . $product['width'] . " * " . $product['length'] ?></p>
                        <?php elseif ($product['type'] === 'Book'): ?>
                        <p class="card-text"><strong>Weight:</strong> <?= $product['weight'] ?> KG</p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p>No products found.</p>
        <?php endif; ?>
    </div>
</form>