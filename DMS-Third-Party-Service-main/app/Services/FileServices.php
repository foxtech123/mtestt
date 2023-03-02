<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Collection;

class FileServices
{

    /**
     * validateApiKey
     *
     * @param  mixed $request
     * @return void
     */
    private function validateApiKey($request)
    {
        $apikey = $request->header('apikey');
        return User::where('apikey', $apikey)->exists();
    }

    public function uploadFile($request): Upload
    {
        if (!self::validateApiKey($request)) {
            return false;
        }

        $file            = $request->file('file');
        $document_source = $request->document_source;
        $fileExtension   = $file->getClientOriginalExtension();
        $fileMime        = $file->getClientMimeType();
        $fileSize        = $file->getSize();
        $saveFile        = $file->storePublicly('dms_storage', 's3', 'good');
        $filePath        = getenv('AMAZON_STORAGE_PATH') . $saveFile;

        return Upload::create([
            'document_source'      => str_replace(' ', '_', $document_source),
            'document_path'        => $filePath,
            'document_type'        => $fileExtension,
            'document_mime'        => $fileMime,
            'document_size'        => $fileSize,
            //-----
            'customer_id'          => $request->customer_id,
            'customer_photo_type'  => $request->customer_photo_type,
            'biometric_type'       => $request->biometric_type,
            'submission_date'      => $request->submission_date,
            'channel'              => $request->channel,
            'document_name'        => $request->document_name,
            'channel_ref_id'       => $request->channel_ref_id,
            'customer_mission'     => $request->customer_mission,
            'update_date'          => $request->update_date,
            'fingerprint_number'   => $request->fingerprint_number,
            //----
            'day_uploaded'         => date('l'),
            'month_uploaded'       => date('F'),
            'year_uploaded'        => date('Y'),
            'created_at'           => date('Y-m-d h:i:s'),
        ]);
    }

    public function getDocuments($request, $source): Collection
    {
        if (!self::validateApiKey($request)) {
            return false;
        }

        return Upload::where('document_source', $source)->paginate();
    }

    public function getDocumentsByRefId($request, $source, $id): Upload
    {
        if (!self::validateApiKey($request)) {
            return false;
        }

        return Upload::whereDocumentSourceAndChannelRefId($source, $id)->firstOrFail();
    }
}
