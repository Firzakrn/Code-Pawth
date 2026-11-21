@extends('layouts.materi')

@section('title', 'Knowledge Card — Code Pawth')
@section('materi_step', 'knowledge-card')
@section('materi_speech', 'Cari kartu konsep atau sintaks sebelum mulai latihan!')

@section('materi_stats')
    <div
        class="bg-white/95 backdrop-blur-xs rounded-2xl border border-white shadow-soft-card p-3.5 sm:px-5 flex flex-col gap-3 shrink-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-2.5 items-center">

            <!-- Pencarian Kata Kunci -->
            <div class="lg:col-span-5 relative">
                <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <path stroke-linecap="round" d="M20 20l-3.5-3.5" />
                    </svg>
                </span>
                <input type="text" id="kc-search-input" oninput="filterKnowledgeCards()"
                    placeholder="Cari konsep, sintaks, atau penjelasan..."
                    class="w-full pl-10 pr-9 py-2 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-colors">
                <button type="button" id="kc-clear-search" onclick="clearKcSearch()" title="Hapus pencarian"
                    class="hidden absolute inset-y-0 right-2.5 items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Filter Jenjang / Kelas -->
            <div class="lg:col-span-4 flex items-center gap-1.5 flex-wrap">
                <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mr-1">Kelas:</span>
                <button type="button" data-jenjang="ALL" onclick="selectKcJenjang('ALL')"
                    class="kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer">
                    Semua
                </button>
                <button type="button" data-jenjang="SD" onclick="selectKcJenjang('SD')"
                    class="kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer">
                    SD
                </button>
                <button type="button" data-jenjang="SMP" onclick="selectKcJenjang('SMP')"
                    class="kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer">
                    SMP
                </button>
                <button type="button" data-jenjang="SMA" onclick="selectKcJenjang('SMA')"
                    class="kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer">
                    SMA
                </button>
            </div>

            <!-- Filter Level Materi -->
            <div class="lg:col-span-3">
                <select id="kc-level-select" onchange="filterKnowledgeCards()" aria-label="Filter Level Materi"
                    class="w-full px-3 py-2 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 text-xs font-bold text-slate-700 focus:outline-none cursor-pointer">
                    <option value="ALL">Semua Level Materi</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
            <span class="text-slate-500 font-medium">
                Menampilkan <strong id="kc-visible-count" class="text-slate-900">0</strong> kartu dari materi Flashcard
            </span>

            <button type="button" onclick="toggleFlipAllCards()"
                class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-extrabold transition-colors cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span id="text-flip-all-kc">Balik Semua Kartu</span>
            </button>
        </div>
    </div>
@endsection

