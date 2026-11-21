@extends('layouts.materi')

@section('title', 'Evaluasi Mencocokkan — Code Pawth')
@section('materi_step', 'evaluasi')
@section('materi_speech', 'Ayo cocokkan pasangan kartunya!')

@section('materi_stats')
    <div
        class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card px-5 py-2 sm:px-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 shrink-0">
        <div class="flex items-center gap-5 sm:gap-7">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-extrabold text-slate-900 leading-tight">
                        <span id="ev-score-display">0</span> / 100
                    </div>
                    <div class="text-[11px] text-slate-500 font-medium">Skor Evaluasi</div>
                </div>
            </div>

            <div class="w-px h-6 bg-slate-200"></div>

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-extrabold text-slate-900 leading-tight">Syarat Lulus: 80</div>
                    <div class="text-[11px] text-slate-500 font-medium">Klik atau seret Domain ke Kodomain</div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 flex-1 md:max-w-md">
            <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                <div id="ev-progress-bar"
                    class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300"
                    style="width: 0%;"></div>
            </div>
            <span id="ev-pair-counter" class="text-xs font-extrabold text-slate-700 w-12 text-right">0 / 4</span>
        </div>
    </div>
@endsection

@section('materi_tab_right')
    <div id="eval-timer-pill"
        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-blue-600 text-xs font-extrabold transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
        </svg>
        <span id="eval-timer">01:30</span>
    </div>
@endsection

