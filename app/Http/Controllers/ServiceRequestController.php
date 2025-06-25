<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    // Halaman Home
    public function index()
    {
        $services = [
            'Turnitin Plagiarism Check',
            'Paid Journal Download',
            'Document Paraphrasing',
            'Document Formatting',
            'Document Translation'
        ];
        return view('home', compact('services'));
    }

    // Halaman Form berdasarkan tipe layanan
    public function create($type)
    {
        return view('form', ['serviceType' => $type]);
    }

    // Simpan data dari form
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui form
        $validated = $request->validate([
            'service_type' => 'required|string',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'link_article' => 'nullable|url', // Link artikel (optional)
            'file' => 'nullable|file|max:2048', // File upload (optional)
            'note' => 'nullable|string',
        ]);

        // Jika ada file yang diupload, simpan file tersebut dan ambil path-nya
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->move(public_path('uploads'), $fileName);
            $validated['file_path'] = 'uploads/' . $fileName;
        }

        // Jika ada link artikel yang diberikan, simpan di database
        if ($request->has('link_article')) {
            $validated['link_article'] = $request->input('link_article');
        }

        // Menyimpan data service request ke dalam database
        ServiceRequest::create($validated);

        // Redirect kembali dengan pesan sukses
        return redirect('/')->with('success', 'Request submitted, Silahkan tunggu admin menguhubungi Anda');
    }
}
