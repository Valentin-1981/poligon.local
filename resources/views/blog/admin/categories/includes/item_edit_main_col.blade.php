@php
    /** @var \App\Models\BlogCategory $item */
{{-- @var \Illuminate\Support\Collection $categoryList --}}
/** @var App\Http\Controllers\Blog\Admin\CategoryController $categoryList */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" data-toggle="tab" role="tab" class="nav-link active">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text"
                            name="title"
                            value="{{$item->title}}"
                            id="title"
                            class="form-control"
                            required
                            minlength="3">
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" name="slug"
                            value="{{$item->slug}}"
                            id="slug"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id"
                                class="form-control"
                                placeholder="Выберите категорию"
                                required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id == $item->parent_id) selected @endif>
{{--                                        {{ $categoryOption->id }}.{{ $categoryOption->title }}--}}
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" id="description"
                                      class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
