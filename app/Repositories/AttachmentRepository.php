<?php

namespace App\Repositories;

use App\Models\Attachment;

class AttachmentRepository
{

    public function storeAttachment($fileData)
    {
        return Attachment::create([
            'file' => $fileData->hashName(),
            'post_id' => \request('post_id'),
        ]);
    }

}
