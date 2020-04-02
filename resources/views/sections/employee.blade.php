@extends('layouts.app')
@section('content')
    <div class="col-xs-12" id="employee"></div>

    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: '/api/employees/{{$employee->id}}',
                success: function (employee) {
                    let resString = '';
                        console.log(employee);
                        let department = employee.department == null ? 'Нет' : employee.department.name;
                        resString +=
                            '<p><b>Имя</b>: ' + employee.full_name + '</p>' +
                            '<p><b>Город</b>: ' + employee.city.name + '</p>' +
                            '<p><b>Отдел</b>: ' + department + '</p>';
                    $('#employee').append(resString);
                }
            })
        });
    </script>
@endsection