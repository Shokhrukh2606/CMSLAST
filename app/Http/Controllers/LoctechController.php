<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LoctechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'good';
        $data['meta'] = (object) array('meta_title' => 'get title', 'meta_description' => 'get description');
        $data['body'] = 'home';
        $sliders = Post::where(array('group' => 'sliderMain', 'status' => 'active'))->orderBy('inserted_at', 'DESC')->take(4)->get();
        foreach ($sliders as $item) {
            if ($item->hasMedia('sliderMain')) {
                $item->imgPath = $item->getFirstMediaUrl('sliderMain');
            } else {
                $item->imgPath = false;
            }
            unset($item->media);
        }
        $data['about'] = (new Post)->onePost(24, 'menu');
        $data['services'] = (new Post)->postsWithGroupLimitMedia('services', 3);
        $data['partners'] = (new Post)->postsWithGroupLimitMedia('partners', 12);
        $data['sliders'] = $sliders;
        return view('index', $data);
    }
    public function products(Request $request)
    {
        $data['title'] = 'good';
        $data['meta'] = (object) array('meta_title' => 'get title', 'meta_description' => 'get description');
        $data['tags'] = (new Post)->postsWithGroupLimit('tags', 100);
        $data['body'] = 'products.index';
        return view('index', $data);
    }
    public function products_view($lang,$alias)
    {
        $data['title'] = 'good';
        $data['meta'] = (object) array('meta_title' => 'get title', 'meta_description' => 'get description');
        $item = Post::where('alias', $alias)->first();
        if ($item->hasMedia('products')) {
            $media = $item->getMedia('products')->reject(function ($item) {
                return isset($item->id) === false;
            })
                ->map(function ($item) {
                    return $item->getFullUrl();
                });
            $item->imgPaths = $media;
            unset($item->media);
        }
        $data['post']=$item;
        $data['body'] = 'products.view';
        return view('index', $data);
    }
    public function services(Request $request)
    {
        $data['title'] = 'good';
        $data['meta'] = (object) array('meta_title' => 'get title', 'meta_description' => 'get description');
        $data['services'] = (new Post)->postsWithGroupLimitMedia('services', 8);
        $data['body'] = 'services.index';
        return view('index', $data);
    }
    public function contacts(Request $request)
    {
        $data['title'] = 'good';
        $data['meta'] = (object) array('meta_title' => 'get title', 'meta_description' => 'get description');
        $data['services'] = (new Post)->postsWithGroupLimitMedia('services', 8);
        $data['body'] = 'contacts.index';
        return view('index', $data);
    }
}
