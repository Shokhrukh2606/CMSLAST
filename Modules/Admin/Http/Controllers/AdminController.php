<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Post;
use Spatie\MediaLibrary\Models\Media;
use DateTime;
use Illuminate\Support\Facades\Input;
class AdminController extends Controller
{
    //   public function __construct()
    // {
    //     $this->middleware('auth');
    // }
     public function hello(Request $request){
        return 'hello';
    }
    public function index(Request $request)
    {
        $group = $request->query('group');
        if ($group == null) {
            return view('admin::index');
        } else {
            $posts = Post::getPosts(['group' => $_GET['group']], 15);
            return view('admin::' . $group . '.index', ['posts' => $posts]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $post = new Post;
        $post->group = $request->query('group');
        $post->status = 'inactive';
        $post->inserted_at=date('Y-m-d');
        $post->sort_order=$post->id;
        $post->save();
        return redirect()->route('posts.edit', [$post->group, $post->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group, $id)
    {
        //
        $post = Post::where('id', $id)->first();
        $mediaItems = $post->getMedia($post->group);
        $clearedMedia = [];
        foreach ($mediaItems as $item) {
            array_push($clearedMedia, array(
                'imgPath' => $item->getFullUrl(), 'name' => $item->name, 'imgID' => $item->id,
                'size' => $item->size
            ));
        }
        return view('admin::' . $group . '/edit', ['post' => $post, 'mediaItems' => $clearedMedia]);
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
        Input::merge(array_map(function ($value) {
            if (is_string($value)) {
                return trim($value);
            } else {
                return $value;
            }
        }, Input::all()));
        $validatedData = $request->validate([
            'alias' => 'unique:posts,alias,' . $id,
            'status' => 'required',
            'title'
        ], [
            'alias.required' => 'Вы должны ввести что-то в поле русский заголовок',
            'alias.unique' => 'Это название было добавлено, вы должны изменить поле слаг или изменить русский заголовок',
            'status.required' => 'Выберите статус'
        ]);
        $needed = array();
        if ($request->filled('title')) {
            $needed['title'] = json_encode($request->input('title'));
            $needed['status'] = $request->input('status');
        } else {
            $needed['status'] = 'inactive';
        }
        if ($request->filled('short_content')) {
            $needed['short_content'] = json_encode($request->input('short_content'));
        } else {
            $needed['short_content'] = '{"ru":null, "en":null, "oz":null, "uz":null}';
        }
        if ($request->filled('content_html')) {
            $needed['content_html'] = json_encode($request->input('content_html'));
        } else {
            $needed['content_html'] = '{"ru":null, "en":null, "oz":null, "uz":null}';
        }
        if ($request->filled('content')) {
            $needed['content'] = json_encode($request->input('content'));
        } else {
            $needed['content'] = '{"ru":null, "en":null, "oz":null, "uz":null}';
        }
        if ($request->filled('tags')) {
            $needed['tags'] = $request->input('tags');
        }
        if ($request->filled('options')) {
            $needed['options'] = $request->input('options');
        }
        if ($request->filled('inserted_at')) {
            $needed['inserted_at'] = DateTime::createFromFormat('d.m.Y', $request->input('inserted_at'));
        }
        $needed['alias'] = $request->input('alias');
        Post::where('id', $id)->update($needed);
        return redirect()->route('posts.index', array('group' => $request->input('group')));
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
        $post = Post::where('id', $id)->first();
        $post->clearMediaCollection($post->group);
        $post->delete();
        return back();
    }

    public function mediaAdd($id, Request $request)
    {
        $post = Post::where('id', $id)->first();
        if ($request->hasFile('file')) {
            $filePaths = [];
            $post->addMultipleMediaFromRequest(['file'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection($_GET['group'], 'posts');
            });
            $mediaItems = $post->getMedia($post->group);
            $clearedMedia = [];
            foreach ($mediaItems as $item) {
                array_push($clearedMedia, array(
                    'imgPath' => $item->getFullUrl(), 'name' => $item->name, 'imgID' => $item->id,
                    'size' => $item->size
                ));
            }
            return response()->json($clearedMedia);
        } else {
            return "bad";
        }
    }

    /**
     * Remove the specified media item from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function mediaDelete(Request $request)
    {
        $post = Post::where('id', $request->input('post_id'))->first();
        $post->deleteMedia($request->input("imgid"));
        //        Media::where('id', $request->input("imgid"))->forceDelete();
        return response()->json(array('success' => true));
    }
     /**
     * Make active the specified media item from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function mediaActivate(Request $request)
    {
        $media = Media::where('id', $request->input('mediaId'))->first();
        $media->order_column = 1;
        $media->save();
        //        Media::where('id', $request->input("imgid"))->forceDelete();
        return response()->json(array('success' => true));
    }
}
