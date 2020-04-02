@extends('layouts.app')
@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">№ п/п</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Привязан к отделу?</th>
            <th scope="col">Ссылка</th>
        </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/employees',
                success: function (employees) {
                    let resString = '';
                    employees.forEach(function (employee, i) {
                        console.log(employee);
                        let isDepartment = employee.department_id == null ? 'Нет' : 'Да';
                        resString += '<tr>' +
                            '<th scope="row">' + employee.id + '</th>' +
                            '<td>' + employee.first_name + '</td>' +
                            '<td>' + employee.second_name + '</td>' +
                            '<td>' + isDepartment + '</td>' +
                            '<td><a href="'+ employee.absolute_url +'">Подробнее</a></td>' +
                            '</tr>';
                    });
                    $('#tbody').append(resString);
                }
            })
        });
    </script>
@endsection