@extends('new_admin.layout.admin')
@section('content')
    <div class="d-flex">
        <h2 class="pr-2">Товары сайта</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Создать товар
        </button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Номер продукта</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество на складе</th>
                <th>Описание</th>
                <th>Фотографии</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->count}}</td>
                <td>{{$item->description}}</td>
                <td><img src="{{ asset('/storage/' . $item->image) }}" style="width: 119px;
                        height: 67px"/></td>
                <td>
                    <a href="{{ route('admin.products.edit', $item) }}">Изменить</a>
                    <a href="{{ route('admin.products.delete', $item) }}">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Создание продукта</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Название продукта</label>
                            <input type="text" class="form-control" id="name" placeholder="бургер" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Цена товара</label>
                            <input type="number" class="form-control" id="price" placeholder="0" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="count" class="form-label">Количество товара</label>
                            <input type="number" class="form-control" id="count" placeholder="0" name="count">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание продукта</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photoFile" class="form-label">Фотографии товара</label>
                            <input class="form-control" type="file" id="photoFile" name="image">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Создать</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
