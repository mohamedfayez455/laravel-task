<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('file')) {
            foreach ($request->file as $fileData) {
                $this->storePhoto($fileData, 'posts');
                $this->storeAttachment($fileData);
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

    public function storeAttachment($fileData){
        return Attachment::create([
            'file' => $fileData->hashName(),
            'post_id' => \request('post_id'),
        ]);
    }

}
