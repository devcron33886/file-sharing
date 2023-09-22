<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Department;
use App\Models\Document;
use App\Models\User;
use Exception;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('department', 'sender', 'receiver')->paginate(10);

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $departments = Department::all();
        $users = User::all();

        return view('documents.create', compact('departments', 'users'));
    }

    public function store(StoreDocumentRequest $request)
    {

        try {
            $document = Document::create($request->validated());
            $document->addMediaFromRequest('documents')->toMediaCollection('documents');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('documents.index')->with('success', 'Document created successfully');
    }

    public function show(Document $document)
    {
        $document = Document::findOrFail($document->id);

        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        $departments = Department::all();
        $users = User::all();

        return view('documents.edit', compact('document', 'departments', 'users'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        try {
            $document->update($request->validated());
            if ($request->hasFile('documents')) {
                $document->clearMediaCollection('documents');
                $document->addMediaFromRequest('documents')->toMediaCollection('documents');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('documents.index')->with('success', 'Document updated successfully');
    }

    public function destroy(Document $document)
    {
        try {
            $document->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully');
    }
}
