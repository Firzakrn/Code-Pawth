<!-- =========================================================================
     OVERLAY & DRAWER GABUNGAN: TENTANG & BANTUAN (SLIDE DARI ATAS + MULTI-PAGE)
========================================================================== -->
<div id="additional-backdrop" onclick="closeAdditionalDrawer()"
    class="fixed inset-0 z-50 bg-slate-900/35 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-300"
    aria-hidden="true"></div>

<div id="additional-drawer" role="dialog" aria-modal="true" aria-labelledby="additional-drawer-title"
    class="fixed top-0 inset-x-0 z-50 flex justify-center px-4 pt-3 sm:pt-5 -translate-y-full opacity-0 pointer-events-none transition-all duration-300 ease-out">
    <div
        class="relative w-full max-w-2xl bg-gradient-to-b from-[#F4F8FF] via-white to-white rounded-3xl border-2 border-white shadow-2xl overflow-hidden">

        <!-- Dekorasi Awan Lembut di Sudut Atas -->
        <div class="pointer-events-none absolute -top-10 -right-10 w-44 h-44 rounded-full bg-blue-100/60"></div>
        <div class="pointer-events-none absolute -top-8 left-12 w-32 h-32 rounded-full bg-sky-100/50"></div>

        <!-- HEADER DRAWER + TAB SWITCHER (TENTANG | BANTUAN) -->
        <div
            class="relative z-10 px-5 sm:px-7 pt-4 pb-3 border-b border-blue-100/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 shadow-2xs">
                    <img id="additional-mascot-img" src="{{ asset('images/mascot_peek.png') }}" alt="Maskot CodePawth"
                        class="w-8 h-8 object-contain">
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 id="additional-drawer-title" class="text-base sm:text-lg font-extrabold text-slate-900">
                            Tentang <span class="text-blue-600">CodePawth</span>
                        </h2>
                        <span id="additional-step-badge"
                            class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-extrabold">
                            1 / 2
                        </span>
                    </div>
                    <p id="additional-drawer-subtitle" class="text-xs text-slate-500 font-medium">
                        Informasi Akademik & Kriteria Capstone Project
                    </p>
                </div>
            </div>

            <!-- Navigasi Pill Halaman + Tombol Tutup -->
            <div class="flex items-center justify-between sm:justify-end gap-2">
                <div class="inline-flex items-center p-1 rounded-full bg-blue-50/90 border border-blue-100">
                    <button type="button" id="tab-btn-tentang" onclick="switchAdditionalPage(0)"
                        class="px-3.5 py-1 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer">
                        Tentang
                    </button>
                    <button type="button" id="tab-btn-bantuan" onclick="switchAdditionalPage(1)"
                        class="px-3.5 py-1 rounded-full text-xs font-bold text-slate-600 hover:text-blue-600 transition-all cursor-pointer">
                        Bantuan
                    </button>
                </div>

                <button type="button" onclick="closeAdditionalDrawer()" title="Tutup"
                    class="w-8 h-8 rounded-full bg-white hover:bg-rose-50 text-slate-400 hover:text-rose-500 border border-slate-200/80 flex items-center justify-center transition-colors cursor-pointer shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- VIEWPORT SLIDER HALAMAN (Halaman 1: Tentang | Halaman 2: Bantuan) -->
        <div class="relative z-10 overflow-hidden">
            <div id="additional-pages-track" class="flex w-[200%] transition-transform duration-300 ease-out">

                <!-- ===========================================================
                     HALAMAN 1: TENTANG CODEPAWTH
                ============================================================ -->
                <div class="w-1/2 px-5 sm:px-7 py-4 max-h-[68vh] overflow-y-auto space-y-3.5">

                    <!-- Info Mata Kuliah & Dosen Pengampu -->
                    <div class="rounded-2xl bg-[#EBF3FF]/85 border border-blue-100 p-4 flex items-start gap-3.5">
                        <div
                            class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-soft-blue">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <span
                                class="inline-block text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                Tugas Mata Kuliah Literasi Digital
                            </span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                                Aplikasi web <strong class="text-slate-900">CodePawth</strong> dikembangkan untuk
                                memenuhi tugas proyek mata kuliah <strong class="text-slate-900">Literasi
                                    Digital</strong> yang diampu oleh Bapak <strong class="text-blue-700">I Made
                                    Suartana, S.Kom., M.Kom.</strong> pada Program Studi S1 Teknik Informatika,
                                Universitas Negeri Surabaya (UNESA).
                            </p>
                        </div>
                    </div>

                    <!-- Penjelasan Pemenuhan Capstone Project -->
                    <div class="rounded-2xl bg-white border border-slate-200/80 p-4 space-y-3 shadow-2xs">
                        <div class="flex items-center gap-2">
                            <span
                                class="w-7 h-7 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900">
                                Pemenuhan Kriteria Capstone Project Teknik Informatika
                            </h3>
                        </div>

                        <p class="text-xs text-slate-600 leading-relaxed">
                            Sebagai proyek <strong class="text-slate-800">Capstone Teknik Informatika</strong>, sistem
                            ini mengintegrasikan analisis kebutuhan pengguna, perancangan UI/UX edukatif, serta rekayasa
                            perangkat lunak berbasis web secara utuh:
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <div class="rounded-xl bg-slate-50/90 border border-slate-100 p-3 flex items-start gap-2.5">
                                <span
                                    class="w-6 h-6 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 6h16M4 12h10M4 18h14" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-xs font-extrabold text-slate-800">Pembelajaran Adaptif</div>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                        Materi terstruktur dari pengenalan sintaks dasar (SD) hingga pemodelan logika
                                        flowchart (SMP).
                                    </p>
                                </div>
                            </div>

                            <div class="rounded-xl bg-slate-50/90 border border-slate-100 p-3 flex items-start gap-2.5">
                                <span
                                    class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                        viewBox="0 0 24 24">
                                        <rect x="7" y="3" width="10" height="5" rx="1.5" />
                                        <polygon points="12,11 17,15 12,19 7,15" />
                                        <path stroke-linecap="round" d="M12 8v3" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-xs font-extrabold text-slate-800">Evaluasi Interaktif</div>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                        Memadukan Flashcard konsep, worksheet drag-and-drop Flowchart, dan kuis
                                        pencocokan otomatis.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="rounded-xl bg-slate-50/90 border border-slate-100 p-3 flex items-start gap-2.5">
                                <span
                                    class="w-6 h-6 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-xs font-extrabold text-slate-800">Arsitektur Web Full-Stack</div>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                        Dikembangkan menggunakan Laravel, Tailwind CSS, dan JavaScript dengan manajemen
                                        progres terpusat.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="rounded-xl bg-slate-50/90 border border-slate-100 p-3 flex items-start gap-2.5">
                                <span
                                    class="w-6 h-6 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-xs font-extrabold text-slate-800">Aksesibilitas & Gamifikasi</div>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                        Mendukung Mode Tamu instan tanpa hambatan login awal serta sistem skor bintang
                                        dan peta level.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===========================================================
                     HALAMAN 2: BANTUAN & PANDUAN PENGGUNAAN (NEXT PAGE)
                ============================================================ -->
                <div class="w-1/2 px-5 sm:px-7 py-4 max-h-[68vh] overflow-y-auto space-y-3">

                    <div class="rounded-2xl bg-[#EBF3FF]/85 border border-blue-100 p-3.5 flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.5 9.5a2.5 2.5 0 014.8 1c0 1.5-2.3 2-2.3 3.5m0 3h.01" />
                            </svg>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Ikuti langkah-langkah berikut untuk menyelesaikan setiap level belajar di <strong
                                class="text-slate-900">CodePawth</strong>:
                        </p>
                    </div>

                    <!-- Langkah 1 -->
                    <div
                        class="rounded-2xl bg-white border border-slate-200/80 p-3.5 flex items-start gap-3 shadow-2xs">
                        <span
                            class="w-7 h-7 rounded-full bg-blue-600 text-white text-xs font-extrabold flex items-center justify-center shrink-0">
                            1
                        </span>
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900">Pilih Jenjang & Level di Peta
                                Belajar</h4>
                            <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                Pilih jenjang <strong>SD</strong> (pengenalan dasar Python) atau <strong>SMP</strong>
                                (logika algoritma & simbol flowchart), lalu klik node level yang aktif pada peta.
                            </p>
                        </div>
                    </div>

                    <!-- Langkah 2 -->
                    <div
                        class="rounded-2xl bg-white border border-slate-200/80 p-3.5 flex items-start gap-3 shadow-2xs">
                        <span
                            class="w-7 h-7 rounded-full bg-blue-600 text-white text-xs font-extrabold flex items-center justify-center shrink-0">
                            2
                        </span>
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900">Pelajari Konsep Melalui
                                Flashcard</h4>
                            <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                Klik kartu untuk membalik sisi depan dan belakang. Pastikan seluruh kartu dalam satu
                                level terbaca agar tahap berikutnya terbuka otomatis.
                            </p>
                        </div>
                    </div>

                    <!-- Langkah 3 -->
                    <div
                        class="rounded-2xl bg-white border border-slate-200/80 p-3.5 flex items-start gap-3 shadow-2xs">
                        <span
                            class="w-7 h-7 rounded-full bg-blue-600 text-white text-xs font-extrabold flex items-center justify-center shrink-0">
                            3
                        </span>
                        <div>
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900">Susun Flowchart (Khusus
                                Jenjang SMP) & Evaluasi</h4>
                            <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                                Seret atau klik blok ke diagram alir, lalu selesaikan tahap <strong>Evaluasi</strong>
                                dengan mencocokkan pasangan Domain dan Kodomain. Raih skor minimal <strong>80</strong>
                                untuk membuka level selanjutnya.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER DRAWER DENGAN TOMBOL NEXT / BACK PAGE -->
        <div
            class="relative z-10 px-5 sm:px-7 py-3 bg-slate-50/90 border-t border-slate-100 flex items-center justify-between gap-3">
            <!-- Indikator Titik Halaman -->
            <div class="flex items-center gap-1.5">
                <button type="button" onclick="switchAdditionalPage(0)" id="dot-page-0"
                    class="w-5 h-2 rounded-full bg-blue-600 transition-all cursor-pointer"
                    aria-label="Halaman Tentang"></button>
                <button type="button" onclick="switchAdditionalPage(1)" id="dot-page-1"
                    class="w-2 h-2 rounded-full bg-slate-300 transition-all cursor-pointer"
                    aria-label="Halaman Bantuan"></button>
                <span class="hidden sm:inline text-[11px] font-semibold text-slate-400 ml-2">
                    S1 Teknik Informatika • UNESA
                </span>
            </div>

            <!-- Tombol Navigasi Halaman -->
            <div class="flex items-center gap-2">
                <button type="button" id="btn-prev-additional" onclick="switchAdditionalPage(0)"
                    class="hidden items-center gap-1.5 px-4 py-2 rounded-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 text-xs font-bold transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Tentang</span>
                </button>

                <button type="button" id="btn-next-additional" onclick="switchAdditionalPage(1)"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 text-xs font-extrabold transition-all cursor-pointer">
                    <span>Lanjut ke Bantuan</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <button type="button" onclick="closeAdditionalDrawer()"
                    class="px-4 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-soft-blue transition-all cursor-pointer">
                    Selesai
                </button>
            </div>
        </div>

        <!-- Handle Bar Kecil di Bawah Drawer -->
        <button type="button" onclick="closeAdditionalDrawer()" aria-label="Tutup panel"
            class="w-full py-1.5 bg-white hover:bg-slate-50 flex items-center justify-center cursor-pointer transition-colors">
            <span class="w-10 h-1 rounded-full bg-slate-200"></span>
        </button>
    </div>
