<?php

namespace App\GraphQL\Mutations\Product;

use App\Models\Product;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProduct',
        'description' => 'Creates a product'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
            'code' => [
                'name' => 'code',
                'type' => Type::string(),

            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'desc' => [
                'name' => 'desc',
                'type' => Type::nonNull(Type::string()),
            ],
            'units' => [
                'name' => 'units',
                'type' => Type::nonNull(Type::int()),
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::nonNull(Type::float()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $args['code'] = sha1(time());

        $product = new Product();
        $product->fill($args);
        $product->save();

        return $product;
    }
}