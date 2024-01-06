<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CommentResource;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
                'comment' => 'required|string',
                'rating' => 'required|integer|between:1,5',
            ]);

            $comment = new Comment();
            $comment->product_id = $validatedData['product_id'];
            $comment->name = $validatedData['name'];
            $comment->comment = $validatedData['comment'];
            $comment->rating = $validatedData['rating'];
            $comment->status = 1;
            $comment->save();

            return response()->json(['message' => 'Comentario creado exitosamente.', 'comment' => new CommentResource($comment)], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el comentario. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comment = Comment::find($id);

            if (!$comment) {
                return response()->json(['message' => 'Comentario no encontrado'], 404);
            }

            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'comment' => 'sometimes|string',
                'rating' => 'sometimes|integer|between:1,5',
            ]);

            $comment->fill($validatedData);
            $comment->save();
            return response()->json(['message' => 'Comentario actualizado exitosamente.', 'comment' => new CommentResource($comment)]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el comentario. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $comments = Comment::all();

            if ($comments->isEmpty()) {
                return response()->json(['message' => 'No hay comentarios disponibles'], 404);
            }

            return CommentResource::collection($comments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los comentarios. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function show($productId)
    {
        try {
            $comments = Comment::where('product_id', $productId)->get();

            if ($comments->isNotEmpty()) {
                return CommentResource::collection($comments);
            } else {
                return response()->json(['message' => 'No se encontraron comentarios para este producto'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener comentarios. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::find($id);

            if (!$comment) {
                return response()->json(['message' => 'Comentario no encontrado'], 404);
            }
            $comment->delete();

            return response()->json(['message' => 'Comentario eliminado exitosamente']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Error al eliminar el comentario. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