</div>

<!-- =========================================================================
     SCRIPT KONTROL DRAWER & SLIDE HALAMAN
========================================================================== -->
<script>
    let currentAdditionalPage = 0;

    function openAdditionalDrawer(startTab = 'tentang') {
        const backdrop = document.getElementById('additional-backdrop');
        const drawer = document.getElementById('additional-drawer');
        if (!backdrop || !drawer) return;

        switchAdditionalPage(startTab === 'bantuan' ? 1 : 0);

        backdrop.classList.remove('opacity-0', 'pointer-events-none');
        backdrop.classList.add('opacity-100');

        drawer.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
        drawer.classList.add('translate-y-0', 'opacity-100');
    }

    function closeAdditionalDrawer() {
        const backdrop = document.getElementById('additional-backdrop');
        const drawer = document.getElementById('additional-drawer');
        if (!backdrop || !drawer) return;

        backdrop.classList.add('opacity-0', 'pointer-events-none');
        backdrop.classList.remove('opacity-100');

        drawer.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
        drawer.classList.remove('translate-y-0', 'opacity-100');
    }

    function switchAdditionalPage(pageIndex) {
        currentAdditionalPage = pageIndex;
        const track = document.getElementById('additional-pages-track');
        const title = document.getElementById('additional-drawer-title');
        const subtitle = document.getElementById('additional-drawer-subtitle');
        const badge = document.getElementById('additional-step-badge');

        const tabTentang = document.getElementById('tab-btn-tentang');
        const tabBantuan = document.getElementById('tab-btn-bantuan');
        const dot0 = document.getElementById('dot-page-0');
        const dot1 = document.getElementById('dot-page-1');
        const btnPrev = document.getElementById('btn-prev-additional');
        const btnNext = document.getElementById('btn-next-additional');

        if (!track) return;

        if (pageIndex === 0) {
            track.style.transform = 'translateX(0%)';
            title.innerHTML = 'Tentang <span class="text-blue-600">CodePawth</span>';
            subtitle.textContent = 'Informasi Akademik & Kriteria Capstone Project';
            badge.textContent = '1 / 2';

            tabTentang.className =
                'px-3.5 py-1 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer';
            tabBantuan.className =
                'px-3.5 py-1 rounded-full text-xs font-bold text-slate-600 hover:text-blue-600 transition-all cursor-pointer';

            dot0.className = 'w-5 h-2 rounded-full bg-blue-600 transition-all cursor-pointer';
            dot1.className = 'w-2 h-2 rounded-full bg-slate-300 transition-all cursor-pointer';

            btnPrev.classList.add('hidden');
            btnPrev.classList.remove('inline-flex');
            btnNext.classList.remove('hidden');
            btnNext.classList.add('inline-flex');
        } else {
            track.style.transform = 'translateX(-50%)';
            title.innerHTML = 'Panduan & <span class="text-blue-600">Bantuan</span>';
            subtitle.textContent = 'Cara Bermain & Menyelesaikan Level Belajar';
            badge.textContent = '2 / 2';

            tabBantuan.className =
                'px-3.5 py-1 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer';
            tabTentang.className =
                'px-3.5 py-1 rounded-full text-xs font-bold text-slate-600 hover:text-blue-600 transition-all cursor-pointer';

            dot1.className = 'w-5 h-2 rounded-full bg-blue-600 transition-all cursor-pointer';
            dot0.className = 'w-2 h-2 rounded-full bg-slate-300 transition-all cursor-pointer';

            btnPrev.classList.remove('hidden');
            btnPrev.classList.add('inline-flex');
            btnNext.classList.add('hidden');
            btnNext.classList.remove('inline-flex');
        }
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAdditionalDrawer();
        }
    });
</script>
