<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\ImageVersion;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Rules\ExistsInDatabase;
use Illuminate\Support\Facades\Log;

class ImagenController extends Controller
{
      
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
           
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);

            if ($validator->fails()) {
               
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $manager = new ImageManager(new Driver());
            $imagen = $manager->read( $request->file('image'));

            $nombreUnico = Str::random(20) . time();

            $hash = hash('sha256', $nombreUnico);

            $hashImagen = substr($hash, 0, 15);

            $idNuevaImagen = $this->crearImagen($hashImagen);

            $nombreImagen = $nombreUnico . '.' .$request->file('image')->getClientOriginalExtension();
    
            $this->crearImagenVersion($imagen, 300, 'small', $nombreImagen, $idNuevaImagen);            
          
            $this->crearImagenVersion($imagen, 600, 'medium', $nombreImagen, $idNuevaImagen);
            
            $this->crearImagenVersion($imagen, 1200, 'large', $nombreImagen, $idNuevaImagen);
           
            return response()->json(['message' => 'Imagen subida exitosamente', 'imageId' => $hashImagen], 200);
        
    }


    private function crearImagen($hash)
    {
        $nuvaImagen = Image::create([
            'hash' => $hash
        ]);

        return $nuvaImagen->id;
    }

    private function crearImagenVersion($imagen, $size, $carpeta, $nombreImagen, $idImagen)
    {   
        $pathRelativoImagen = $carpeta . '/' . $nombreImagen;
        $pathPublic = public_path('imagenes/' . $pathRelativoImagen); 
        $imagen->resize($size, $size);
        $imagen->save($pathPublic);

        ImageVersion::create([
                'size' => $carpeta,
                'path' => $pathRelativoImagen,
                'image_id' => $idImagen
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($type, $imageHash)
    {
        Log::info("entramos el metdo show");
        $validator = Validator::make(compact('type', 'imageHash'), [
            'type' => 'required|in:small,medium,large', 
            'imageHash' =>  ['required', 'string', new ExistsInDatabase()],
        ]);

        if ($validator->fails()) {
            Log::info("falla la validacion");
            $imagenPath = public_path('imagenes/large/event_default.jpg');
            return response()->file($imagenPath);
        }

        $imagen = Image::where('hash', $imageHash)->first();

        $imagenVsersion = ImageVersion::where('image_id', $imagen->id)->where('size', $type)->first(); 
        
        $imagenPath = public_path('imagenes/' . $imagenVsersion->path);            

        if (file_exists($imagenPath)) {
            Log::info("encuentra la imagen");
            return response()->file($imagenPath);
        } else {
            Log::info("no encuentra la imagen");
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($hash)
    {
    
        $imagen = Image::where('hash', $hash)->first();

        if($imagen){

            $imagenVsersions = $imagen->imageVesrions;

            foreach($imagenVsersions as $imagenVsersion){
    
                $imagenPath = $imagenVsersion->path;
    
                $imagenPublicPath = public_path('imagenes/' . $imagenPath);
    
                if (File::exists($imagenPublicPath)) {
                    File::delete($imagenPublicPath);
                }   
            }

            $imagen->delete();

            return response()->json(['message' => 'Imagenes borradas exitosamente'], 200);

        }else{
           
            return response()->json(['error' => 'No se ha encontrado las imagenes relacionadas con el hash proporcionado'], 404);
        }

    }

}
