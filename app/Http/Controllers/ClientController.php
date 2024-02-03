<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function show(int $id)
    {
        $client = Client::find($id);

        if (is_null($client)) {
            return response()->json([
                "error" => "Client is not found"
            ], 404);
        }

        return response()->json($client);
    }

    public function store(Request $request)
    {
        $props = $request->validate([
            'name' => ['required'],
            'address' => [],
            'mobile_number' => ['required'],
            'whatsapp_number' => ['required', 'unique:clients'],
            'national_id' => ['unique:clients'],
        ]);

        Client::create($props);

        return response()->json([
            "message" => "Client Added successfully."
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        try {
            $client = Client::findOrFail($id);

            $client->name = $request->name ?? $client->name;
            $client->address = $request->address ?? $client->address;
            $client->mobile_number = $request->mobile_number ?? $client->mobile_number;
            $client->whatsapp_number = $request->whatsapp_number ?? $client->whatsapp_number;
            $client->national_id = $request->national_id ?? $client->national_id;
            $client->save();

            return response()->json([
                "message" => "Client updated."
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();

            return response()->json([
                "message" => "Client deleted."
            ], 204);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                "error" => $exception->getMessage()
            ], 404);
        }
    }
}
