<?php

namespace App\Http\Controllers;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminMediaController extends Controller
{
   public function index(){
	   $photos = Photo :: all();
	   return view('admin.media.index', compact('photos'));
   }
   public function create(){
	   return view('admin.media.create');
   }
   public function store(Request $request){
	   $file = $request->file('file');
	   $name = time() . $file->getClientOriginalName();
	   $file->move('images', $name);
	   Photo :: create(['file'=>$name]);
	   Session :: flash('created', 'Congratulations, New Photo has been Uploaded');
   }
   public function destroy($id){
	   $photo = Photo :: findOrfail($id);
	   if(!empty(public_path())){
		   unlink(public_path() . $photo->file);
		   $photo->delete();
	   }
	   Session :: flash('deleted', 'The Photo has been Deleted');
	   return redirect('admin/media');
   }
}
