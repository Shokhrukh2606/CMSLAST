<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FnewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('main') && ($request->input('main') == true)) {
            $posts = Post::where(array('group' => 'news', 'status' => 'active'))->orderBy('inserted_at', 'DESC')->take(4)->get();
            foreach ($posts as $item) {
                if ($item->hasMedia('news')) {
                    $media = $item->getMedia('news')->reject(function ($item) {
                        return isset($item->id) === false;
                    })
                        ->map(function ($item) {
                            return $item->getFullUrl();
                        });
                    $item->imgPaths = $media;
                    unset($item->media);
                }else{
                    $item->imgPaths=false;
                }
            }
        } {
            $posts = Post::where(array('group' => 'news', 'status' => 'active'))->orderBy('inserted_at', 'DESC')->paginate(15);
            foreach ($posts as $item) {
                if ($item->hasMedia('news')) {
                    $media = $item->getMedia('news')->reject(function ($item) {
                        return isset($item->id) === false;
                    })
                        ->map(function ($item) {
                            return $item->getFullUrl();
                        });
                    $item->imgPaths = $media;
                    unset($item->media);
                }else{
                    $item->imgPaths=false;
                }
            }
        }
        header("Access-Control-Allow-Origin: *");
        return response()->json($posts);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Post::where('id', $id)->first();
               $item->imgPath = array_map(function ($item){
                   return $item->getFullUrl();
               }, get_object_vars($item->getMedia('news')));
               unset($item->media);
        if ($item->hasMedia('news')!==null) {

            $media = $item->getMedia('news')->reject(function ($item) {
                return isset($item->id) === false;
            })
                ->map(function ($item) {
                    return $item->getFullUrl();
                });
            $item->imgPaths = $media;
            unset($item->media);
        }
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
