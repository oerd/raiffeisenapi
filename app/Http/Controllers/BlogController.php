<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use MongoDB\Driver\Exception\ExecutionTimeoutException;
use App\PhotoBlog;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\QueryException;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use UploadRequest;

class BlogController extends Controller
{
    public function index() {
        $category = Category::with('posts')->get();
        return view ('admin.micasa.blog.show', compact('category','posts'));
    }

    public function addCategory() {
        return view ('admin.micasa.blog.category.add');
    }

    public function editCategory($id_category) {
        $category = Category::find($id_category);
        return view ('admin.micasa.blog.category.edit', compact('category'));
    }

    public function showPosts($id_posts) {
        $post = Post::find($id_posts);
        return view ('admin.micasa.blog.posts.show', compact('post'));
    }

    public function addPosts() {
        $category = Category::all();
        return view ('admin.micasa.blog.posts.add', compact('category'));
    }

    public function editPosts($id_posts) {
        $post = Post::find($id_posts);
        return view ('admin.micasa.blog.posts.edit',compact('post'));
    }

    public function addCat() {
        $title = request('title');
        try{
            $category = Category::create([
                'title' => $title
            ]);
            return Response::json(["response" => "Success", "message" => "Category created"]);
        }catch(Exception $e){
            return Response::json(["reponse" => "Error", "message" => "Category could not be addedd"]);
        }
    }

    public function editCat($id_category) {
        $title = request('title');
        try{
            $category = Category::find($id_category);
            $category->title = $title;
            $category->save();
            return Response::json(["response" => "Success", "message" => "Category created"]);
        }catch(Exception $e){
            return Response::json(["reponse" => "Error", "message" => "Category could not be addedd"]);
        }
    }

    public function deleteCat($id_category) {
        try{
            Category::destroy($id_category);
            return Response::json(["response" => "Success", "message" => "Category deleted!"]);
        }catch(Exception $e) {
            return Response::json(["reponse" => "Error","message" => "Category could not be deleted!"]);
        }
    }

    public function editPost($id_post) {
        $title = request('title') ? null : request('title');
        $id_category = request('id_category') ? null : request('id_category');
        $description = request('description') ? null : request('description');
        try{
            $post = Post::find($id_post);
            $post->title = $title;
            $post->description = $description;
            $post->id_category = $id_category;
            $post->save();
            return Response::json(["response" => "Success", "message" => "Post updated!"]);
        } catch(Exception $e){
            return Response::json(["response" => "Error", "message" => "Something went wrong ". $e->getMessage()]);
        }
    }

    public function addPost() {
        $title = request('title');
        $cover = Input::file('cover');
        $id_category = request('id_category');
        $description = request('description');
        $name = $cover->hashName();
        $path = '/home/shtepiai/public_html/storage/'.$name;
        $image = Image::make($cover->getRealPath());
        $image->save($path, 90);
        dd(request()->all());
        try{
            $post = Post::create([
                'title' => $title,
                'cover' => $name,
                'description' => $description,
                'id_category' => $id_category
            ]);
            return Response::json(["response" => "Success", "message" => "Post addedd!"]);
        }catch(Exception $e){
            return Response::json(["response" => "Error", "message" => "Post could not be addedd!"]);
        }
    }

    public function deletePost($id_post){
        try{
            Post::destroy($id_post);
            return Response::json(["response" => "Success", "message" => "Post deleted!"]);
        } catch(Exception $e) {
            return Response::json(["response" => "Error", "message" => "Post could not be deleted!"]);
        }
    }
}