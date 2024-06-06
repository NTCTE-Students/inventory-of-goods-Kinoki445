<?php
namespace App\Http\Controllers;

use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::paginate(10);
        return view('index', compact('supplies'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        Supply::create($request->all());

        return redirect()->route('supplies.index')->with('success', 'Товар создан');
    }

    public function edit(Supply $supply)
    {
        return view('edit', compact('supply'));
    }

    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $supply->update($request->all());

        return redirect()->route('supplies.index')->with('success', 'Товар обновлен');
    }
}
