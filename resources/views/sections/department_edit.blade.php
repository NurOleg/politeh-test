@extends('layouts.app')
@section('content')
    <h1 class="text-center">Редактирование отдела {{$department->id}}</h1>
    <form id="department" class="col-xs-6">
        <button type="submit" class="btn btn-primary" id="update">Обновить</button>
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
            let editUrl = '{{route('departments.update', $department)}}';
            $.ajax({
                type: 'GET',
                url: '/api/departments/{{$department->id}}',
                success: function (department) {
                    let resString = '';
                    let resRoomsString = '';
                    department.rooms.forEach(function (room) {
                        resRoomsString += '<p>' + room.name + '<a href="#" class="btn btn-primary room-delete" data-id="'+room.id+'">Удалить</a></p>';
                    });
                    resString +=
                        '<div class="form-group">' +
                        '    <label for="department_name">Название</label>' +
                        '    <input type="text" name="name" class="form-control" id="department_name" value="' + department.name + '">' +
                        '  </div>' +
                        '<div class="form-group">' +
                        '    <label for="department_description">Описание</label>' +
                        '    <textarea name="description" class="form-control" id="department_description">'
                        + department.description +
                        ' </textarea>' +
                        '<h2>Помещения</h2>' +
                        resRoomsString +
                        '<p><a href="#" class="btn btn-primary" id="rooms_search">Найти свободные</a></p>' +
                        '  </div><h2>Сотрудники в отделе</h2>';

                    department.employees.forEach(function (employee) {
                        resString += '<p>' + employee.full_name + '</p>';
                    });
                    $('#department button').before(resString);
                }
            });

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

            $('body').on('click', '.room-delete', function (e) {
                e.preventDefault();
                let ths = $(this);
                let roomId = ths.attr('data-id');
                $('#department').append('<input type="hidden" name="rooms_deleted[]" value="'+roomId+'">');
                ths.text('Удален');
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
                    type: 'PATCH',
                    url: editUrl,
                    data: formData,
                    success: function (response) {
                        alert('Отдел успешно обновлен!');
                    },
                    error: function (response) {
                        alert(response.responseText);
                    }
                });
            });
        });
    </script>
@endsection