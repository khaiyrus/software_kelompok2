<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Voting - Sistem Voting Online</title>
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
            max-width: 1000px;
        }

        .header-title {
            background: linear-gradient(45deg, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .status-badge {
            font-size: 1.1rem;
            padding: 8px 20px;
            border-radius: 25px;
        }

        .progress-custom {
            height: 25px;
            border-radius: 15px;
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .progress-bar-custom {
            border-radius: 15px;
            transition: width 0.8s ease;
            background: linear-gradient(45deg, #28a745, #20c997);
        }

        .result-card {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            overflow: hidden;
        }

        .result-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .winner-card {
            border: 3px solid #28a745 !important;
            background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1));
            position: relative;
        }

        .winner-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745, #20c997, #28a745);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        .candidate-photo-result {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 3px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .vote-count {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
        }

        .percentage {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .btn-outline-primary {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .pending-container {
            text-align: center;
            padding: 60px 20px;
        }

        .spinner-border-lg {
            width: 4rem;
            height: 4rem;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse 3s infinite;
        }

        .statistics {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .crown-icon {
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .vote-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vote-bar {
            flex: 1;
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }

        .vote-fill {
            height: 100%;
            background: linear-gradient(90deg, #007bff, #28a745);
            border-radius: 4px;
            transition: width 1s ease;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="voting-container p-5">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="card-body pt-5 mt-4">
                                            <a href="/"
                                                class="btn btn-outline-primary position-absolute top-0 start-0 m-3">
                                                ← Back
                                            </a>
                                        </div>
                <i class="fas fa-chart-bar fa-3x text-success mb-3"></i>
                <h1 class="header-title">Hasil Voting</h1>
                <p class="text-muted">{{ $voter->acara->acara }} di {{ $voter->wilayah->nama_wilayah }}</p>
                @if (session('info'))
                    <div class="alert alert-danger mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Status Voting -->
                <div class="mb-3">
                    @if (!$voter->acara->status)
                        <span class="badge status-badge bg-warning">
                            <i class="fas fa-clock me-2"></i>Voting Berlangsung
                        </span>
                    @else
                        <span class="badge status-badge bg-success">
                            <i class="fas fa-check-circle me-2"></i>Voting Selesai
                        </span>
                    @endif
                </div>
            </div>
            @if ($voter->acara->status)
                <!-- Container Hasil Selesai -->
                <div class="fade-in">
                    <!-- Statistik Voting -->
                    <div class="statistics mb-4">
                        <div class="row g-3">
                            <div class="col-md-4 col-12 text-center">
                                <div class="h4 text-primary mb-1">{{ $jumlahVoter }}</div>
                                <small class="text-muted">Total Suara</small>
                            </div>
                            <div class="col-md-4 col-12 text-center">
                                <div class="h4 text-success mb-1">{{ $jumlahVoter/ $acara->voter->count()  * 100 }}</div>
                                <small class="text-muted">Partisipasi</small>
                            </div>
                            <div class="col-md-4 col-12 text-center">
                                <div class="h4 text-info mb-1">{{ $acara->wilayah->profil->count() }}</div>
                                <small class="text-muted">Kandidat</small>
                            </div>
                        </div>
                    </div>

                    <!-- Info Total -->
                    <div class="alert alert-info mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Hasil Resmi {{ $acara->acara }} di {{ $acara->wilayah->nama_wilayah }}</strong>
                                <br>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Kandidat -->
                    <div class="row g-4 mb-4">
                        <!-- Pemenang -->
                        <div class="col-12">
                            <div class="card result-card winner-card pulse-animation">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ asset('storage/'. $pemenang->profil->photo ) }}"
                                                alt="Dr. Andi Wijaya" class="candidate-photo-result">
                                            <div class="mt-2">
                                                <i class="fas fa-crown crown-icon fa-2x"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="mb-1 text-success">
                                                <i class="fas fa-trophy me-2"></i>{{ $pemenang->name }}
                                            </h4>
                                            <div class="mb-2">
                                                <span class="badge bg-success me-2">PEMENANG</span>
                                            </div>
                                            <p class="small text-muted mb-0">
                                                <i class="fas fa-quote-left me-1"></i>
                                                {{ $pemenang->profil->visi }}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <div class="vote-count">1,284</div>
                                                <div class="percentage text-success">52.28%</div>
                                                <div class="vote-indicator mt-3">
                                                    <div class="vote-bar">
                                                        <div class="vote-fill" style="width: 52.28%"></div>
                                                    </div>
                                                    <small class="text-muted">52.28%</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-center">
                        <button class="btn btn-outline-primary me-2" onclick="printResults()">
                            <i class="fas fa-print me-2"></i>Cetak Hasil
                        </button>
                        <a href="{{ route('keluar') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button class="btn btn-outline-info" onclick="shareResults()">
                            <i class="fas fa-share me-2"></i>Bagikan
                        </button>
                    </div>
                </div>
            @else
                <!-- Container Hasil Berlangsung -->
                <div class="pending-container" >
                    <div class="spinner-border spinner-border-lg text-warning mb-4" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h3 class="mb-3">Voting Sedang Berlangsung</h3>
                    <p class="text-muted mb-4">Hasil akan ditampilkan setelah voting selesai</p>

                    <!-- Statistik Sementara -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="text-primary">{{ $jumlahVoter }}</h4>
                                    <small class="text-muted">Suara Masuk</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="text-warning">{{ $jumlahVoter/ $acara->voter->count()  * 100 }} %</h4>
                                    <small class="text-muted">Progress</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="progress progress-custom mb-3">
                        <div class="progress-bar progress-bar-custom" style="width: {{ $jumlahVoter/ $acara->voter->count()  * 100 }}%">
                            {{ $jumlahVoter/ $acara->voter->count()  * 100 }}%
                        </div>
                    </div>

                    <button class="btn btn-primary" onclick="refreshResults()">
                        <i class="fas fa-sync-alt me-2"></i>Refresh Hasil
                    </button>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Fungsi untuk menampilkan hasil selesai
        function showCompletedResults() {
            document.getElementById('completedResults').style.display = 'block';
            document.getElementById('pendingResults').style.display = 'none';
            document.getElementById('votingStatus').innerHTML = `
                <span class="badge status-badge bg-success">
                    <i class="fas fa-check-circle me-2"></i>Voting Selesai
                </span>
            `;
            initChart();
        }

        // Fungsi untuk menampilkan status berlangsung
        function showPendingResults() {
            document.getElementById('completedResults').style.display = 'none';
            document.getElementById('pendingResults').style.display = 'block';
            document.getElementById('votingStatus').innerHTML = `
                <span class="badge status-badge bg-warning">
                    <i class="fas fa-clock me-2"></i>Voting Berlangsung
                </span>
            `;
        }

        // Fungsi untuk refresh hasil
        function refreshResults() {
            const button = event.target;
            const spinner = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
            const original = button.innerHTML;

            button.innerHTML = spinner;
            button.disabled = true;

            setTimeout(() => {
                button.innerHTML = original;
                button.disabled = false;
                alert('Hasil berhasil diperbarui!');
            }, 2000);
        }

        // Fungsi untuk cetak hasil
        function printResults() {
            window.print();
        }


        // Fungsi untuk share hasil
        function shareResults() {
            if (navigator.share) {
                navigator.share({
                    title: 'Hasil Voting Jakarta Pusat 2025',
                    text: 'Dr. Andi Wijaya memenangkan Pilkada Jakarta Pusat 2025 dengan 52.28% suara',
                    url: window.location.href
                });
            } else {
                // Fallback untuk browser yang tidak support Web Share API
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link berhasil disalin ke clipboard!');
                });
            }
        }

        // Inisialisasi chart
        function initChart() {
            const ctx = document.getElementById('voteChart');
            if (ctx) {
                new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Dr. Andi Wijaya', 'Sari Mulyani', 'Budi Santoso'],
                        datasets: [{
                            data: [52.28, 29.89, 17.83],
                            backgroundColor: ['#28a745', '#6c757d', '#dc3545'],
                            borderWidth: 3,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            initChart();

            // Animasi progress bar
            setTimeout(() => {
                const progressBars = document.querySelectorAll('.vote-fill');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 500);
                });
            }, 1000);
        });
    </script>
</body>

</html>
