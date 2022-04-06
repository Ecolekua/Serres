<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conner\Tagging\Model\Tag;
use Conner\Tagging\Model\TagGroup;
use Alert;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetas=Tag::all();
        return view('Tags.index',compact('etiquetas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etiquetas=Tag::all();
        $groups=TagGroup::all();
        return view('Tags.create',compact('etiquetas','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tags=explode(',',$request->name);
        //dd($request);
        $elementos=count($tags);
    
        $etiquetas=Tag::all();
        foreach($etiquetas as $etiqueta){
                for($i=0;$i<$elementos;$i++){
                    if ($tags[$i]==$etiqueta->name){
                        Alert::error('Esta Etiqueta ya existe.:  '.$etiqueta->name);
                        return back();
                    };    
               };
        };


        for($i=0;$i<$elementos;$i++){
            $id=Tag::create([
                'name'=>$tags[$i],
                'slug'=>$tags[$i],
                'description'=>$request->description,
                'name_group'=>$request->tag_group_id,
            ]);
            if($request->tag_group_id!=''){
                $tagsId=Tag::find($id->id);
            $tagsId->setGroup($request->tag_group_id);
            }
            
        };



        Alert::success('Etiquetas ingresadas correctamente...');
        $etiquetas=Tag::all();
        $groups=TagGroup::all();
        return view('Tags.create',compact('etiquetas','groups'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //dd($id);
        $tag=Tag::where('id',$id)->get();
        //dd($tag);
        $groups=TagGroup::all();
        return view('Tags.edit',compact('tag','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $tag=Tag::where('id',$request->id)->update(['name'=>$request->name,'description'=>$request->description,'tag_group_id'=>$request->id_group]);
        Alert::success('Etiqueta Actualizada correctamente...');
        $etiquetas=Tag::all();
        return view('Tags.index',compact('etiquetas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $tag=Tag::where('id',$id)->get();
        foreach($tag as $tag){
            if ($tag->count>0){
                return 0;
            }
    }
        
        $borrar=Tag::where('id',$id)->delete();
        return 1;
    }

    public function NombreTags($id){

        $tags=Tag::where('id',$id)->get();
        foreach($tags as $tag){
            $this->resultado = $tag->name;
        }
        return $this->resultado;
    }

}
