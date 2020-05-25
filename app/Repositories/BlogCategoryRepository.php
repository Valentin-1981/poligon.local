<?php

namespace  App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * class BlogCategoryRepository
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{

//    public function __construct(){
//        parent::__construct();
//    }

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $id
     * @return Model
     */

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    public function getForComboBox(){
//        return $this->startConditions()->all();

        $fields = implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title',]);
//        $result[] = $this->startConditions()->all();
//        $result[] = $this->startConditions()->select('blog_categories.*', \DB::raw('CONCAT (id, ". ", title) AS id_title'))->
//            toBase()->get();

        $result = $this->startConditions()->selectRaw($fields)->toBase()->get();
        dd($result);
        return $result;
    }

    public function getAllWithPaginate($perPage = null){
        $fields = ['id', 'title', 'parent_id'];
        $result = $this->startConditions()->select($fields)->paginate($perPage);

        return $result;
    }
}