@section('materi_content')
    <div class="flex-1 min-h-0 overflow-y-auto pr-1 pb-2">
        <!-- Grid Kartu Knowledge Card -->
        <div id="kc-cards-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>

        <!-- Empty State -->
        <div id="kc-empty-state"
            class="hidden bg-white/95 rounded-3xl border-2 border-white shadow-soft-card p-8 text-center flex-col items-center justify-center gap-3">
            <img src="{{ asset('images/mascot_sad.png') }}" alt="Tidak Ditemukan" class="w-20 h-20 object-contain mx-auto">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Kartu Materi Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1">
                    Coba kata kunci lain atau atur ulang filter kelas dan level materi.
                </p>
            </div>
            <button type="button" onclick="resetAllKcFilters()"
                class="px-5 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-extrabold shadow-soft-blue transition-all cursor-pointer">
                Reset Filter & Pencarian
            </button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const kcSvgIcons = {
            monitor: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M8 21h8m-4-4v4"/></svg>`,
            keyboard: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M6 9h.01M10 9h.01M14 9h.01M18 9h.01M8 15h8"/></svg>`,
            text: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7V5h16v2M12 5v14m-3 0h6"/></svg>`,
            number: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>`,
            box: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 5 9-5M12 13v8"/></svg>`,
            plus: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/></svg>`,
            note: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h4m4 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/></svg>`,
            branch: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><circle cx="18" cy="6" r="2.5"/><path stroke-linecap="round" d="M6 8.5v7A2.5 2.5 0 008.5 18h7M6 8.5A2.5 2.5 0 018.5 6h7"/></svg>`,
            loop: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>`,
            default: `<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>`
        };

        const ALL_KC_CARDS = [];
        const ALL_LEVEL_OPTIONS = [];
        let selectedJenjang = 'ALL';
        let flippedSet = new Set();
        let allFlipped = false;

        // Ambil langsung $materiCatalog dari layouts/materi.blade.php tanpa duplikasi
        function buildCardsFromMateriCatalog() {
            const catalog = (window.MATERI_CTX && window.MATERI_CTX.catalog) ? window.MATERI_CTX.catalog : {};
            const baseFlashcardUrl = @json(url('/materi/flashcard'));

            Object.entries(catalog).forEach(([deckKey, deck]) => {
                const [rawJenjang, rawLevel] = deckKey.split('-');
                const jenjang = String(deck.jenjang || rawJenjang || 'SD').toUpperCase();
                const level = Number(deck.level || rawLevel || 1);
                const levelTitle = deck.levelTitle || `Level ${level}`;
                const hasFlowchart = ['SMP', 'SMA'].includes(jenjang);
                const materiUrl =
                    `${baseFlashcardUrl}?jenjang=${jenjang}&level=${level}&flowchart=${hasFlowchart ? '1' : '0'}`;

                ALL_LEVEL_OPTIONS.push({
                    key: deckKey,
                    jenjang,
                    level,
                    levelTitle
                });

                const items = Array.isArray(deck.items) ? deck.items : [];
                const fronts = items.filter(i => i.kategori === 'front');
                const backs = items.filter(i => i.kategori === 'back');

                fronts.forEach(front => {
                    const pairId = front.pair_id ?? front.id;
                    const matchedBack = backs.find(b => (b.pair_id ?? b.id) === pairId) || {};

                    ALL_KC_CARDS.push({
                        deckKey,
                        jenjang,
                        level,
                        levelTitle,
                        materiUrl,
                        pairId,
                        iconKey: front.iconKey || 'default',
                        frontJudul: front.judul || '',
                        frontIsi: front.isi_materi || '',
                        frontMain: front.main_materi || '',
                        backJudul: matchedBack.judul || 'Penjelasan',
                        backIsi: matchedBack.isi_materi || '-',
                        backMain: matchedBack.main_materi || ''
                    });
                });
            });
        }

        function escapeHtml(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function populateLevelDropdown() {
            const selectEl = document.getElementById('kc-level-select');
            const filteredLevels = selectedJenjang === 'ALL' ?
                ALL_LEVEL_OPTIONS :
                ALL_LEVEL_OPTIONS.filter(opt => opt.jenjang === selectedJenjang);

            selectEl.innerHTML = `<option value="ALL">Semua Level (${filteredLevels.length})</option>` +
                filteredLevels.map(opt =>
                    `<option value="${escapeHtml(opt.key)}">${escapeHtml(opt.jenjang)} Level ${opt.level} — ${escapeHtml(opt.levelTitle)}</option>`
                ).join('');
        }

        function selectKcJenjang(jenjang) {
            selectedJenjang = jenjang;
            document.querySelectorAll('.kc-jenjang-btn').forEach(btn => {
                const isActive = btn.dataset.jenjang === jenjang;
                btn.className = isActive ?
                    'kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-extrabold bg-blue-600 text-white shadow-2xs transition-all cursor-pointer' :
                    'kc-jenjang-btn px-3 py-1.5 rounded-full text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 transition-all cursor-pointer';
            });
            populateLevelDropdown();
            filterKnowledgeCards();
        }

        function clearKcSearch() {
            const input = document.getElementById('kc-search-input');
            input.value = '';
            input.focus();
            filterKnowledgeCards();
        }

        function resetAllKcFilters() {
            document.getElementById('kc-search-input').value = '';
            selectKcJenjang('ALL');
        }

        function toggleSingleCardFlip(cardUid) {
            const inner = document.getElementById(`kc-flipper-${cardUid}`);
            if (!inner) return;
            if (flippedSet.has(cardUid)) {
                flippedSet.delete(cardUid);
                inner.style.transform = 'rotateY(0deg)';
            } else {
                flippedSet.add(cardUid);
                inner.style.transform = 'rotateY(180deg)';
            }
        }

        function toggleFlipAllCards() {
            allFlipped = !allFlipped;
            const label = document.getElementById('text-flip-all-kc');
            if (label) {
                label.textContent = allFlipped ? 'Kembalikan Semua Sisi Depan' : 'Balik Semua Kartu';
            }
            document.querySelectorAll('[data-kc-uid]').forEach(el => {
                const uid = el.dataset.kcUid;
                if (allFlipped) {
                    flippedSet.add(uid);
                    el.style.transform = 'rotateY(180deg)';
                } else {
                    flippedSet.delete(uid);
                    el.style.transform = 'rotateY(0deg)';
                }
            });
        }

        function filterKnowledgeCards() {
            const searchInput = document.getElementById('kc-search-input');
            const clearBtn = document.getElementById('kc-clear-search');
            const levelSelect = document.getElementById('kc-level-select');
            const query = (searchInput.value || '').trim().toLowerCase();
            const selectedDeck = levelSelect.value;

            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
                clearBtn.classList.add('flex');
            } else {
                clearBtn.classList.add('hidden');
                clearBtn.classList.remove('flex');
            }

            const filtered = ALL_KC_CARDS.filter(card => {
                if (selectedJenjang !== 'ALL' && card.jenjang !== selectedJenjang) return false;
                if (selectedDeck !== 'ALL' && card.deckKey !== selectedDeck) return false;

                if (query.length > 0) {
                    const haystack = [
                        card.jenjang,
                        `level ${card.level}`,
                        card.levelTitle,
                        card.frontJudul,
                        card.frontIsi,
                        card.frontMain,
                        card.backJudul,
                        card.backIsi,
                        card.backMain
                    ].join(' ').toLowerCase();

                    return haystack.includes(query);
                }
                return true;
            });

            renderKnowledgeCards(filtered);
        }

        function renderKnowledgeCards(cards) {
            const grid = document.getElementById('kc-cards-grid');
            const emptyState = document.getElementById('kc-empty-state');
            document.getElementById('kc-visible-count').textContent = cards.length;

            if (cards.length === 0) {
                grid.innerHTML = '';
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
                return;
            }

            emptyState.classList.add('hidden');
            emptyState.classList.remove('flex');

            const badgeStyles = {
                SD: 'bg-sky-100 text-sky-700',
                SMP: 'bg-blue-100 text-blue-700',
                SMA: 'bg-indigo-100 text-indigo-700'
            };

            grid.innerHTML = cards.map(card => {
                const uid = `${card.deckKey}-${card.pairId}`;
                const isFlipped = flippedSet.has(uid);
                const iconHtml = kcSvgIcons[card.iconKey] || kcSvgIcons.default;
                const badgeClass = badgeStyles[card.jenjang] || 'bg-blue-100 text-blue-700';

                return `
                <div style="perspective: 1000px;" class="select-none">
                    <div
                        id="kc-flipper-${escapeHtml(uid)}"
                        data-kc-uid="${escapeHtml(uid)}"
                        onclick="toggleSingleCardFlip('${escapeHtml(uid)}')"
                        style="transform-style: preserve-3d; transform: ${isFlipped ? 'rotateY(180deg)' : 'rotateY(0deg)'};"
                        class="grid transition-transform duration-500 cursor-pointer h-full"
                    >
                        <!-- Sisi Depan -->
                        <div
                            style="backface-visibility: hidden;"
                            class="col-start-1 row-start-1 bg-white/95 hover:bg-white rounded-3xl border-2 border-white hover:border-blue-200 shadow-soft-card p-5 flex flex-col justify-between gap-4 transition-colors"
                        >
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-2.5 py-1 rounded-full ${badgeClass} text-[11px] font-extrabold">
                                        ${escapeHtml(card.jenjang)} • Level ${card.level}
                                    </span>
                                    <span class="text-[11px] font-bold text-slate-400 truncate max-w-[140px]">
                                        ${escapeHtml(card.frontJudul)}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 pt-1">
                                    <div class="w-11 h-11 rounded-2xl bg-[#EBF3FF] border border-blue-100 flex items-center justify-center shrink-0">
                                        ${iconHtml}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-base sm:text-lg font-extrabold text-slate-900 break-words">
                                            ${escapeHtml(card.frontIsi)}
                                        </div>
                                        <div class="text-[11px] font-semibold text-blue-600 truncate">
                                            ${escapeHtml(card.levelTitle)}
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-slate-600 leading-relaxed">
                                    ${escapeHtml(card.frontMain)}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold text-slate-400">Klik untuk arti</span>
                                <a
                                    href="${escapeHtml(card.materiUrl)}"
                                    onclick="event.stopPropagation()"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white text-[11px] font-extrabold transition-colors"
                                >
                                    <span>Buka Materi</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Sisi Belakang -->
                        <div
                            style="backface-visibility: hidden; transform: rotateY(180deg);"
                            class="col-start-1 row-start-1 bg-gradient-to-br from-[#EBF3FF] to-white rounded-3xl border-2 border-blue-200 shadow-soft-card p-5 flex flex-col justify-between gap-4"
                        >
                            <div class="space-y-2.5">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-2.5 py-1 rounded-full bg-blue-600 text-white text-[10px] font-extrabold uppercase tracking-wider">
                                        ${escapeHtml(card.backJudul)}
                                    </span>
                                    <span class="text-[11px] font-extrabold text-blue-700">
                                        ${escapeHtml(card.frontIsi)}
                                    </span>
                                </div>

                                <div class="text-sm sm:text-base font-extrabold text-slate-900 leading-snug pt-1">
                                    ${escapeHtml(card.backIsi)}
                                </div>

                                <div class="rounded-xl bg-white/90 border border-blue-100 px-3 py-2 text-xs text-slate-600 leading-relaxed">
                                    ${escapeHtml(card.backMain)}
                                </div>
                            </div>

                            <div class="pt-3 border-t border-blue-100 flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold text-blue-600">Klik untuk kembali</span>
                                <a
                                    href="${escapeHtml(card.materiUrl)}"
                                    onclick="event.stopPropagation()"
                                    class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-extrabold shadow-2xs transition-colors"
                                >
                                    <span>Latihan Level ${card.level}</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            }).join('');
        }

        document.addEventListener('DOMContentLoaded', () => {
            buildCardsFromMateriCatalog();
            populateLevelDropdown();
            filterKnowledgeCards();
        });
    </script>
@endpush
