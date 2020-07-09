<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('welcome',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('posts.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        
        $post = $request->validated();

        if($request->hasFile('image')){

            $image =$request->file('image');

            $path= $image->store('uploads','public');
            if($path){

                Post::create([
                    'title' => $request->get('title'),
                    'content' => $request->get('content'),
                    'image' => $path,
                    
                    ]);
            }


        }

        return redirect('/')->with('message',"Post create successfully");



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //

        return view('posts.edit',compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id,PostUpdateRequest $request){

        $post = $request->validated();
        if($request->hasFile('image')){
            $image =$request->file('image');
            $path= $image->store('uploads','public');
                Post::where('id',$id)->update([
                    'title' => $request->get('title'),
                    'content' => $request->get('content'),
                    'image' => $path,
                    
                    ]);     
                }
                $this->NoImageUpdate($id,$request);

        return redirect('/')->with('message',"Post update successfully");

    }
    
    public function NoImageUpdate($id,PostUpdateRequest $request){

        return Post::where('id',$id)->update([
            'title' => $request->get('title'),
           
            'content' => $request->get('content'),
            // 'image' => $path,
            
            ]);

    }



    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if($post->delete()){
            return redirect()->back()->with('message','Post deleted successfully.');
        }else{
            return redirect()->back()->with('message','Post is not deleted yet.');

        }

    }
}
