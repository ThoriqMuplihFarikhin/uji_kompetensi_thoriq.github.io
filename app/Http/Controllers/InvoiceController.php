<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Student;
use App\Models\sppplan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // TAMPILKAN SEMUA DATA
    public function index()
    {
        $invoices = Invoice::with(['student', 'spp'])->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    // FORM TAMBAH DATA
    public function create()
    {
        $students = Student::all();
        $spps = sppplan::all();

        return view('invoices.create', compact('students', 'spps'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'spp_plan_id'=> 'required',
            'period'     => 'required',
            'amount'     => 'required|numeric',
            'status'     => 'required',
        ]);

        Invoice::create($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice berhasil dibuat.');
    }

    // DETAIL
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    // FORM EDIT
    public function edit(Invoice $invoice)
    {
        $students = Student::all();
        $spps = sppplan::all();

        return view('invoices.edit', compact('invoice', 'students', 'spps'));
    }

    // UPDATE DATA
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'student_id' => 'required',
            'spp_plan_id'=> 'required',
            'period'     => 'required',
            'amount'     => 'required|numeric',
            'status'     => 'required',
        ]);

        $invoice->update($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice berhasil diupdate.');
    }

    // HAPUS DATA
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice berhasil dihapus.');
    }
}
