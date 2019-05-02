<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Adoption;
use App\Animal;
use App\User;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->guest()){
            return view('deny');
        }else{
            #checks if any filtering has been requested
            if($request->has('_token')){
                $adoptions = new Adoption;
                #gets all the queries to filter
                $queries = $this->filterhelper($request);
                #filters them
                foreach ($queries as $key => $value) {
                    if(isset($value)){
                        $adoptions = $adoptions->where($key, $value);
                    }
                }
                #if its not admin the only that user's adoptions should get added
                if(Gate::denies('displayall')){
                    $adoptions = $adoptions->where('userid', auth()->user()->id);
                }  
                #paginates and adds the queries to pages
                $adoptions = $adoptions->paginate(6)->appends($request->except('page')); 
            }else{
            #if no request has been added then it will check if admin it will show everything
                if(Gate::allows('displayall')){
                    $adoptions = Adoption::paginate(6);
                }else{
                    $adoptions = Adoption::where('userid', auth()->user()->id)->paginate(6)->appends($request->except('page'));
                }
            }
        }

        return view('adoptions.index', compact('adoptions'));
    }

    /**
     * Helper method to create a list of queries
     */
    private function filterhelper(Request $request){
        if($request->has('id')){
            $filterby = $request->get('id');
            $queries['id']=$filterby;
        }
        if($request->has('userid')){
            $filterby = $request->get('userid');
            $queries['userid']=$filterby;
        }
        if($request->has('animalid')){
            $filterby = $request->get('animalid');
            $queries['animalid']=$filterby;
        }
        if($request->has('status')){
            if($request->get('status') != "*"){
                $queries['status']=$request->get('status');
            }

        }
        return $queries;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'animalid'=>'required',
        ]);
        $adoption = new Adoption;
        $adoption->animalid = $request->get('animalid');
        $adoption->userid = auth()->user()->id;
        $adoption->save();
        return redirect('adoptions')->with('success', 'Adoption request has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #it will not allow any guest users to view adoptions 
        if(auth()->guest()){
            return view('deny');
        }else{
            $adoption = Adoption::find($id);
            if(isset($adoption)){
                $animal = Animal::find($adoption->animalid);
                $user = User::find($adoption->userid);
            #if user is admin, the admin view should show
                if(Gate::allows('displayall')){
                    return view('adoptions.admin_show', compact(['animal','adoption','user']));
                }else{
                    return view('adoptions.show', compact(['animal','adoption','user']));
                }
            }
        }
        
    }
    /*
    *edit the adoptions and animal
    **/
    public function accept($id)
    {
       $this->changeStatus($id, 'accepted');
       $adoption = Adoption::find($id);
       $animal = Animal::find($adoption->animalid);
         #updates the status of animal
       $animal->status = 'adopted';
       $animal->save();
       $otherAdoptions = Adoption::where('status', 'pending')
       ->where('animalid', $adoption->animalid)->get();
        #goes through all adoptions for that animal and rejects them
       foreach ($otherAdoptions as $other ) {
           $this->changeStatus($other->id, 'rejected');
       }
       return redirect('adoptions')->with('success', 'Adoption request has been changed');
   }
   public function reopen($id)
   {
       $this->changeStatus($id, 'pending');
       return redirect('adoptions')->with('success', 'Adoption request has been changed');
   }
   public function reject($id)
   {
    $this->changeStatus($id, 'rejected');
    return redirect('adoptions')->with('success', 'Adoption request has been changed');
}

    /*
    * Helper method to change the status
    */
    private function changeStatus($id, $status){
        $adoption = Adoption::find($id);
        $adoption->status = $status;
        $adoption->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adoption = Adoption::find($id);
        $adoption->delete();
        return redirect('adoptions')->with('success','Adoption has been deleted');
    }
}
