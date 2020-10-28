<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('web');
    }

    public function allposts(){
        $data['posts'] = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.allposts',$data);
    }
    
    public function index(){
        $data['posts'] = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.list',$data);
    }

    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    public function create(){
        return view('posts.create');
        }

        public function store(Request $request){
            $result = $request->validate([
            'title' => 'required|regex:/^[A-z\s]+$/|max:150|unique:posts',
            'subtitle' => 'required|regex:/^[A-z0-9\-\_]+$/|max:50|unique:posts',
            'article' => 'required|max:1500',
            'rating' => 'required|numeric|between:0,5',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
            ]);
            //deal with the image, if any
            if( array_key_exists('image', $result) ){
            //there is an image to insert
            if( $request->file('image')->isValid() ){
            $filename = time() . "_" . $request->file('image')->getClientOriginalName();
            $result = $request->file('image')->move('images/', $filename);
            }else{
            //error - return message
            return redirect('posts.create')->with('error','Something went wrong with the file: please try again later.');
            }
            }
            //get data to insert into the table
            $data = $request->all();
            //remove token, if it exists
            if( array_key_exists('_token', $data) ){
            unset($data['_token']);
            }
            if ( !isset($filename) ){
            //there is no image to insert so use the default one
            $data['image'] = "defaultImage.jpg";
            }
            else{
            $data['image'] = $filename;
            }
            //insert new post
            Post::create($data);
            return redirect('posts')->with('success','Post Inserted!');
            }


    public function edit($id){
        $post = Post::find($id);
        //check if 'id' exists, as it is passed by get
        if ( empty($post) ){
            return redirect('posts')->with('error','Operação inválida.');
        }
        return view('posts.edit', ['post' => $post]);
        }

        public function update(Request $request, $id){
            //validate field (in this case, only rating
            $receivedPostData = $request->validate([
                'article' => 'nullable',
            'rating' => 'required|numeric|between:0,5',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
            ]);
            $originalPost = Post::find($id);
            if ( !empty($originalPost) ){
                //the table entry exists in the database
                //rating must exist and be filled. Here is has a correct value.
                $originalPost['rating'] = $receivedPostData['rating'];
                if( array_key_exists('article', $receivedPostData) && $receivedPostData['article'] != $originalPost['article']){
                    $originalPost['article'] = $receivedPostData['article'];
            }
                //image may not exist - nothing needs to change then
                if( array_key_exists('image', $receivedPostData) ){
                    //there is a valid image to replace the existing one
                    if( $request->file('image')->isValid() ){
                        $filename = time() . "_" . $request->file('image')->getClientOriginalName();
                        
                        $result = $request->file('image')->move('images/', $filename);
                        //add the new filename to the array and erase the previous file if it is not the default image
                        if ( $originalPost['image'] != 'defaultImage.jpg'){
                            unlink('images/' . $originalPost['image']);
            }
            $originalPost['image'] = $filename;
            }else{
            //error - return message
            return redirect('posts')->with('error','Aconteceu algo inesperado. Por favor tente mais tarde.');
            }
            } //update data
            $originalPost->save();
            return redirect('posts')->with('success','Dados do post atualizados!');
            }
            else{
            //error - return message
            return redirect('posts')->with('error','Operação inválida.');
            }
            }

    public function destroy($id){
        $post = Post::find($id);
        if ( !empty($post) && $post['image'] != 'defaultImage.jpg' && file_exists('images/'. $post['image']) ){
        unlink('images/' . $post['image'] );
        Post::where('id',$id)->delete();
        return redirect('posts')->with('success','Post apagado com sucesso.');
        }
        elseif ( !empty($post) ){
        Post::where('id',$id)->delete();
        return redirect('posts')->with('success','Post apagado com sucesso.');
        }
        else{
        return redirect('posts')->with('error','Operação inválida.');
        }
        }
    
}
