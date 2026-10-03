<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * READ (Todos): Muestra el menú completo de Pimos ordenado por categoría.
     * Verbo HTTP: GET | URI: /api/products
     */
    public function index()
    {
        $products = Product::orderBy('categoria', 'asc')
                           ->orderBy('nombre', 'asc')
                           ->get();

        return response()->json([
            'status' => 'success',
            'count'  => $products->count(),
            'data'   => $products
        ], 200);
    }

    /**
     * CREATE: Registra un nuevo platillo o bebida en la base de datos pimos_db.
     * Verbo HTTP: POST | URI: /api/products
     */
    public function store(Request $request)
    {
        // 1. Reglas de validación estrictas
        $validatedData = $request->validate([
            'nombre'         => 'required|string|max:100|unique:products,nombre',
            'descripcion'  => 'nullable|string',
            'precio'        => 'required|numeric|min:0',
            'categoria'     => 'required|string|max:50',
            'image_path'   => 'nullable|string',
            'disponible' => 'boolean'
        ]);

        // 2. Inserción en la BD usando asignación masiva ($fillable)
        $product = Product::create($validatedData);

        // 3. Respuesta con código 201 (Created)
        return response()->json([
            'status'  => 'success',
            'message' => 'Platillo agregado al menú de Pimos exitosamente.',
            'data'    => $product
        ], 201);
    }

    /**
     * READ (Uno solo): Obtiene los detalles de un platillo específico por su ID.
     * Verbo HTTP: GET | URI: /api/products/{id}
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $product
        ], 200);
    }

    /**
     * UPDATE: Modifica los datos de un platillo (ej. cambiar precio o agotar stock).
     * Verbo HTTP: PUT o PATCH | URI: /api/products/{id}
     */
    public function update(Request $request, Product $product)
    {
        // La regla 'sometimes' permite actualizar solo 1 campo (ej. solo el precio)
        // sin obligar a enviar todo el objeto completo de nuevo.
        // En unique, concatenamos $product->id para que ignore su propio nombre actual.
        $validatedData = $request->validate([
            'nombre'         => 'sometimes|required|string|max:100|unique:products,nombre,' . $product->id,
            'descripcion'  => 'nullable|string',
            'precio'        => 'sometimes|required|numeric|min:0',
            'categoria'     => 'sometimes|required|string|max:50',
            'image_path'   => 'nullable|string',
            'disponible' => 'sometimes|boolean'
        ]);

        $product->update($validatedData);

        return response()->json([
            'status'  => 'success',
            'message' => 'Platillo actualizado correctamente.',
            'data'    => $product
        ], 200);
    }

    /**
     * DELETE: Elimina un platillo del catálogo.
     * Verbo HTTP: DELETE | URI: /api/products/{id}
     */
    public function destroy(Product $product)
    {
        $deletedName = $product->nombre;
        $product->delete();

        return response()->json([
            'status'  => 'success',
            'message' => "El platillo '{$deletedName}' fue eliminado del menú de Pimos."
        ], 200);
    }
}