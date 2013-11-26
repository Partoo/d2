<?php
namespace Istar\Repo\Tag;


/**
 * ITag
 */

interface ITag {

    public function findOrCreate(array $tags);


}