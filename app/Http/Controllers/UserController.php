<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use DataTables;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<div class="btn-group">
                           <div class="btn-group">
                               <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                               </button>
                               <div class="dropdown-menu">
                                   <a class="dropdown-item" href="'.route('users.show',$row->id).'"><i class="fa fa-fw fa-eye mr-2"></i>View</a>
                                   <hr>
                                   <?php /* 
                                   @can("user-edit")
                                   */?>
                                   <a class="dropdown-item" href="'.route('users.edit',$row->id).'"> <i class="fa fa-fw fa-edit mr-2"></i>Edit</a>
                                   <hr>
                                   <?php /* 
                                   @endcan
                                   @can("user-delete")
                                   */?>
                                   <form action="'.route('users.destroy',$row->id).'"  method ="delete">
                                   <i class="fa fa-fw fa-trash ml-3"></i>
                                   <button type="submit" class="btn btn-dangers">Delete</button>
                                   </form>
                                   <?php /*
                                   @endcan
                                   */?>
                               </div>
                           </div>
                       </div>';
    
                            return $btn;
                    })
                    
                    ->addColumn('roles', function($row){
                    
                        $text = "";
                          if(!empty($row->getRoleNames())){
                        foreach($row->getRoleNames() as $v) {
                            $text .= '<label class="badge badge-success">'.$v.'</label>';
                        }
                        }
                        return $text;
                    })
                    ->rawColumns(['action','roles'])
                    ->make(true);
        }
        

       
        return view('users.index');
           
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}