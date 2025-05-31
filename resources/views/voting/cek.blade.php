<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Voting Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .voting-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin: 50px auto;
            max-width: 600px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
        }

        .header-title {
            background: linear-gradient(45deg, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .form-label {
            color: #495057;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="voting-container p-5">
            <div class="text-center mb-4">
                <i class="fas fa-vote-yea fa-3x text-primary mb-3"></i>
                <h1 class="header-title">Sistem Voting Online</h1>
                <p class="text-muted">Masukkan data Anda untuk melanjutkan voting</p>
            </div>
            <div class="card-body pt-5 mt-4">
                <a href="/" class="btn btn-outline-primary position-absolute top-0 start-0 m-3">
                    ← Back
                </a>
            </div>
            <form action="{{ route('voting.cek') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user me-2"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">
                            <i class="fas fa-id-card me-2"></i>NIK
                        </label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="16 digit NIK" maxlength="16" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="wilayah" class="form-label">
                        <i class="fas fa-map-marker-alt me-2"></i>Wilayah
                    </label>
                    <select class="form-control" id="wilayah" name="wilayah" required>
                        <option value="">Pilih Wilayah</option>
                        @foreach ($wilayah as $w)
                            <option value="{{ $w->id }}">{{ $w->nama_wilayah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Voting
                    </button>
                </div>
            </form>

            @if (session('info'))
                <div class="alert alert-danger mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('info') }}
                </div>
            @endif

            <!-- Alert untuk info -->
            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Pastikan data yang Anda masukkan sesuai dengan yang terdaftar di sistem.
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
