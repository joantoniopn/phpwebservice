<?php

namespace App\Http\Controllers;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ClientsController extends Controller
{
    public function index()
    {
        return Client::all();
    }
    public function show($id)
    {
        if(!($client = Client::find($id)))
        {
           throw new ModelNotFoundException("usuário não encontrado.");
        }
        return $client;
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
        
        $client = Client::create($request->all());
        return response()->json($client,201);
    }
    public function update(Request $request, $id)
    {
        if(!($client = Client::find($id)))
        {
           throw new ModelNotFoundException("usuário não encontrado.");
        }
        $client->fill($request->all());
        $client->save();
        // return response()->json('',204);
        return response()->json('OK',200);
    }
    public function destroy($id)
    {
        if(!($client = Client::find($id)))
        {
           throw new ModelNotFoundException("usuário não encontrado.");
        }
        else
        {
            $client->delete();
            return response()->json('',204);
        }
    }

}
