<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    /* Metodo para obtener los registros o un registro en especifico por me dio del id */
    public function showData(Request $request)
    {
        // Obtener el valor del parámetro de consulta "id"
        $id = $request->query('id');
        
        // Filtrar los registros por el ID si se proporcionó
        $query = DB::table('characters');
        if ($id !== null) {
            $query->where('id', $id);
        }
        $data = $query->get();
        
        return response()->json( );
    }

    /* Metodo para la insercion de registros nuevos por medio de un cuerpo json
    En un Postman*/
    public function insertData(Request $request)
    {
        $data = $request->all();
        // Parsear campos con JSON anidado y arrays en formato de cadena
        $data['origin'] = json_decode($data['origin'], true);
        $data['location'] = json_decode($data['location'], true);
        $data['episode'] = json_decode($data['episode'], true);
    
        // Insertar un nuevo registro en la tabla
        DB::table('characters')->insert([
            'id' => $data['id'],
            'name' => $data['name'],
            'status' => $data['status'],
            'species' => $data['species'],
            'type' => $data['type'],
            'gender' => $data['gender'],
            'origin' => json_encode($data['origin']), // Convertir de nuevo a JSON para insertar
            'location' => json_encode($data['location']), // Convertir de nuevo a JSON para insertar
            'image' => $data['image'],
            'episode' => json_encode($data['episode']), // Convertir de nuevo a JSON para insertar
            'url' => $data['url'],
            'created' => $data['created'],
        ]);
        return response()->json(['message' => 'Registro insertado con éxito']);
    }
    
    /* Metodo para eliminar un registro por medio de un id */
    public function deleteData($id)
    {
        // Eliminar un registro por su ID
        DB::table('characters')->where('id', $id)->delete();
        
        return response()->json(['message' => 'Registro eliminado con éxito']);
    }
}


