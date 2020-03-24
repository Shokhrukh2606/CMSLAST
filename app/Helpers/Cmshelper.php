<?php

use Illuminate\Support\Facades\DB;
use App\Post;
use PhpParser\Node\Expr\Cast\String_;

if (!function_exists('get_program')) {
    function get_program($id)
    {
        $data = DB::table('programs')

            ->where('id', $id)->get();

        return $data->title;
    }
}
if (!function_exists('getLang')) {
    function getLang($passed)
    {
        return json_decode($passed);
    }
}
if (!function_exists('getLangSpec')) {
    function getLangSpec($passed, $lang)
    {
        return mb_convert_encoding(json_decode($passed)->$lang, "UTF-8");
    }
}
if (!function_exists('limiter')) {
    function limiter($x, $limit)
    {
        if (mb_strlen($x) > $limit)
            $x = mb_substr($x, 0, $limit) . '&hellip;';
        else
            $x = $x;
        return $x;
    }
}
if (!function_exists('getOnePost')) {
    function getOnePost($id)
    {
        $data = DB::table('posts')

            ->where('id', $id)->first();

        return $data;
    }
}
if (!function_exists('getTagPosts')) {
    function getTagPosts($id, $group)
    {
        $posts = Post::where(array('group' => $group, 'status' => 'active', 'tags'=>(String) $id))->orderBy('sort_order', 'DESC')->get();
        foreach ($posts as $item) {
            if ($item->hasMedia($item->group)) {
                $item->imgPath = $item->getFirstMediaUrl($item->group);
            } else {
                $item->imgPath = false;
            }
            unset($item->media);
        }
        return $posts;
    }
}
// if (!function_exists('getLangSpec')) {
//     function getLangSpec($x, $lang, $length)
//     {
//         $z = json_decode($x)->$lang;
//         if (strlen($z) <= $length) {
//             return $z;
//         } else {
//             $y = substr($z, 0, $length) . '...';
//             return $y;
//         }
//     }
// }
if (!function_exists('getDayOfProgram')) {
    function getDayOfProgram($id)
    {
        $days = [
            "0" => "Ощибка",
            "1" => "Понедельник",
            "2" => "Вторник", "3" => "Среда", "4" => "Четверг",
            "5" => "Пятница",
            "6" => "Суббота", "7" => "Воскресенье"
        ];
        if ($id) {
            return $days[$id];
        }
    }
}
if (!function_exists('langExist')) {
    function langExist($passed, $lang)
    {
        return property_exists($passed, $lang);
    }
}
