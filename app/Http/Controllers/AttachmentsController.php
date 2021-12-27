<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentRequest;
use App\Models\Attachment;
use App\Repositories\AttachmentRepository;

class AttachmentsController extends Controller
{

    public function store(AttachmentRequest $request, AttachmentRepository $attachmentRepository): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('file')) {
            foreach ($request->file as $fileData) {
                $this->storePhoto($fileData, 'posts');
                $attachmentRepository->storeAttachment($fileData);
            }
        }
        return redirect()->route('posts.index')->with('success' , trans('admin.added_successfully'));
    }

    public function destroy(): \Illuminate\Http\RedirectResponse
    {
        $attachment = Attachment::findOrFail(\request('id'));
        $this->deletePhoto($attachment->file, 'posts');
        $attachment->delete();
        return redirect()->route('posts.index')->with('success' , trans('admin.deleted_successfully'));
    }

}
