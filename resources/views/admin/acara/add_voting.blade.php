<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('build/assets') }}/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

    <title>Sign Up | AdminKit Demo</title>

    <link href="{{ asset('build/assets') }}/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">


                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form method="POST" action="{{ route('admin.voting_add_proses') }}">
                                        @csrf
                                        <div class="card-body pt-5 mt-4">
                                            <a href="{{ route('admin.voting') }}"
                                                class="btn btn-outline-primary position-absolute top-0 start-0 m-3">
                                                ← Back
                                            </a>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Acara</label>
                                            <input class="form-control form-control-lg" type="text" name="acara"
                                                placeholder="Nama Acara" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Voting Sampai</label>
                                            <input class="form-control form-control-lg" type="time" name="voting_sampai"
                                                placeholder="Nama Acara" required />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="label">Pilih Wilayah</label>
                                            <div class="form-group position-relative">
                                                <select name="wilayah_id" class="form-select form-control ps-5 h-58"
                                                    required>
                                                    <option value="" disabled selected>Pilih Wilayah</option>
                                                    @foreach ($wilayah as $a)
                                                        <option value="{{ $a->id }}" class="text-dark">
                                                            {{ $a->nama_wilayah }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Buat Voting</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('build/assets') }}/js/app.js"></script>

</body>

</html>