@section('materi_content')
    <div id="eval-scroll-container" onscroll="drawConnectionLines()"
        class="flex-1 min-h-0 bg-white/95 backdrop-blur-xs rounded-3xl rounded-tl-xl border-2 border-white shadow-soft-card p-4 sm:p-5 flex flex-col gap-4 overflow-y-auto">

        <!-- Judul Instruksi Evaluasi -->
        <div class="flex items-center justify-center pt-1 pb-2 border-b border-slate-100 shrink-0">
            <h2 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2 text-center">
                <span
                    class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 inline-flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" />
                        <circle cx="12" cy="12" r="5" />
                        <circle cx="12" cy="12" r="1.5" fill="currentColor" />
                    </svg>
                </span>
                <span>Cocokkan Domain (Sisi Depan) dengan Kodomain (Sisi Belakang)!</span>
            </h2>
        </div>

        <!-- Papan Pencocokan + Overlay Garis SVG -->
        <div id="matching-board" class="relative my-auto max-w-4xl w-full mx-auto py-1">
            <svg id="match-lines-svg" class="pointer-events-none absolute inset-0 w-full h-full z-10"></svg>

            <div class="relative z-20 w-full grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-12 items-start">
                <!-- Kolom Kiri: Domain (front.isi_materi) -->
                <div class="md:col-span-5 space-y-2.5">
                    <div class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600 px-1">
                        Domain (Sisi Depan)
                    </div>
                    <div id="left-items-col" class="space-y-2.5"></div>
                </div>

                <div class="hidden md:block md:col-span-1"></div>

                <!-- Kolom Kanan: Kodomain (back.isi_materi) -->
                <div class="md:col-span-6 space-y-2.5">
                    <div class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-600 px-1">
                        Kodomain (Sisi Belakang)
                    </div>
                    <div id="right-items-col" class="space-y-2.5"></div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="flex items-center justify-between gap-2.5 pt-2 border-t border-slate-100 shrink-0">
            <span class="hidden sm:inline text-[11px] font-medium text-slate-400">
                Tip: Klik lingkaran/kotak di kanan yang sudah terhubung untuk melepas garis.
            </span>

            <div class="flex items-center gap-2.5 ml-auto">
                <button type="button" onclick="resetMatches()"
                    class="px-4 py-2 rounded-full bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 text-xs sm:text-sm font-bold transition-colors cursor-pointer">
                    Reset Garis
                </button>

                <button type="button" id="btn-check-answers" onclick="checkAllAnswers(false)" disabled
                    class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 text-white text-xs sm:text-sm font-extrabold shadow-soft-blue disabled:shadow-none transition-all cursor-pointer disabled:cursor-not-allowed">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Periksa Jawaban</span>
                </button>
            </div>
        </div>

    </div>

    <!-- MODAL HASIL EVALUASI -->
    <div id="eval-result-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div
            class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 text-center space-y-4">
            <img id="modal-result-mascot" src="{{ asset('images/mascot_happy.png') }}" alt="Maskot Hasil"
                class="w-24 h-24 mx-auto object-contain">

            <div id="modal-stars-row" class="flex items-center justify-center gap-1.5 text-amber-400"></div>

            <div>
                <h3 id="modal-result-title" class="text-xl font-extrabold text-slate-900">Luar Biasa!</h3>
                <p id="modal-result-desc" class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                    Kamu berhasil mencocokkan semua kartu dengan tepat!
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-3.5 border border-slate-200/80 flex items-center justify-around">
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Skor Akhir</span>
                    <span id="modal-final-score" class="text-xl font-extrabold text-blue-600">100</span>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="block text-[11px] text-slate-400 font-semibold">Benar</span>
                    <span id="modal-correct-count" class="text-xl font-extrabold text-emerald-600">4 / 4</span>
                </div>
            </div>

            <div class="pt-2 flex flex-col sm:flex-row gap-2.5">
                <button type="button" onclick="closeResultModal(); resetMatches();"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                    Ulangi Evaluasi
                </button>
                <a id="modal-continue-btn" href="{{ url('/level-view') }}"
                    class="flex-1 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-soft-blue transition-all inline-flex items-center justify-center gap-1.5">
                    <span>Lanjut ke Peta Level</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const evalSvgIcons = {
            monitor: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8m-4-4v4"/></svg>`,
            keyboard: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M8 15h8"/></svg>`,
            text: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7V5h16v2M12 5v14m-3 0h6"/></svg>`,
            number: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>`,
            box: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 5 9-5M12 13v8"/></svg>`,
            plus: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>`,
            multiply: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`,
            note: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h4m4 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>`,
            branch: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><circle cx="18" cy="6" r="2.5"/><path stroke-linecap="round" d="M6 8.5v7A2.5 2.5 0 008.5 18h7M6 8.5A2.5 2.5 0 018.5 6h7"/></svg>`,
            loop: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>`,
            default: `<svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>`
        };

        // Ambil pasangan materi langsung dari layouts/materi.blade.php
        const pairedCards = window.getPairedMateriCards();
        const {
            jenjang,
            levelId,
            levelViewUrl
        } = window.MATERI_CTX;

        let selectedLeftPairId = null;
        let matches = {}; // { [leftPairId]: rightPairId }
        let isChecked = false;
        let checkResults = {}; // { [leftPairId]: boolean }
        let rightShuffled = [];
        let timerSeconds = 90;
        let timerInterval = null;

        function escapeHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function shuffleArray(arr) {
            const copy = [...arr];
            for (let i = copy.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        }

        function initEvaluation() {
            rightShuffled = shuffleArray(pairedCards);
            matches = {};
            checkResults = {};
            selectedLeftPairId = null;
            isChecked = false;

            renderColumns();
            updateProgressUI();
            startTimer();
        }

        function renderColumns() {
            const leftCol = document.getElementById('left-items-col');
            const rightCol = document.getElementById('right-items-col');

            // KOLOM KIRI: Domain (front.isi_materi)
            leftCol.innerHTML = pairedCards.map(pair => {
                const pairId = String(pair.pair_id);
                const frontItem = pair.front;
                const isSelected = selectedLeftPairId === pairId;
                const isMatched = Boolean(matches[pairId]);
                const result = checkResults[pairId];

                let borderStyle = 'border-blue-100 bg-[#F6FAFF] hover:border-blue-400';
                if (isChecked) {
                    borderStyle = result ?
                        'border-emerald-400 bg-emerald-50/80' :
                        'border-rose-400 bg-rose-50/80';
                } else if (isSelected) {
                    borderStyle = 'border-blue-600 bg-blue-50 ring-3 ring-blue-500/20';
                } else if (isMatched) {
                    borderStyle = 'border-blue-400 bg-blue-50/60';
                }

                return `
                <div 
                    draggable="true"
                    ondragstart="handleDragStart(event, '${pairId}')"
                    onclick="selectLeftItem('${pairId}')"
                    class="relative flex items-center justify-between px-4 py-3 rounded-2xl border-2 ${borderStyle} shadow-2xs cursor-pointer transition-all select-none"
                >
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="text-slate-400 text-xs font-bold tracking-tighter">⋮⋮</span>
                        <span class="font-extrabold text-slate-800 text-sm sm:text-[15px] truncate">${escapeHtml(frontItem.isi_materi)}</span>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        ${isChecked ? (result
                            ? '<svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>'
                            : '<svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" stroke-width="2.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>') : ''}
                        <span data-left-dot="${pairId}" class="w-3.5 h-3.5 rounded-full border-2 ${isMatched || isSelected ? 'border-blue-600 bg-blue-600' : 'border-blue-400 bg-white'}"></span>
                    </div>
                </div>
            `;
            }).join('');

            // KOLOM KANAN: Kodomain (back.isi_materi)
            rightCol.innerHTML = rightShuffled.map(pair => {
                const pairId = String(pair.pair_id);
                const backItem = pair.back;
                const matchedLeftId = Object.keys(matches).find(k => matches[k] === pairId);
                const isMatched = Boolean(matchedLeftId);
                const result = matchedLeftId ? checkResults[matchedLeftId] : null;
                const iconKey = backItem.iconKey || pair.front.iconKey || 'default';
                const iconHtml = evalSvgIcons[iconKey] || evalSvgIcons.default;

                let borderStyle =
                    'border-dashed border-blue-200 bg-white hover:border-blue-400 hover:bg-blue-50/40';
                if (isChecked && isMatched) {
                    borderStyle = result ?
                        'border-solid border-emerald-400 bg-emerald-50/80' :
                        'border-solid border-rose-400 bg-rose-50/80';
                } else if (isMatched) {
                    borderStyle = 'border-solid border-blue-400 bg-blue-50/60';
                }

                return `
                <div 
                    ondragover="event.preventDefault()"
                    ondrop="handleDropOnRight(event, '${pairId}')"
                    onclick="selectRightItem('${pairId}')"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-2xl border-2 ${borderStyle} cursor-pointer transition-all select-none"
                >
                    <span data-right-dot="${pairId}" class="w-4 h-4 rounded-full border-2 shrink-0 flex items-center justify-center ${isMatched ? 'border-blue-600 bg-blue-600' : 'border-slate-300 bg-white'}">
                        ${isMatched ? '<span class="w-1.5 h-1.5 rounded-full bg-white"></span>' : ''}
                    </span>
                    <span class="w-7 h-7 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                        ${iconHtml}
                    </span>
                    <span class="text-xs sm:text-sm font-bold text-slate-700 leading-snug">${escapeHtml(backItem.isi_materi)}</span>
                </div>
            `;
            }).join('');

            requestAnimationFrame(drawConnectionLines);
        }

        function selectLeftItem(leftPairId) {
            if (isChecked) return;
            selectedLeftPairId = (selectedLeftPairId === leftPairId) ? null : leftPairId;
            renderColumns();
        }

        function selectRightItem(rightPairId) {
            if (isChecked) return;

            // Jika belum memilih Domain di kiri, klik Kodomain yang sudah terhubung akan melepas garisnya
            if (!selectedLeftPairId) {
                const existingLeft = Object.keys(matches).find(k => matches[k] === rightPairId);
                if (existingLeft) {
                    delete matches[existingLeft];
                    renderColumns();
                    updateProgressUI();
                }
                return;
            }

            // Hapus pasangan lama jika Kodomain ini sudah dipakai Domain lain
            Object.keys(matches).forEach(k => {
                if (matches[k] === rightPairId) delete matches[k];
            });

            matches[selectedLeftPairId] = rightPairId;
            selectedLeftPairId = null;

            renderColumns();
            updateProgressUI();
        }

        function handleDragStart(event, leftPairId) {
            if (isChecked) return;
            selectedLeftPairId = leftPairId;
            event.dataTransfer.setData('text/plain', leftPairId);
        }

        function handleDropOnRight(event, rightPairId) {
            event.preventDefault();
            if (isChecked) return;
            const leftPairId = event.dataTransfer.getData('text/plain') || selectedLeftPairId;
            if (!leftPairId) return;

            Object.keys(matches).forEach(k => {
                if (matches[k] === rightPairId) delete matches[k];
            });

            matches[leftPairId] = rightPairId;
            selectedLeftPairId = null;

            renderColumns();
            updateProgressUI();
        }

        function drawConnectionLines() {
            const svg = document.getElementById('match-lines-svg');
            const board = document.getElementById('matching-board');
            if (!svg || !board) return;

            const boardRect = board.getBoundingClientRect();
            svg.innerHTML = '';

            Object.entries(matches).forEach(([leftPairId, rightPairId]) => {
                const leftDot = board.querySelector(`[data-left-dot="${leftPairId}"]`);
                const rightDot = board.querySelector(`[data-right-dot="${rightPairId}"]`);
                if (!leftDot || !rightDot) return;

                const lRect = leftDot.getBoundingClientRect();
                const rRect = rightDot.getBoundingClientRect();

                const x1 = lRect.left + lRect.width / 2 - boardRect.left;
                const y1 = lRect.top + lRect.height / 2 - boardRect.top;
                const x2 = rRect.left + rRect.width / 2 - boardRect.left;
                const y2 = rRect.top + rRect.height / 2 - boardRect.top;

                const midX = (x1 + x2) / 2;
                let strokeColor = '#2563EB';
                if (isChecked) {
                    strokeColor = checkResults[leftPairId] ? '#10B981' : '#F43F5E';
                }

                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', `M ${x1} ${y1} C ${midX} ${y1}, ${midX} ${y2}, ${x2} ${y2}`);
                path.setAttribute('fill', 'none');
                path.setAttribute('stroke', strokeColor);
                path.setAttribute('stroke-width', '3');
                path.setAttribute('stroke-linecap', 'round');

                svg.appendChild(path);
            });
        }

        function updateProgressUI() {
            const pairedCount = Object.keys(matches).length;
            const total = pairedCards.length;
            const pct = total > 0 ? Math.round((pairedCount / total) * 100) : 0;

            document.getElementById('ev-pair-counter').textContent = `${pairedCount} / ${total}`;
            document.getElementById('ev-progress-bar').style.width = `${pct}%`;

            document.getElementById('btn-check-answers').disabled = (pairedCount < total) || isChecked;
        }

        function renderStarIcons(stars) {
            const starSvg = (filled) => `
            <svg class="w-7 h-7 ${filled ? 'text-amber-400' : 'text-slate-200'}" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
            </svg>
        `;
            return [1, 2, 3].map(i => starSvg(i <= stars)).join('');
        }

        function checkAllAnswers(isTimeout = false) {
            if (isChecked) return;
            clearInterval(timerInterval);
            isChecked = true;
            checkResults = {};

            let correctCount = 0;
            pairedCards.forEach(pair => {
                const pairId = String(pair.pair_id);
                const isCorrect = matches[pairId] === pairId;
                checkResults[pairId] = isCorrect;
                if (isCorrect) correctCount++;
            });

            const total = pairedCards.length;
            const score = total > 0 ? Math.round((correctCount / total) * 100) : 0;
            const stars = score === 100 ? 3 : (score >= 80 ? 2 : (score >= 50 ? 1 : 0));

            document.getElementById('ev-score-display').textContent = score;
            renderColumns();
            updateProgressUI();

            document.getElementById('modal-stars-row').innerHTML = renderStarIcons(stars);
            document.getElementById('modal-final-score').textContent = score;
            document.getElementById('modal-correct-count').textContent = `${correctCount} / ${total}`;

            const mascotSpeech = document.getElementById('materi-mascot-speech');
            const modalMascotImg = document.getElementById('modal-result-mascot');

            if (score >= 80) {
                saveLevelCompletion(jenjang, levelId, score, stars);
                if (modalMascotImg) modalMascotImg.src = "{{ asset('images/mascot_happy.png') }}";
                document.getElementById('modal-result-title').textContent = 'Selamat, Kamu Lulus!';
                document.getElementById('modal-result-desc').textContent =
                    'Semua tahapan belajar selesai! Level berikutnya di peta belajar sudah terbuka.';
                if (mascotSpeech) mascotSpeech.textContent = 'Hebat! Kamu lulus evaluasi level ini!';
            } else {
                if (modalMascotImg) modalMascotImg.src = "{{ asset('images/mascot_angry.png') }}";
                document.getElementById('modal-result-title').textContent = isTimeout ? 'Waktu Habis!' : 'Hampir Berhasil!';
                document.getElementById('modal-result-desc').textContent =
                    'Raih skor minimal 80 untuk membuka level berikutnya. Yuk coba cocokkan lagi!';
                if (mascotSpeech) mascotSpeech.textContent = 'Jangan menyerah, ayo coba cocokkan lagi!';
            }

            const modal = document.getElementById('eval-result-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function saveLevelCompletion(jenjangName, lvlId, score, stars) {
            const key = `codepawth_levels_${jenjangName.toLowerCase()}`;
            const saved = JSON.parse(localStorage.getItem(key));
            if (!Array.isArray(saved)) return;

            const updated = saved.map((lvl, idx) => {
                if (lvl.id === lvlId) {
                    return {
                        ...lvl,
                        status: 'done',
                        score: Math.max(lvl.score || 0, score),
                        stars: Math.max(lvl.stars || 0, stars),
                        progress: 100
                    };
                }
                const prevLvl = saved[idx - 1];
                if (prevLvl && prevLvl.id === lvlId && lvl.status === 'locked') {
                    return {
                        ...lvl,
                        status: 'active'
                    };
                }
                return lvl;
            });

            localStorage.setItem(key, JSON.stringify(updated));
        }

        function closeResultModal() {
            const modal = document.getElementById('eval-result-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function resetMatches() {
            clearInterval(timerInterval);
            timerSeconds = 90;
            const timerPill = document.getElementById('eval-timer-pill');
            if (timerPill) {
                timerPill.className =
                    'inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/90 border border-blue-100 text-blue-600 text-xs font-extrabold transition-colors';
            }
            document.getElementById('eval-timer').textContent = '01:30';
            document.getElementById('ev-score-display').textContent = '0';
            initEvaluation();
        }

        function startTimer() {
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                if (timerSeconds <= 0) {
                    clearInterval(timerInterval);
                    checkAllAnswers(true);
                    return;
                }
                timerSeconds--;

                const m = String(Math.floor(timerSeconds / 60)).padStart(2, '0');
                const s = String(timerSeconds % 60).padStart(2, '0');
                document.getElementById('eval-timer').textContent = `${m}:${s}`;

                if (timerSeconds <= 15) {
                    const timerPill = document.getElementById('eval-timer-pill');
                    if (timerPill) {
                        timerPill.className =
                            'inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 border border-rose-200 text-rose-600 text-xs font-extrabold animate-pulse transition-colors';
                    }
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('modal-continue-btn').href = levelViewUrl;
            initEvaluation();

            window.addEventListener('resize', drawConnectionLines);
            document.getElementById('sidebar-toggle-btn')?.addEventListener('click', () => {
                setTimeout(drawConnectionLines, 320);
            });
        });
    </script>
@endpush
