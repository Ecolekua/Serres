<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Conner\Tagging\Model\TagGroup;
use Conner\Tagging\Model\Tag;
use Alert;
class GroupTagsController extends Controller
{
    
    public $group=array();
    public $tagsGroup=array();
    public $f=0;
    public $valors;
    
    public function index(){

        $groups=TagGroup::where('slug','!=','')->get();
        return  view('GroupTags.index',compact('groups'));
    }

    public function create(){
        $groups=TagGroup::where('slug','!=','')->get();
        return view('GroupTags.create',compact('groups'));
    }

    public function store(request $request){
        //dd($request);

        $group=explode(',',$request->name);
        $elementos=count($group);

        $grupos=TagGroup::all();
        foreach($grupos as $grupo){
                for($i=0;$i<$elementos;$i++){
                    if ($group[$i]==$grupo->name){
                        Alert::error('El Nombre de Grupo ya existe.:  '.$grupo->name);
                        $groups=TagGroup::where('slug','!=','')->get();
                        return view('GroupTags.create',compact('groups'));
                    };    
               };
        };


        for($i=0;$i<$elementos;$i++){
            $id=TagGroup::create([
                'name'=>$group[$i],
                'slug'=>$group[$i],
               
            ]);
        };

        Alert::success('Grupo(s) ingresado(s) correctamente...');
        $groups=TagGroup::where('slug','!=','')->get();
        return view('GroupTags.create',compact('groups'));
    }

    public function NombresTags($id){
        
     $tags=Tag::where('tag_group_id',$id)->get();
        foreach($tags as $tagsG){
            $this->valors.=$tagsG->name.",";
           
        }
        return $this->valors;
    }

    public function NombresTagsQuitar($id){
        $tags=Tag::where('tag_group_id',$id)->get();
        foreach($tags as $tagsG){
            $this->valors.=$tagsG->name.",";
           
        }
        return $this->valors;
    }

    
}
