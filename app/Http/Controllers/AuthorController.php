<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::orderBy('full_name', 'asc')->get();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required |max:75',
            'birth_date' => 'date|date_format:Y-m-d',
            'country' => 'required|max:75',
            'image' => 'nullable|sometimes|image',
        ]);
        
        try{
            $author = new Author();
            $author->full_name = $request->full_name;
            $author->birth_date = $request->birth_date;
            $author->country = $request->country;
            $author->save();

            $image_name = $this->loadImage($request);
            if($image_name !=''){
                $author->image()->create(['url' => 'images/'.$image_name]);
            }
            
            return response()->json(['status' => true,
                                    'message' => 'EL autor '. $author->full_name . ' fue creado con exito.']);
                                    
        } catch(Exception $exc){
            return response()->json(['status' => false,
                                    'message' => 'Error al crear el registro']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::with(['profile'])->where('id', $id)->first();
        $image = null;
        if($author->image){
            $image = Storage::url($author->image['url']);
        }

        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $this->validate([
            'full_name' => 'required|max:75',
            'brith_date' => 'date|date_format:Y-m-d',
            'country' => 'required|max:75',
            'image' => 'nullable|sometimes|image',
        ]);
        
        try{
            $author = Author::findOrFail($id);
            $author->full_name = $request->full_name;
            $author->birth_date = $request->birth_date;
            $author->country = $request->country;
            $author->save();

            $image_name = $this->loadImage($request);
            if($image_name != ''){
                $author->image()->update(['url' => 'images/'. $image_name]);
            }

            return response()->json(['status' => true,
                                'message' => 'El autor '. $author->full_name.' se actualizo correctamente']);
        } catch (\Exception $exc) {
            return response()->json(['status' => false,
                                    'message' => 'Error al actualizar autor'. $exc]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $author = Author::findOrFAil($id);
            $author->delete();
            if ($author->image()){
                $author->image()->delete();
            }

            return response()->json(['status' => true,
                                    'message' => 'El autor '. $author->full_name .' fue eliminado exitosamente.']);
        }catch(Exception $exc){
            return response()->json(['status' => false,
                                    'message' => 'Error al elimianar el registro '.$exc]);
        }
    }

    /**
     * Load the author's image
     */
    public function loadImage($request){
        $image_name = '';
        if($request->hasFile('image')){
            $save_path = 'public/images';
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $request->file('image')->storeAs($save_path, $image_name);
        }
        return $image_name;
    }
}   