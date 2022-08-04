<?php

namespace Shopceed\FormBuilder\Http\Controllers\Api;

use Shopceed\FormBuilder\Http\Controllers\Controller;
use Shopceed\FormBuilder\Http\Requests\File\StoreFileRequest;
use Shopceed\FormBuilder\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(StoreFileRequest $request): JsonResponse
    {
        $data = $request->validated();
        $filePath = str_replace('tmp/', '', $data['path']);
        $storage = Storage::disk(config('form-builder.file.disk'));
        $storage->copy($data['path'], $filePath);

        File::create([
            'user_id' => $request->user()->id,
            'store_id' => $request->current_store_id,
            'disk' => config('form-builder.file.disk'),
            'extension' => $data['extension'],
            'content_type' => $data['contentType'],
            'path' => $filePath,
            'catalog' => $data['catalog'],
        ]);

        return response()->json([
            'path' => "$filePath.$data[extension]",
        ]);
    }

    public function destroy(FormRequest $request, string $path): JsonResponse
    {
        abort(403, 'Access denied');

        // TODO implement files deleting

        return response()->json('Ok');
    }
}
