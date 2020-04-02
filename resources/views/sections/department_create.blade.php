@extends('layouts.app')
@section('content')
    <h1 class="text-center">Создание отдела</h1>
    <form id="department" class="col-xs-6">
        <div class="form-group">
            <label for="department_name">Название</label>
            <input type="text" name="name" class="form-control"></div>
        <div class="form-group">
            <label for="department_description">Описание</label>
            <textarea name="description" class="form-control"></textarea>
            <p><a href="#" class="btn btn-primary" id="rooms_search">Найти свободные</a></p></div>
        <div class="form-group">
            <select name="city_id">
                @foreach ($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="create">Создать</button>
    </form>
    <form id="employees_search" class="col-xs-6">
        <h2>Найти сотрудника</h2>
        <div class="form-group">
            <label for="first_name">Имя</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="form-group">
            <label for="second_name">Фамилия</label>
            <input type="text" class="form-control" id="second_name" name="second_name">
        </div>
        <div class="form-group">
            <label for="county_name">Страна</label>
            <input type="text" class="form-control" id="county_name" name="county_name">
        </div>
        <div class="form-group">
            <label for="city_name">Город</label>
            <input type="text" class="form-control" id="city_name" name="city_name">
        </div>
        <input type="hidden" name="without_department" value="1">
        <button type="submit" class="btn btn-primary">Найти</button>
        <div id="result"></div>
    </form>

    <script>
        $(document).ready(function () {
            let storeUrl = '{{route('departments.store')}}';

            $('#employees_search').on('submit', function (e) {
                e.preventDefault();
                $('#result').html('');
                let formData = $("#employees_search :input")
                    .filter(function(index, element) {
                        return $(element).val() != '';
                    })
                    .serializeArray();
                $.ajax({
                    type: 'GET',
                    url: '/api/employees',
                    data: formData,
                    success: function (employees) {
                        let resString = '';
                        employees.forEach(function (employee, i) {
                            resString +=
                                '<p>' + employee.full_name +
                                '<a href="#" class="btn btn-primary employee-add" data-id="'+employee.id+'">Добавить</a></p>';
                        });
                        $('#result').html(resString);
                    },
                    error: function (response) {
                        alert(response.responseText);
                    }
                });
            });

            $('body').on('click', '.employee-add', function (e) {
                e.preventDefault();
                let ths = $(this);
                let employeeId = ths.attr('data-id');
                $('#department').append('<input type="hidden" name="employees[]" value="'+employeeId+'">');
                ths.text('Добавлен');
            });

            $('body').on('click', '.room-add', function (e) {
                e.preventDefault();
                let ths = $(this);
                let roomId = ths.attr('data-id');
                $('#department').append('<input type="hidden" name="rooms[]" value="'+roomId+'">');
                ths.text('Добавлен');
            });

            $('body').on('click', '#rooms_search', function (e) {
                e.preventDefault();
                let ths = $(this);

                $.ajax({
                    type: 'GET',
                    url: '/api/rooms',
                    success: function (rooms) {
                        let resString = '';
                        rooms.forEach(function (room, i) {
                            resString +=
                                '<p>' + room.name +
                                '<a href="#" class="btn btn-primary room-add" data-id="'+room.id+'">Добавить</a></p>';
                        });
                        ths.after(resString);
                    },
                    error: function (response) {
                        alert(response.responseText);
                    }
                });
            });

            $('#department').on('submit', function (e) {
                e.preventDefault();
                let formData = $("#department :input")
                    .filter(function(index, element) {
                        return $(element).val() != '';
                    })
                    .serializeArray();
                $.ajax({
                    type: 'POST',
                    url: storeUrl,
                    data: formData,
                    success: function (response) {
                        alert('Отдел успешно Добавлен!');
                    },
                    error: function (response) {
                        alert(response.responseText);
                    }
                });
            });
        });
    </script>
@endsection