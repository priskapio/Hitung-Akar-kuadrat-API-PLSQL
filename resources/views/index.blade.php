<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akar Kuadrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head> 
<body>
    <div class="container mt-5">
        <h1 class="text-center">Akar Kuadrat</h1>

        @if(session('error'))
        <div class="alert alert-danger mt-3">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif
        
        <form method="POST" action="{{ route('square_root.calculate') }}" class="mt-3" onsubmit="return validateForm();">
            @csrf
            <div class="row">
                <div class="mb-3">
                    <label for="number" class="form-label">Input Angka:</label>
                    <input type="text" name="number" id="number" class="form-control" required>
                </div>
            </div>
            <label for="number" class="form-label">Pilih Metode:</label>
            <div class="d-grid gap-2 d-md-block justify-content-center">
                
                <button type="submit" name="method" value="API" class="btn btn-success btn-block">API </button>
                <button type="submit" name="method" value="PL/SQL" class="btn btn-success btn-block">PL/SQL</button>
            </div>
        </form>

        <div id="result" class="mt-3 text-center">
            @if(session('result'))
                <p><strong style="font-size: 24px;">Hasil :</strong></p>
                <div class="alert alert-success" style="font-size: 24px;">
                    <strong>{{ session('result') }}</strong>
                </div>
                @if(session('executionTime'))
                    <p><strong>Waktu Eksekusi:</strong> {{ session('executionTime') }} detik</p>
                @endif
            @endif
        </div>
        
        <script>
            function validateForm() {
                var inputNumber = document.getElementById('number').value;
                var errorAlert = document.getElementById('error-alert');
                var zeroAlert = document.getElementById('zero-alert');
        
                if (parseFloat(inputNumber) <= 0) {
                    zeroAlert.style.display = 'block'; 
                    errorAlert.style.display = 'none'; 
                    return false; 
                } else {
                    zeroAlert.style.display = 'none'; 
                }
        
                return true; 
            }
        </script>

        <h2 class="mt-4 text-center">Log Hasil Perhitungan</h2>        
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Angka Input</th>
                    <th>Hasil Akar</th>
                    <th>Metode</th>
                    <th>Waktu Proses</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akar as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->input_number }}</td>
                    <td>{{ $item->square_root }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->execution_time }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
