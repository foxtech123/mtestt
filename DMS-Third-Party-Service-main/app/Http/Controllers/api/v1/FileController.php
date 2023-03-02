<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadRequest;
use App\Services\FileServices;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(protected FileServices $fileServices)
    {
    }

    public function uploadFile(UploadRequest $request)
    {
        try {
            $file = $this->fileServices->uploadFile($request);
            if (!$file)
                return response()->json(['success' => false, 'data' => ['message' => 'Unauthorized Request !!']], 401);
            return response()->json(['success' => true, 'data' => ['message' => $file]]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function getDocuments(Request $request, $source)
    {
        try {
            $file = $this->fileServices->getDocuments($request, $source);
            if (!$file)
                return response()->json(['success' => false, 'data' => ['message' => 'Unauthorized Request !!']], 401);
            return response()->json(['success' => true, 'data' => ['message' => $file]]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function getDocumentsByRefId(Request $request, $source, $id)
    {
        try {
            $file = $this->fileServices->getDocuments($request, $source, $id);
            if (!$file)
                return response()->json(['success' => false, 'data' => ['message' => 'Unauthorized Request !!']], 401);
            return response()->json(['success' => true, 'data' => ['message' => $file]]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
