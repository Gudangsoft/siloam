<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PmbRegistrationExport;
use App\Http\Controllers\Controller;
use App\Models\PmbRegistration;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PmbController extends Controller
{
    public function index(Request $request)
    {
        $query = PmbRegistration::latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $registrations = $query->paginate(20);
        return view('admin.pmb.index', compact('registrations'));
    }

    public function show(PmbRegistration $pmb)
    {
        return view('admin.pmb.show', compact('pmb'));
    }

    public function updateStatus(Request $request, PmbRegistration $pmb)
    {
        $request->validate([
            'status' => 'required|in:pending,review,accepted,rejected',
            'notes'  => 'nullable|string',
        ]);

        $pmb->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        return redirect()->route('admin.pmb.show', $pmb)->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function export(Request $request)
    {
        $filename = 'data-pmb-' . now()->format('Ymd-His') . '.xlsx';
        return Excel::download(
            new PmbRegistrationExport($request->status, $request->search),
            $filename
        );
    }

    public function destroy(PmbRegistration $pmb)
    {
        $pmb->delete();
        return redirect()->route('admin.pmb.index')->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}
