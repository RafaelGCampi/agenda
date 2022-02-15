<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    public function index()
    {
        return view('contato.list');
    }

    public function create(Request $request)
    {
        $request->validate([
            'nome'=>'required|string',
            'email'=>'required|email'
        ]);
        try{
            DB::beginTransaction();
            $data = $request->all();
            //dd($request->id);
            $contato = Contato::createOrUpdate($data);
            DB::commit();
            return response()->json(['status'=>true, 'contato'=>$contato]);
        }
        catch(Exception $exception){
            DB::rollback();
            return response()->json(['status'=>false,'erro'=>$exception->getMessage()],402);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required|string',
            'email'=>'required|email'
        ]);
        try{
            DB::beginTransaction();
            $data = $request->all();
            $contato = Contato::createOrUpdate($data);
            DB::commit();
            return response()->json(['status'=>true,'message'=>'Contato criado com sucesso.','contato'=>$contato]);
        }
        catch(Exception $exception){
            DB::rollback();
            return response()->json(['status'=>false,'erro'=>$exception->getMessage()],402);
        }
    }

    public function show(Contato $contato)
    {
        return view('contato.componentes.form');
    }

    public function edit(Contato $contato)
    {
        return response($contato);
    }

    public function destroy(Contato $contato)
    {
        try{
            DB::beginTransaction();
            $contato->delete();
            DB::commit();
            return response()->json(['status'=>true,'message'=>'Delado com sucesso.']);
        }
        catch(Exception $exception){
            DB::rollback();
            return response()->json(['status'=>false,'message'=>$exception->getMessage()],402);
        }
    }
    public function list()
    {
        $contatos = Contato::get();
        return response($contatos);
    }
}
