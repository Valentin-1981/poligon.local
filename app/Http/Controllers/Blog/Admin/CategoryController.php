<?php

namespace App\Http\Controllers\Blog\Admin;

//use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(__METHOD__);
        $paginator = BlogCategory::paginate(5);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd(__METHOD__);
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
//        dd(__METHOD__);
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }
//        dd($data);
//        $item = new BlogCategory($data);
//        dd($item);
//        $item->save();

        $item = (new BlogCategory())->create($data);

        if ($item){
            return redirect()->route('blog.admin.categories.edit', [$item->id])->
                with(['success' => 'Успешно сохранено!']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategoryRepository $categoryRepository, $id)
    {
        dd(__METHOD__);
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();
        //$item = $categoryRepositoy->getEdit($id);
        //$categoryList = $categoryRepository->getFromComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*$rules = [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'description' => 'string|min:3|max:200',
            'parent_id' => 'required|integer|exists:blog_categories,id'
        ];*/

//        $validatedData = $this->validate($request, $rules);
//        $validatedData = $request->validate($rules);
/*        $validator = \Validator::make($request->all(), $rules);
        $validatedData[] = $validator->passes();
        $validatedData[] = $validator->validate();
        $validatedData[] = $validator->valid();
        $validatedData[] = $validator->failed();
        $validatedData[] = $validator->errors();
        $validatedData[] = $validator->fails();*/
//        dd($validatedData);
//        dd(__METHOD__);
        $item = BlogCategory::find($id);
//        dd($item);
        if(empty($item)){
            return back()->withErrors(['msg' => "Запись id=[{$id}] не найдена"])->withInput();
        }

        $data = $request->all();

        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

//        $result = $item->fill($data)->save();
        $result = $item->update($data);
        if($result){
            return redirect()->route('blog.admin.categories.edit', $item->id)->
                with(['success'=>'Успешно сохранено!']);
        }else{
            return back()->withErrors(['msg'=>'Ошибка сохранения'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
