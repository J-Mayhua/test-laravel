<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'API de Gestión de Productos y Categorías',
    description: 'API REST para gestión de productos y categorías con Laravel'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Servidor Local'
)]
#[OA\Tag(name: 'Products', description: 'Gestión completa de productos')]
class ProductController extends Controller
{
    #[OA\Get(
        path: '/api/products',
        summary: 'Obtener lista de productos',
        tags: ['Products'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista de productos obtenida con éxito',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Productos obtenidos correctamente'),
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull'),
                                new OA\Property(property: 'description', type: 'string', example: 'Edición limitada'),
                                new OA\Property(property: 'price', type: 'number', example: 89.90),
                                new OA\Property(property: 'stock', type: 'integer', example: 50),
                                new OA\Property(property: 'category_id', type: 'integer', example: 1),
                            ]
                        ))
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json([
            'success' => true,
            'message' => 'Productos obtenidos correctamente',
            'data' => $products,
        ]);
    }

    #[OA\Post(
        path: '/api/products',
        summary: 'Crear un nuevo producto',
        tags: ['Products'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'price', 'stock', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull'),
                    new OA\Property(property: 'description', type: 'string', example: 'Camiseta negra edición limitada'),
                    new OA\Property(property: 'price', type: 'number', format: 'float', example: 89.90),
                    new OA\Property(property: 'stock', type: 'integer', example: 50),
                    new OA\Property(property: 'category_id', type: 'integer', example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Producto creado exitosamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto creado correctamente'),
                        new OA\Property(property: 'data', type: 'object')
                    ]
                )
            )
        ]
    )]
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'data' => $product,
        ], 201);
    }

    #[OA\Get(
        path: '/api/products/{id}',
        summary: 'Obtener un producto específico',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Detalle del producto',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto obtenido correctamente'),
                        new OA\Property(property: 'data', type: 'object')
                    ]
                )
            )
        ]
    )]
    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'Producto obtenido correctamente',
            'data' => $product->load('category'),
        ]);
    }

    #[OA\Put(
        path: '/api/products/{id}',
        summary: 'Actualizar un producto existente',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Camiseta Overskull Actualizada'),
                    new OA\Property(property: 'price', type: 'number', format: 'float', example: 99.90),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto actualizado exitosamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto actualizado correctamente'),
                        new OA\Property(property: 'data', type: 'object')
                    ]
                )
            )
        ]
    )]
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente',
            'data' => $product,
        ]);
    }

    #[OA\Delete(
        path: '/api/products/{id}',
        summary: 'Eliminar un producto',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Producto eliminado exitosamente',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'success', type: 'boolean', example: true),
                        new OA\Property(property: 'message', type: 'string', example: 'Producto eliminado correctamente'),
                    ]
                )
            )
        ]
    )]
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente',
        ]);
    }
}
