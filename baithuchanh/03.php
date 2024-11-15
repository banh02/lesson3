<?php
include_once "Product.php";
include_once "ProductManager.php";

use Services\ProductManager;
use Models\Product;

$productManager = new ProductManager();
$productManager->add(new Product("Laptop"));
$productManager->add(new Product("Mobile"));

$products = $productManager->getProducts();
foreach ($products as $product) {
    echo $product->getName() . "<br/>";
}