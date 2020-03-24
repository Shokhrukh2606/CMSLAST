<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ContactsController extends Controller
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
        $data['body'] = 'contacts.index';
        
        return view('index', $data);
    }
}
