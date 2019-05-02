<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Adoption;
use App\Animal;
use App\User;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $animals = new Animal;
        #if filtering has been requested it will carryit out
        if($request->has('_token')){
            if($request->has('name')){
                $filterby =  $request->get('name')."%";
                $animals = $animals->where('name','like', $filterby);
            }
            if($request->has('type')){
                if($request->get('type') != "*"){
                    $animals = $animals->where('type',$request->get('type'));
                }
            }
            if($request->has('sort')){
                $animals = $animals->orderBy('name', $request->get('sort'));
            }
        }
        #if not an admin it will display only available ones
        if(Gate::denies('displayall')){
            $animals = $animals->where('status','available');
        }
        $animals = $animals->paginate(6)->appends($request->except('page'));
        return view('animals.index', compact('animals'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('displayall')){
        return view('animals.create');
        }else{
            return view('deny');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validates the form
        $animal = $this->validate(request(), [
            'name' => 'required|string|max:15',
            'dob' => 'required|date|before:today|after:2000-01-01',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'title' => 'required|max:60',
            'type' => 'required',
        ]);

        //uploading of image
        if($request->hasFile('image')){
            //get the filename with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //then gets filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //then gets just the extension
            $ext = $request->file('image')->getClientOriginalExtension();
            //formats the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            //uploads it 
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $animal = new Animal;
        $animal->name = $request->input('name');
        $animal->dob = $request->input('dob');
        $animal->description = $request->input('description');
        $animal->type=$request->input('type');
        $animal->title=$request->input('title');
        $animal->image = $fileNameToStore;
        $animal->created_at = now();

        $animal->save();

        return back()->with('success', 'Animal has been added');

        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::find($id);
        if(!auth()->guest()){
        $adoptionsCount = Adoption::where('animalid', $id)
                                ->where('userid', auth()->user()->id)
                                ->count();
        $adoption = Adoption::where('animalid', $id)
                                ->where('userid', auth()->user()->id)
                                ->first();
        if($adoptionsCount<= 0){
            $adoptionExist = false;
        }else{
            $adoptionExist = true;
        }
    }else{
        $adoptionExist = false;
        $adoptionsCount = 0;
    }
        if(Gate::allows('displayall')){
            $query = Adoption::where('animalid',$id)->where('status','accepted');
            $count = $query->count();
            $adopterid = "";
            $adopter = "";
            if($count>0){
                $adopterid = $query->first()->id;
                $adopter = User::find($adopterid)->name;
            }
            return view('animals.admin_show', compact('animal','adopter','adopterid'));
        }{
            return view('animals.show', compact('animal','adoptionExist' ,'adoption'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $animal = Animal::find($id);
        if(Gate::allows('displayall')){
        return view('animals.edit',compact('animal'));
        }else{
            return view('deny');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);
        //validates the form
        $this->validate(request(), [
            'name' => 'required|alpha|max:15',
            'dob' => 'required|date|before:today|after:01/01/2000',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'title' => 'required|max:60',
            'type' => 'required',
        ]);
        $animal->name = $request->input('name');
        $animal->dob = $request->input('dob');
        $animal->description = $request->input('description');
        $animal->type=$request->input('type');
        $animal->title=$request->input('title');
        $animal->updated_at = now();

        if($request->hasFile('image')){
            //get the filename with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            //then gets filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //then gets just the extension
            $ext = $request->file('image')->getClientOriginalExtension();
            //formats the filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            //uploads it 
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $animal->image = $fileNameToStore;
        $animal->save();

        return redirect('animals')->with('success','Animal has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return redirect('animals')->with('success','Animal has been deleted');
    }
}
