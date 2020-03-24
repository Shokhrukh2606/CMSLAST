<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    //
    use HasMediaTrait;
    protected $table = 'posts';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'group'];
    protected $attributes = [
        'status' => 'active',
    ];

    public static function getPosts(array $needed, $per_page)
    {
        $default = [
            'group' => ''
        ];
        $q = array_merge($default, $needed);
        $posts = DB::table('posts')->where($q)->paginate($per_page);
        return $posts;
    }
    public function onePost($id, $group)
    {
        $post = Post::where('id', $id)->first();
        if ($post->hasMedia($group) !== null) {

            $media = $post->getMedia($group)->reject(function ($post) {
                return isset($post->id) === false;
            })
                ->map(function ($post) {
                    return $post->getFullUrl();
                });
            $post->imgPaths = $media;
            unset($post->media);    
            return $post;
        }
    }
    public function postsWithGroupLimitMedia($group, $limit){
        $posts = Post::where(array('group' => $group, 'status' => 'active'))->orderBy('sort_order', 'ASC')->take($limit)->get();
        foreach ($posts as $item) {
            if ($item->hasMedia($group)) {
                $item->imgPath = $item->getFirstMediaUrl($group);
            } else {
                $item->imgPath = false;
            }
            unset($item->media);
        }
        return $posts;
    }
    public function postsWithGroupLimit($group, $limit){
        $posts = Post::where(array('group' => $group, 'status' => 'active'))->orderBy('sort_order', 'ASC')->take($limit)->get();
        return $posts;
    }
}
