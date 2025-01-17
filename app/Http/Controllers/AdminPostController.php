<?php

namespace App\Http\Controllers;
use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts = Post :: paginate(2);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category :: pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
		$input = $request->all();
		$user = Auth :: user();
		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo :: create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
        $user->posts()->create($input);
		Session :: flash('created', 'Congratulations, New Post has been Created');
		return redirect('admin/posts');
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
		$post = Post :: findOrFail($id);
		$categories = Category :: pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        $input = $request->all();
		if($file = $request->file('photo_id')){
			$name = time() . $file->getclientOriginalName();
			$file->move('images', $name);
			$photo = Photo :: create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}
		Auth :: user()->posts()->whereId($id)->first()->update($input);
		Session :: flash('updated', 'The Post has been Updated');
		return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post :: findOrFail($id);
        //return public_path() . $post->photo->file;
		if(!empty($post->photo->file)){
			unlink(public_path() . $post->photo->file);	
			if($post->photo->file !== null){
			    $post->delete();   
			}
		}else{
			$post->delete();
		}
		Session :: flash('deleted', 'The Post has been Deleted');
		return redirect('admin/posts');
    }
	/***********CUSTOM FUNCTION FOR COMMENT-POST***********/
	public function post($slug){
		$post = Post :: findBySlugOrFail($slug);
		$comments = $post->comments()->whereIsActive(1)->get();/**this is not been here**/	
		return view('post', compact('post','comments'));
	}
}
