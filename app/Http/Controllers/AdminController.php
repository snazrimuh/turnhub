<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class AdminController extends Controller
{
    // Menampilkan daftar permintaan layanan
    public function showServiceRequests()
    {
        $serviceRequests = ServiceRequest::orderBy('created_at', 'desc')->paginate(10); // Menggunakan pagination
        return view('admin.index', compact('serviceRequests'));
    }

    // Menghapus permintaan layanan
    public function deleteServiceRequest($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->delete();

        return redirect()->route('admin.service_requests.index')->with('success', 'Service request deleted successfully.');
    }

    // Mengunduh file permintaan layanan
    public function downloadServiceRequestFile($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        if ($serviceRequest->file_path && file_exists(public_path($serviceRequest->file_path))) {
            return response()->download(public_path($serviceRequest->file_path));
        }

        return redirect()->route('admin.service_requests.index')->with('error', 'File not found.');
    }

    // Tandai selesai atau belum selesai
    public function toggleComplete($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->is_completed = !$serviceRequest->is_completed;
        $serviceRequest->save();

        return redirect()->route('admin.service_requests.index')->with('success', 'Service request status updated successfully.');
    }
}
