@extends('new_admin.layout.admin')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Число на которое заказали столик</th>
                <th>Количество людей</th>
                <th>Описание</th>
            </tr>
        </thead>
        <tbody>
            @foreach($booking as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->orderDate }}</td>
                    <td>{{ $item->peoples  }}</td>
                    <td>{{ $item->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
