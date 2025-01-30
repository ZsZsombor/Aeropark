<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\ExpiringDocument;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DocumentController extends Controller
{

    public function getUploadedDocuments(User $user)
    {
        return $user->documents()->latest()->get(); // Assuming the relationship exists
    }

    public function showUploadedDocuments(User $user)
    {
        $documents = $this->getUploadedDocuments($user);
        return view('users.documents', compact('user', 'documents'));
    }
    
    public function update(Request $request, User $user, Document $document)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        Document::updateOrCreate(
            ['user_id' => $user->id, 'id' => $document->id],
            ['is_approved' => $request->is_approved]          
        );

        return redirect()->back()->with('success', 'Document status updated successfully.');
    }



    public function store(Request $request, User $user)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096', // 4MB max file size
            'document_type' => 'required|string|max:255',
        ]);

        $path = $request->file('document')->store('documents', 'public');

        Document::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'file_path' => $path,
        ]);

        return redirect()->route('user.documents', $user)
            ->with('success', 'Document uploaded successfully!');
    }

    public function destroy(User $user, Document $document)
    {
        if (Storage::exists('public/' . $document->file_path)) {
            Storage::delete('public/' . $document->file_path);
        }

        $document->delete();

        return redirect()->route('user.documents', $user->id)->with('success', 'Document deleted successfully.');
    }



    public function updateAccessCard(Request $request, User $user)
    {
        $request->validate([
            'access_card_expiration_date' => 'required|date',
        ]);

        ExpiringDocument::updateOrCreate(
            ['user_id' => $user->id, 'document_type' => 'access_card'],
            ['expiration_date' => $request->access_card_expiration_date]
        );
        

        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'Access card expiration date updated successfully.');
    }


    public function updateCriminalRecord(Request $request, User $user)
    {
        $request->validate([
            'criminal_record_expiration_date' => 'required|date',
        ]);

        ExpiringDocument::updateOrCreate(
            ['user_id' => $user->id, 'document_type' => 'criminal_record'],
            ['expiration_date' => $request->criminal_record_expiration_date]
        );
        

        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'Access card expiration date updated successfully.');
    }




    public function downloadValidDocuments(User $user)
    {
        $validDocuments = $user->documents()->where('is_approved', true)->get();
        $zipFileName = strtolower(str_replace(' ', '_', $user->name)) . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($validDocuments as $document) {
                $filePath = storage_path('app/public/' . $document->file_path);

                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($document->file_path));
                }
            }
            $zip->close();
        }

        if (file_exists($zipFilePath)) {
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'No valid documents found for download.');
    }

}
