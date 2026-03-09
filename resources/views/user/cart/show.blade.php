{{-- resources/views/user/cart/show.blade.php --}}
@extends('layout.user')
@section('title', 'Keranjang Belanja')
@section('content')

<div class="container mx-auto px-4 pt-6">
    <x-breadcrumb :links="$links" />
</div>
<div class="container mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-8">Keranjang Belanja</h2>

    @if(empty($cart) || $cart->items->isEmpty())
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <svg class="w-20 h-20 text-gray-200 dark:text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-gray-400 dark:text-gray-500 text-lg font-medium">Keranjang belanja Anda kosong</p>
            <a href="{{ route('home') }}" class="mt-4 text-sm text-bluefilterpedia hover:underline">Mulai belanja →</a>
        </div>

    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ===== KIRI: DAFTAR ITEM ===== --}}
            <div class="lg:col-span-2 space-y-3">

                {{-- Select All --}}
                <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-sm font-medium text-gray-600 dark:text-gray-300">
                        <div class="relative">
                            <input type="checkbox" id="selectAll" class="sr-only peer">
                            <div class="w-5 h-5 rounded border-2 border-gray-300 dark:border-gray-600 peer-checked:border-bluefilterpedia peer-checked:bg-bluefilterpedia transition-all duration-150 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white hidden check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        Pilih Semua
                    </label>
                    <span class="ml-auto text-xs text-gray-400" id="selectedCount">0 item dipilih</span>
                </div>

                {{-- Item Cards --}}
                @foreach($cart->items as $item)
                <div class="cart-item-card group relative bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700
                            hover:border-bluefilterpedia/40 hover:shadow-md
                            transition-all duration-200"
                     data-id="{{ $item->product_id }}"
                     data-price="{{ $item->product->price }}"
                     data-stock="{{ $item->product->stock }}">

                    <div class="flex items-center gap-4 p-4">

                        {{-- Checkbox --}}
                        <label class="flex-shrink-0 cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" class="item-checkbox sr-only peer" data-id="{{ $item->product_id }}">
                                <div class="w-5 h-5 rounded border-2 border-gray-300 dark:border-gray-600
                                            peer-checked:border-bluefilterpedia peer-checked:bg-bluefilterpedia
                                            transition-all duration-150 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white hidden check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        {{-- Product Image --}}
                        <a href="{{ route('product.show', $item->product->slug) }}"
                           class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                            @if ($item->product->primaryImage)
                                <img src="{{ asset('storage/' . $item->product->primaryImage->path) }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </a>

                        {{-- Product Info --}}
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('product.show', $item->product->slug) }}"
                               class="block font-medium text-gray-900 dark:text-gray-100 text-sm leading-snug
                                      hover:text-bluefilterpedia truncate md:whitespace-normal transition">
                                {{ $item->product->name }}
                            </a>
                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $item->product->sku }}</p>
                            <p class="mt-1 text-sm font-semibold text-bluefilterpedia">
                                Rp {{ number_format($item->product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Right: Qty + Subtotal + Delete --}}
                        <div class="flex-shrink-0 flex flex-col items-end gap-3">

                            {{-- Qty Controls --}}
                            <div class="inline-flex items-center border border-gray-200 dark:border-gray-600 rounded-lg overflow-hidden">
                                <button type="button"
                                    class="minus w-8 h-8 flex items-center justify-center
                                           bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600
                                           text-gray-600 dark:text-gray-300 font-bold text-base
                                           transition disabled:opacity-40 disabled:cursor-not-allowed select-none"
                                    data-id="{{ $item->product_id }}"
                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                    &minus;
                                </button>
                                <span class="qty w-8 text-center text-sm font-semibold
                                             text-gray-800 dark:text-gray-200
                                             border-x border-gray-200 dark:border-gray-600
                                             bg-white dark:bg-gray-800 h-8 flex items-center justify-center">
                                    {{ $item->quantity }}
                                </span>
                                <button type="button"
                                    class="plus w-8 h-8 flex items-center justify-center
                                           bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600
                                           text-gray-600 dark:text-gray-300 font-bold text-base
                                           transition disabled:opacity-40 disabled:cursor-not-allowed select-none"
                                    data-id="{{ $item->product_id }}"
                                    {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>

                            {{-- Subtotal --}}
                            <span class="item-subtotal text-sm font-bold text-gray-800 dark:text-gray-100">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </span>

                            {{-- Delete --}}
                            <button type="button"
                                class="remove-item p-1.5 rounded-lg text-gray-300 dark:text-gray-600
                                       hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20
                                       transition-all duration-150"
                                data-id="{{ $item->product_id }}"
                                title="Hapus item">
                                <svg class="w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>

                        </div>
                    </div>

                    {{-- Unchecked dim overlay --}}
                    <div class="item-dim-overlay absolute inset-0 rounded-xl bg-white/60 dark:bg-gray-800/60 pointer-events-none opacity-0 transition-opacity duration-200"></div>
                </div>
                @endforeach

            </div>

            {{-- ===== KANAN: RINGKASAN ===== --}}
            <div class="lg:sticky lg:top-24 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-bold text-gray-900 dark:text-gray-100">Ringkasan Pesanan</h3>
                </div>

                <div class="px-5 py-4">
                    {{-- Summary Items List --}}
                    <div id="cart-items-summary" class="space-y-2 mb-4 max-h-52 overflow-y-auto pr-1">
                        @foreach($cart->items as $item)
                        <div class="summary-item hidden flex justify-between text-xs text-gray-600 dark:text-gray-400"
                             data-id="{{ $item->product_id }}">
                            <span class="summary-name truncate mr-2 max-w-[65%]">
                                {{ $item->product->name }} <span class="summary-qty text-gray-400">×{{ $item->quantity }}</span>
                            </span>
                            <span class="item-total font-medium whitespace-nowrap">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach

                        <p id="summaryEmpty" class="text-xs text-center text-gray-400 py-2">
                            Pilih item untuk melihat ringkasan
                        </p>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-700 mb-4">

                    {{-- Totals --}}
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>Subtotal</span>
                            <span id="subtotal" class="font-medium text-gray-800 dark:text-gray-200">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>PPN 12%</span>
                            <span id="ppn" class="font-medium text-gray-800 dark:text-gray-200">Rp 0</span>
                        </div>
                        <div class="flex justify-between font-bold text-base text-gray-900 dark:text-gray-100 pt-2 border-t border-gray-100 dark:border-gray-700 mt-2">
                            <span>Total</span>
                            <span id="total" class="text-bluefilterpedia">Rp 0</span>
                        </div>
                    </div>

                    {{-- WhatsApp Button --}}
                    <a id="waOrderBtn"
                       href="#"
                       target="_blank"
                       class="mt-5 flex items-center justify-center gap-2
                              w-full bg-green-600 hover:bg-green-700
                              text-white font-semibold text-sm
                              py-3 rounded-xl
                              shadow-md hover:shadow-lg
                              transition-all duration-200
                              opacity-50 pointer-events-none"
                       id="waOrderBtn">
                        <img src="{{ asset('storage/img/logo/waicon1.png') }}" alt="WhatsApp" class="h-4 w-4 object-contain">
                        Pesan via WhatsApp
                    </a>

                    <p class="text-xs text-center text-gray-400 mt-2" id="waHint">
                        Pilih item terlebih dahulu
                    </p>
                </div>

            </div>
        </div>
    @endif
</div>

@if(!empty($cart) && !$cart->items->isEmpty())
<script>
// ===== UTILITIES =====
function formatRupiah(number) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
}

const PPN_RATE = 0.12;

// ===== STATE =====
// Build item state from server-rendered data
const itemState = {};
document.querySelectorAll('.cart-item-card').forEach(card => {
    const id = card.dataset.id;
    const qty = parseInt(card.querySelector('.qty').innerText);
    const price = parseInt(card.dataset.price);
    const stock = parseInt(card.dataset.stock);
    itemState[id] = { qty, price, stock, checked: false };
});

// ===== CHECKBOX RENDERING =====
function renderCheckbox(input) {
    const box = input.nextElementSibling; // the styled div
    const icon = box.querySelector('.check-icon');
    if (input.checked) {
        box.classList.add('border-bluefilterpedia', 'bg-bluefilterpedia');
        box.classList.remove('border-gray-300', 'dark:border-gray-600');
        icon.classList.remove('hidden');
    } else {
        box.classList.remove('border-bluefilterpedia', 'bg-bluefilterpedia');
        box.classList.add('border-gray-300', 'dark:border-gray-600');
        icon.classList.add('hidden');
    }
}

// ===== SUMMARY RECALCULATION =====
function recalcSummary() {
    let subtotal = 0;
    let selectedCount = 0;

    document.querySelectorAll('.item-checkbox').forEach(cb => {
        const id = cb.dataset.id;
        const state = itemState[id];
        const summaryItem = document.querySelector(`#cart-items-summary [data-id="${id}"]`);

        if (cb.checked) {
            subtotal += state.price * state.qty;
            selectedCount++;
            if (summaryItem) summaryItem.classList.remove('hidden');
        } else {
            if (summaryItem) summaryItem.classList.add('hidden');
        }

        // Dim unchecked cards
        const card = document.querySelector(`.cart-item-card[data-id="${id}"]`);
        if (card) {
            const overlay = card.querySelector('.item-dim-overlay');
            overlay.style.opacity = cb.checked ? '0' : '0.35';
        }
    });

    const ppn = subtotal * PPN_RATE;
    const total = subtotal + ppn;

    document.getElementById('subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('ppn').innerText = formatRupiah(ppn);
    document.getElementById('total').innerText = formatRupiah(total);
    document.getElementById('selectedCount').innerText = selectedCount + ' item dipilih';

    // Empty summary notice
    const summaryEmpty = document.getElementById('summaryEmpty');
    summaryEmpty.style.display = selectedCount === 0 ? 'block' : 'none';

    // WA Button
    const waBtn = document.getElementById('waOrderBtn');
    const waHint = document.getElementById('waHint');
    if (selectedCount > 0) {
        waBtn.classList.remove('opacity-50', 'pointer-events-none');
        waHint.classList.add('hidden');
        // Build WA message from checked items only
        let message = "Halo, saya ingin memesan:\n";
        document.querySelectorAll('.item-checkbox').forEach(cb => {
            if (cb.checked) {
                const id = cb.dataset.id;
                const state = itemState[id];
                const card = document.querySelector(`.cart-item-card[data-id="${id}"]`);
                const name = card.querySelector('a.block').innerText.trim();
                message += `- ${name} x ${state.qty}\n`;
            }
        });
        message += `\nSubtotal: ${formatRupiah(subtotal)}`;
        message += `\nPPN 12%: ${formatRupiah(ppn)}`;
        message += `\nTotal: ${formatRupiah(total)}`;
        waBtn.href = `https://wa.me/6281282388324?text=${encodeURIComponent(message)}`;
    } else {
        waBtn.classList.add('opacity-50', 'pointer-events-none');
        waBtn.href = '#';
        waHint.classList.remove('hidden');
    }

    // Sync selectAll checkbox
    const allCheckboxes = document.querySelectorAll('.item-checkbox');
    const allChecked = [...allCheckboxes].every(cb => cb.checked);
    const selectAllInput = document.getElementById('selectAll');
    selectAllInput.checked = allChecked;
    renderCheckbox(selectAllInput);
}

// ===== SELECT ALL =====
document.getElementById('selectAll').addEventListener('change', function() {
    renderCheckbox(this);
    document.querySelectorAll('.item-checkbox').forEach(cb => {
        cb.checked = this.checked;
        renderCheckbox(cb);
    });
    // Update state
    Object.keys(itemState).forEach(id => {
        itemState[id].checked = this.checked;
    });
    recalcSummary();
});

// ===== ITEM CHECKBOXES =====
document.querySelectorAll('.item-checkbox').forEach(cb => {
    cb.addEventListener('change', function() {
        renderCheckbox(this);
        itemState[this.dataset.id].checked = this.checked;
        recalcSummary();
    });
});

// ===== QUANTITY CONTROLS =====
document.querySelectorAll('.plus, .minus').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const card = this.closest('.cart-item-card');
        const qtyEl = card.querySelector('.qty');
        const minusBtn = card.querySelector('.minus');
        const plusBtn = card.querySelector('.plus');
        const subtotalEl = card.querySelector('.item-subtotal');
        const state = itemState[id];

        let newQty = parseInt(qtyEl.innerText);
        newQty += this.classList.contains('plus') ? 1 : -1;

        if (newQty < 1) {
            confirmRemove(id, card);
            return;
        }

        fetch(`/cart/${id}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: newQty })
        })
        .then(r => r.ok ? r.json() : r.json().then(e => { throw new Error(e.message || 'Server error'); }))
        .then(data => {
            if (data.removed) {
                removeCardFromDOM(id, card);
                return;
            }
            if (data.success) {
                state.qty = newQty;
                qtyEl.innerText = newQty;
                subtotalEl.innerText = formatRupiah(state.price * newQty);

                // Update summary qty label
                const summaryQty = document.querySelector(`#cart-items-summary [data-id="${id}"] .summary-qty`);
                if (summaryQty) summaryQty.innerText = '×' + newQty;
                const summaryTotal = document.querySelector(`#cart-items-summary [data-id="${id}"] .item-total`);
                if (summaryTotal) summaryTotal.innerText = formatRupiah(state.price * newQty);

                // Toggle buttons
                minusBtn.disabled = newQty <= 1;
                plusBtn.disabled = newQty >= state.stock;

                if (data.cart_empty) location.reload();
                recalcSummary();
            }
        })
        .catch(err => alert('Error: ' + err.message));
    });
});

