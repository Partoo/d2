<?php
namespace Istar\Repo\Tag;

use Illuminate\Database\Eloquent\Model;


/**
 * EloquentTag
 */

class EloquentTag  implements ITag {

    protected $tag;

    function __construct(Model $tag) {
        $this->tag = $tag;
    }

    public function findTag($tag)
    {
       $foundTag = $this->tag->document->where('id','=',1);
       return $foundTag;
    }

    public function findOrCreate(array $tags)
    {
            // 当前tag是否存在等于 DB::table('tags')->whereIn('tag表中的字段',array(表单传过来的))
        $foundTags = $this->tag->whereIn('tag',$tags)->get();
        $returnTags = array();

            //如果存在,从数组中删除
        if ($foundTags) {

            foreach ($foundTags as $tag) {

                $pos = array_search($tag->tag, $tags);
                if ($pos!==false) {
                    $returnTags[] = $tag;
                    unset($tags[$pos]);
                }
            }
        }

        foreach ($tags as $tag) {

            $returnTags[] = $this->tag->create(array(
                'tag' => $tag
                ));
        }

        return $returnTags;
    }

}