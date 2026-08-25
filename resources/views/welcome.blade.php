<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI PENDA — Sistem Pengajuan Dana</title>
    <meta name="description" content="Sistem pengajuan dana internal: ajukan, periksa, setujui, dan cairkan dalam satu alur yang tercatat.">
    <link rel="icon" href="{{ asset('image/favicon/favicon.ico') }}">
    <style>
        /* Token warna mengikuti panel Filament (primary Blue) + netral slate.
           Merah hanya hidup di berkas logo, tidak dipakai sebagai warna UI. */
        :root {
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --ink: #0f172a;
            --muted: #475569;
            --line: #e2e8f0;
            --bg: #f8fafc;
            --card: #fff;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .page {
            max-width: 60rem;
            margin: 0 auto;
            padding: 2.5rem 1.25rem 3rem;
        }

        .hero { text-align: center; }

        .logo {
            height: 2.25rem;
            width: auto;
            max-width: 100%;
        }

        h1 {
            margin: 1.25rem 0 0;
            font-size: 1.75rem;
            letter-spacing: -0.02em;
        }

        .lede {
            margin: 0.75rem auto 0;
            max-width: 42ch;
            color: var(--muted);
        }

        .btn {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.75rem 1.75rem;
            border-radius: 0.5rem;
            background: var(--blue);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }

        .btn:hover { background: var(--blue-dark); }

        .btn:focus-visible {
            outline: 2px solid var(--blue-dark);
            outline-offset: 2px;
        }

        h2 {
            margin: 2.75rem 0 1rem;
            font-size: 1.125rem;
        }

        .steps, .roles {
            display: grid;
            gap: 0.75rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .card {
            display: flex;
            gap: 0.75rem;
            padding: 1rem;
            border: 1px solid var(--line);
            border-radius: 0.625rem;
            background: var(--card);
        }

        .num {
            flex: none;
            display: grid;
            place-items: center;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 999px;
            background: var(--blue);
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 700;
        }

        .card strong { display: block; }

        .card span.desc {
            display: block;
            color: var(--muted);
            font-size: 0.9375rem;
        }

        .note {
            margin: 0.875rem 0 0;
            color: var(--muted);
            font-size: 0.9375rem;
        }

        footer {
            margin-top: 2.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 0.875rem;
            text-align: center;
        }

        @media (min-width: 640px) {
            .page { padding: 4rem 2rem 4rem; }
            .logo { height: 2.75rem; }
            h1 { font-size: 2.25rem; }
            .steps { grid-template-columns: repeat(2, 1fr); }
            .roles { grid-template-columns: repeat(3, 1fr); }
        }

        @media (min-width: 960px) {
            .steps { grid-template-columns: repeat(3, 1fr); }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="hero">
            <img class="logo" src="{{ asset('image/icon-ma.png') }}" alt="Logo MA">
            <h1>SI PENDA</h1>
            <p class="lede">Sistem pengajuan dana internal — ajukan, periksa, setujui, dan cairkan dalam satu alur yang tercatat.</p>
            <a class="btn" href="{{ route('filament.admin.auth.login') }}">Masuk</a>
        </header>

        <section>
            <h2>Alur persetujuan</h2>
            <ol class="steps">
                <li class="card">
                    <span class="num">1</span>
                    <span><strong>Menunggu diperiksa</strong><span class="desc">Departemen mengirim pengajuan beserta rincian biaya dan lampiran.</span></span>
                </li>
                <li class="card">
                    <span class="num">2</span>
                    <span><strong>Diperiksa</strong><span class="desc">Finance memeriksa kelengkapan berkas dan rincian biaya.</span></span>
                </li>
                <li class="card">
                    <span class="num">3</span>
                    <span><strong>Disetujui Finance</strong><span class="desc">Pengajuan lolos pemeriksaan dan diteruskan ke pimpinan.</span></span>
                </li>
                <li class="card">
                    <span class="num">4</span>
                    <span><strong>Disetujui Direktur</strong><span class="desc">Pimpinan memberi persetujuan akhir atas pengajuan.</span></span>
                </li>
                <li class="card">
                    <span class="num">5</span>
                    <span><strong>Pencairan</strong><span class="desc">Dana dicairkan secara tunai atau transfer bank.</span></span>
                </li>
                <li class="card">
                    <span class="num">6</span>
                    <span><strong>Selesai</strong><span class="desc">Bukti cair terbit dan pengajuan ditutup.</span></span>
                </li>
            </ol>
            <p class="note">Pengajuan yang tidak lolos ditandai <strong>Ditolak</strong> dan berhenti di tahap tersebut.</p>
        </section>

        <section>
            <h2>Peran pengguna</h2>
            <ul class="roles">
                <li class="card">
                    <span><strong>Departemen</strong><span class="desc">Membuat pengajuan dan memantau statusnya.</span></span>
                </li>
                <li class="card">
                    <span><strong>Finance</strong><span class="desc">Memeriksa rincian dan memproses pencairan.</span></span>
                </li>
                <li class="card">
                    <span><strong>Pimpinan</strong><span class="desc">Memberi persetujuan akhir.</span></span>
                </li>
            </ul>
        </section>

        <footer>
            Akses terbatas untuk pengguna terdaftar. Hubungi administrator bila tidak dapat masuk.
        </footer>
    </main>
</body>
</html>
