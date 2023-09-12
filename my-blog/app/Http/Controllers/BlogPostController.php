<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT * FROM `blog_posts` 
        $posts = BlogPost::all();
        return view('blog.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert into blog_posts(title, body) values (?, ?);
        //return $newData = select * from blog_post where id = lastInsertedId
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1
        ]);
        
        return redirect(route('blog.index'))->withSuccess('Donnée saisit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //$blogPost = SELECT * FROM `blog_posts` WHERE id = $blogPost;
        //$stmt = $connex->prepare(SELECT * FROM `blog_posts` WHERE id = ?)
        //$stmt->execute(array(10));
        //$stmt-fetch();
        /*   $query = BlogPost::select()
                ->join('users', 'user_id', '=','users.id')
                ->where('blog_posts.id', 1)
                //->orderby('title')
                ->get();*/
                
        return view('blog.show', ['blogPost' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.edit', ['blogPost' => $blogPost]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        //return $request;
        //return $blogPost;
       
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        
        return redirect(route('blog.show', $blogPost->id))->withSuccess('Donnée mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //return $blogPost;
        $blogPost->delete();

        return redirect(route('blog.index'))->withSuccess('Donnée effacée');
    }
    public function query(){
    //SELECT
    //select * from blog_posts;
       // $query = BlogPost::all();
       // $query = $query[0];

       //$query = BlogPost::select()->get();
       //$query = BlogPost::select()->first();

       /*$query = BlogPost::select('title', 'body')
                ->orderby('title', 'desc')
                ->get();
        */

        //WHERE
        //SELECT * FROM blog_posts WHERE id = 1;

        /*$query = BlogPost::select()
                ->where('id','=', 1)
                ->get();
         afficher la donnee = $query[0]->id
        */
        /*$query = BlogPost::select()
                ->where('id','=', 1)
                ->first();
        afficher la donnee = $query->id
        */
        /*
        WHERE PK
        $query = BlogPost::find(1);
        afficher la donnee = $query->id
        */
        /*
        $query = BlogPost::select()
                ->where('user_id','!=', 1)
                ->get();
        */
        //AND
        /*$query = BlogPost::select()
                ->where('user_id','!=', 1)
                ->where('title', 'Amet aliquam sequi aut et.')
                ->get();
        */
        /*
        $query = BlogPost::select()
                ->where('user_id','!=', 1)
                ->where('title', 'like','Am%')
                ->get();
        */
        //OR
        /*$query = BlogPost::select()
                ->where('user_id', 1)
                ->orwhere('id',2)
                ->get();
        */

        //JOIN INNER
        $query = BlogPost::select()
                ->join('users', 'user_id', '=','users.id')
                ->where('blog_posts.id', 1)
                //->orderby('title')
                ->get();
        
        //OUTER INNER   
        /*$query = BlogPost::select()
            ->rightJoin('users', 'user_id', '=','users.id')
            ->get();
        */

        //Aggregation function : Max, Min, Avg, Count, Sum

        /*$query = BlogPost::count('id');*/

        /*$query = BlogPost::select()
        ->where('user_id', 1)
        ->count();
        */

        //raw queries

        // SELECT count(*) as blogs, user_id FROM blog_posts group by user_id

        /*$query = BlogPost::select(DB::raw('count(*) as blogs'), 'user_id')
                ->groupBy('user_id')
                ->get();
        */

        return $query;
    }

    public function page(){
        $blogPost = BlogPost::Select()
                    ->paginate(5);

        return view('blog.page', ['blogPosts' => $blogPost]);
    }

}
