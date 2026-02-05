<?php

/**
 * This file covers the Builder pattern, based on Refactoring.Guru
 * https://refactoring.guru/design-patterns/builder/php/example#example-1
 */
interface ProductBuilderInterface {
    public function setDetails(string $name, string $sku): ProductBuilderInterface;
    public function addVariant(string $color, string $size, float $price): ProductBuilderInterface;
    public function setShippingMethods(array $methods): ProductBuilderInterface;
    public function build(): object;
}

class ProductBuilder implements ProductBuilderInterface {
    private $product;

    public function __construct() {
        $this->reset();
    }

    private function reset(): void {
        $this->product = new \stdClass();
        $this->product->type = null;
        $this->product->variants = [];
    }

    public function setDetails(string $name, string $sku): ProductBuilderInterface {
        $this->product->base = ["name" => $name, "sku" => $sku];
        $this->product->type = 'physical';
        return $this;
    }

    public function addVariant(string $color, string $size, float $price): ProductBuilderInterface {
        if ($this->product->type === null) {
            throw new \Exception("Must set product details before adding variants");
        }
        
        $this->product->variants[] = compact('color', 'size', 'price');
        return $this;
    }

    public function setShippingMethods(array $methods): ProductBuilderInterface {
        if ($this->product->type !== 'physical') {
            throw new \Exception("Shipping only for physical products");
        }
        
        $this->product->shipping = $methods;
        return $this;
    }

    public function build(): object {   
        $data = $this->product;

        $finalProduct = new \stdClass();
        $finalProduct->title = $data->base['name'];
        $finalProduct->sku = $data->base['sku'];
        $finalProduct->all_variants = $data->variants;
        $finalProduct->delivery = isset($data->shipping) ? implode(', ', $data->shipping) : 'No Shipping';

        return $finalProduct;
    }
}

function createIphone(ProductBuilder $builder) {
    return $builder
        ->setDetails("iPhone 15", "IPH-15")
        ->addVariant("Blue", "128GB", 999)
        ->addVariant("Black", "256GB", 1099)
        ->setShippingMethods(["FedEx", "UPS"])
        ->build();
}

echo "Testing Product Builder:\n";
$iphone = createIphone(new ProductBuilder());
print_r($iphone);
