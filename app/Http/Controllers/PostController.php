<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   /* function __construct()
    {
      $this->middleware('jwt.auth')->only('index');
    }*/

    public function home(){
      return view('vueApp');
    }

    public function index()
    {
     return Post::orderBy('id','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
      'title' => 'required',
      'body' => 'required',
    ]);

    //\Log::info($request->all());//open laravel.log file

   /* $post = Post::create(
      $request->except('image') + ['user_id' => Auth::user()->id]
    );*/

    /*$post = Post::create([
      'title' => $request['title'],
      'body' => $request['body'],
      'user_id' => 5
    ]);*/

    $exploded = explode(',',$request->image);
    $decoded = base64_decode($exploded[1]);

    if(str_contains($exploded[0],'jpeg')){
      $extension = 'jpg';
    } else {
      $extension = 'png';
    }

    $fileName = str_random().'.'.$extension;

    $path = public_path().'/'.$fileName;

    file_put_contents($path, $decoded);

    $post= new Post();
    $post->title = $request->title;
    $post->body = $request->body;
    $post->image = $fileName;
    $post->user_id = Auth::user()->id;
    $post->save();


    return $post;

  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Post::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return Post::find($id);
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
      //dd($request->session());
      $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
      ]);

      $post = Post::find($id);
      if($post->count()){
        $post->update($request->all());
        return response()->json(['status'=>'success','msg'=>'Post updated successfully']);
      } else {
        return response()->json(['status'=>'error','msg'=>'error in updating post']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      if($post->count()){
        $post->delete();
        return response()->json(['status'=>'success','msg'=>'Post deleted successfully']);
      } else {
        return response()->json(['status'=>'error','msg'=>'error in deleting post']);
      }
    }
}