// ===== REMOVE =====
function confirmRemove(id, card) {
    if (!confirm('Hapus item ini dari keranjang?')) return;

    fetch(`/cart/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(r => r.ok ? r.json() : r.json().then(e => { throw new Error(e.message || 'Server error'); }))
    .then(data => {
        if (data.success) {
            removeCardFromDOM(id, card);
            if (data.cart_empty) location.reload();
        }
    })
    .catch(err => alert('Error: ' + err.message));
}

function removeCardFromDOM(id, card) {
    // Animate out
    card.style.transition = 'opacity 0.2s, transform 0.2s';
    card.style.opacity = '0';
    card.style.transform = 'translateX(-8px)';
    setTimeout(() => {
        card.remove();
        const summaryItem = document.querySelector(`#cart-items-summary [data-id="${id}"]`);
        if (summaryItem) summaryItem.remove();
        delete itemState[id];
        recalcSummary();
        // If no items left, reload
        if (Object.keys(itemState).length === 0) location.reload();
    }, 200);
}

document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const card = this.closest('.cart-item-card');
        confirmRemove(id, card);
    });
});

// Init
recalcSummary();
</script>

<style>
/* Custom scrollbar for summary list */
#cart-items-summary::-webkit-scrollbar { width: 4px; }
#cart-items-summary::-webkit-scrollbar-track { background: transparent; }
#cart-items-summary::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 999px; }

/* Smooth card entrance */
.cart-item-card {
    animation: slideIn 0.2s ease both;
}
@keyframes slideIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>
@endif

@endsection