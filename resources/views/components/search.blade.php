<form
    action="{{ route('search.index') }}"
    method="GET"
    data-search
    class="relative w-full max-w-md"
>
    <input
        type="text"
        name="q"
        data-search-input
        placeholder="Cari produk…"
        autocomplete="off"
        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm
               bg-white 
               text-gray-900
               border-gray-300
               focus:border-bluefilterpedia 
               focus:outline-none
               placeholder:text-gray-500"
    >
   
    <div
        data-search-dropdown
        class="absolute left-0 top-full z-[9999] mt-2 hidden
               w-full md:w-[calc(100%+50px)] 
               rounded-lg border 
               bg-white 
               border-gray-200 
               shadow-xl
               overflow-hidden"
    ></div>
</form>

<script>
(function () {
    const wrappers = document.querySelectorAll('[data-search]')

    wrappers.forEach(wrapper => {
        const input = wrapper.querySelector('[data-search-input]')
        const dropdown = wrapper.querySelector('[data-search-dropdown]')
        let controller = null

        if (!input || !dropdown) return

        input.addEventListener('input', async () => {
            const q = input.value.trim()

            if (q.length < 2) {
                dropdown.classList.add('hidden')
                dropdown.innerHTML = ''
                return
            }

            if (controller) controller.abort()
            controller = new AbortController()

            try {
                const res = await fetch(`/search/products?q=${encodeURIComponent(q)}`, {
                    signal: controller.signal
                })

                if (!res.ok) return

                const data = await res.json()

                dropdown.innerHTML = data.length
                    ? data.map(p => `
<a href="${p.url}" 
   class="flex items-center gap-3 p-3 
          hover:bg-gray-100
          text-gray-900">
    <img src="${p.image || '/img/placeholder.png'}" 
         class="h-10 w-10 rounded object-cover">
    <span class="text-sm font-medium">
        ${p.name.replace(new RegExp(q, "gi"), match => 
            `<mark class="bg-[#0672b7] text-white rounded px-1">${match}</mark>`
        )}
    </span>
</a>
                    `).join('')
                    : `<div class="p-3 text-sm text-gray-500">Produk tidak ditemukan</div>`

                dropdown.classList.remove('hidden')
            } catch (e) {
                if (e.name !== 'AbortError') console.error(e)
            }
        })

        document.addEventListener('click', e => {
            if (!wrapper.contains(e.target)) {
                dropdown.classList.add('hidden')
            }
        })
    })
})();
</script>