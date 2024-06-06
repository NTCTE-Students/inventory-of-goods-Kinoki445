<!DOCTYPE html>
<html>
<head>
    <title>Редактировать товар</title>
    <!-- Подключение Bootstrap CSS через CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Редактировать товар</h1>
        <form action="{{ route('supplies.update', $supply->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $supply->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ $supply->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена (в копейках)</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $supply->price }}" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Количество</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $supply->amount }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <!-- Подключение Bootstrap JS и Popper.js через CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
