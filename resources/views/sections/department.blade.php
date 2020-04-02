@extends('layouts.app')
@section('content')
    <div class="col-xs-12" id="department"></div>

    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/departments/{{$department->id}}',
                success: function (department) {
                    let editUrl = '{{route('department.edit', $department)}}';
                    let resString = '';
                        resString +=
                            '<p><b>Название</b>: ' + department.name + '</p>' +
                            '<p><b>Город</b>: ' + department.city.name + '</p>' +
                            '<p><b>Описание</b>: ' + department.description + '</p>'+
                            '<p><a href="'+ editUrl +'">Редактировать</a></p>'+
                            '<h2>Список сотрудников</h2>';

                        department.employees.forEach(function (employee) {
                            resString += '<p>'+ employee.full_name +'</p>';
                        });
                    $('#department').append(resString);
                }
            })
        });
    </script>
@endsection