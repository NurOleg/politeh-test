@extends('layouts.app')
@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">№ п/п</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
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
                url: '/api/departments',
                success: function (departments) {
                    let resString = '';
                    departments.forEach(function (department, i) {
                        resString += '<tr>' +
                            '<th scope="row">' + department.id + '</th>' +
                            '<td>' + department.name + '</td>' +
                            '<td>' + department.description + '</td>' +
                            '<td><a href="'+ department.absolute_url +'">Подробнее</a></td>' +
                            '</tr>';
                    });
                    $('#tbody').append(resString);
                }
            })
        });
    </script>
@endsection