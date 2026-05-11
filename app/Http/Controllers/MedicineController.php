<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('supplier')->get();
        return response()->json($medicines, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $medicine = Medicine::create($request->all());
        return response()->json($medicine, 201);
    }

    public function show($id)
    {
        $medicine = Medicine::with('supplier')->find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Medicine not found'], 404);
        }
        return response()->json($medicine, 200);
    }

    public function update(Request $request, $id)
    {
        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Medicine not found'], 404);
        }

        $medicine->update($request->all());
        return response()->json($medicine, 200);
    }

    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Medicine not found'], 404);
        }

        $medicine->delete();
        return response()->json(['message' => 'Medicine deleted successfully'], 200);
    }
}