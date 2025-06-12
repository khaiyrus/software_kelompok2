<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting - Sistem Voting Online</title>
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
            margin: 20px auto;
            max-width: 900px;
        }

        .candidate-card {
            transition: all 0.3s ease;
            border: 2px solid #dee2e6;
            cursor: pointer;
            height: 100%;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }

        .candidate-card.selected {
            border-color: #007bff;
            background: rgba(0, 123, 255, 0.1);
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        }

        .btn-outline-secondary {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
        }

        .header-title {
            background: linear-gradient(45deg, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .candidate-photo {
            width: 120px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .candidate-info {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .voting-timer {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 10px 15px;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="voting-container p-5">
            <div class="text-center mb-4">
                <div class="card-body pt-5 mt-4">
                    <a href="/" class="btn btn-outline-primary position-absolute top-0 start-0 m-3">
                        ← Back
                    </a>
                </div>
                <i class="fas fa-vote-yea fa-3x text-primary mb-3"></i>
                <h1 class="header-title">Pilih Kandidat Anda</h1>

                <!-- Info Pemilih -->
                <div class="alert alert-info">
                    <i class="fas fa-user me-2"></i>
                    Selamat datang, <strong>{{ $voter->nama }}</strong> dari
                    <strong>{{ $voter->wilayah->nama_wilayah }}</strong>
                    dalam rangka <p class="text-primary fw-bold mb-1">{{ $voter->acara->acara }}</p>
                </div>

                <!-- Timer Voting -->
                <div class="voting-timer text-center mb-3">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Waktu Tersisa:</strong> <span class="text-warning" id="countdownTimer">Memuat...</span>
                </div>
            </div>

            <form id="votingForm" action="{{ route('voting.submit') }}" method="POST">
                @csrf
                <div class="row g-4 mb-4">
                    @foreach ($kandidat as $ka)
                        <div class="col-md-6">
                            <div class="card candidate-card" onclick="selectCandidate({{ $ka->id }})">
                                <div class="card-body text-center p-4">
                                    <img src="{{ asset('storage/' . $ka->photo) }}" alt="{{ $ka->kandidat->name }}"
                                        class="candidate-photo mb-3">

                                    <div class="candidate-info">
                                        <h5 class="card-title mb-2">{{ $ka->kandidat->name }}</h5>
                                        <small class="text-muted">{{ $ka->wilayah->nama_wilayah }}</small>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-start mb-2">Visi:</h6>
                                        <p class="text-muted text-start small">{{ $ka->visi }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-start mb-2">Misi:</h6>
                                        <p class="text-muted text-start small">{{ $ka->misi }}</p>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="terpilih"
                                            id="candidate{{ $ka->id }}" value="{{ $ka->id }}">
                                        <label class="form-check-label fw-bold text-primary"
                                            for="candidate{{ $ka->id }}">
                                            <i class="fas fa-check-circle me-2"></i>Pilih Kandidat
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Pilihan Anda tidak dapat diubah setelah submit. Pastikan pilihan Anda
                    sudah benar.
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('keluar') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="submitVote" class="btn btn-success btn-lg w-100" disabled>
                            <i class="fas fa-paper-plane me-2"></i>Submit Vote
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function selectCandidate(candidateId) {
            document.querySelectorAll('.candidate-card').forEach(card => {
                card.classList.remove('selected');
            });

            const selectedCard = document.querySelector(`#candidate${candidateId}`).closest('.candidate-card');
            selectedCard.classList.add('selected');
            document.querySelector(`#candidate${candidateId}`).checked = true;

            document.getElementById('submitVote').disabled = false;
        }

        // Timer dari server (backend)
        const deadline = new Date("{{ $voter->acara->voting_sampai }}").getTime();

        function updateTimer() {
            const now = new Date().getTime();
            const distance = deadline - now;

            if (distance < 0) {
                document.getElementById("countdownTimer").innerHTML = "Waktu habis!";
                document.getElementById("countdownTimer").className = 'text-danger';
                document.getElementById("submitVote").disabled = true;
                document.querySelectorAll('input[name="terpilih"]').forEach(input => {
                    input.disabled = true;
                });
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdownTimer").innerHTML = `${hours} jam ${minutes} menit ${seconds} detik`;
        }

        setInterval(updateTimer, 1000);
        updateTimer();
    </script>
</body>

</html>
