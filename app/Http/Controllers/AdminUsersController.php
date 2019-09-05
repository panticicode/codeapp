<?php
namespace App\Http\Controllers;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User :: all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = Role :: pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
		if(trim($request->password) == ''){
			$input = $request->except('password');
		}else{
			$input = $request->all();
			$input['password'] = bcrypt($request->password);/*THIS IS NOT WORKING*/
		}
		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);/**IF NOT IXSIST images FOLDER FUNCTION CREATED***/
			$photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
		}
		User :: create($input);
		Session :: flash('created', 'Congratulations, New User has been Created');
        return redirect('admin/users');
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
		$user = User :: findorFail($id);
		$roles = Role :: pluck('name','id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
		$user = User :: findorFail($id);
		if(trim($request->password) == ''){
			$input = $request->except('password');
		}else{
			$input = $request->all();
			$input['password'] = bcrypt($request->password);/*THIS IS NOT WORKING*/
		}
		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo :: create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
		$user->update($input);
		Session :: flash('updated', 'The User has been Updated');
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User :: findOrFail($id);
		if(!empty($user->photo)){
			unlink(public_path() . $user->photo->file);
			if($user->photo->file !== null){
			    $user->delete();
			}
		}else{
			$user->delete();
		}
		Session :: flash('deleted', 'The User has been Deleted');
		return redirect('/admin/users');
    }
}
