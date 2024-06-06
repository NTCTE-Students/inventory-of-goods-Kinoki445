<!DOCTYPE html>
<html>
<head>
    <title>Supplies</title>
    <!-- Подключение Bootstrap CSS через CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Список товаров</h1>
        <div class="mb-3">
            <a href="{{ route('supplies.create') }}" class="btn btn-primary">Создать товар</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supplies as $supply)
                    <tr>
                        <td>{{ $supply->id }}</td>
                        <td>{{ $supply->name }}</td>
                        <td>{{ $supply->description }}</td>
                        <td>{{ $supply->price }}</td>
                        <td>{{ $supply->amount }}</td>
                        <td>
                            <a href="{{ route('supplies.edit', $supply->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Подключение Bootstrap JS и Popper.js через CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
