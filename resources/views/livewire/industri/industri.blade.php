<div class="p-6 bg-black text-white rounded-xl shadow-md">
        <div x-data>
            <button
                x-on:click="$wire.showModal = true"
                class="bg-gray-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-md transition duration-150"
            >
                Tambah
            </button>

            <!-- Modal -->
            <div
                x-show="$wire.showModal"
                x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
            >
                <div
                    class="bg-gray-900 text-white rounded-xl shadow-lg w-full max-w-md p-6"
                    @click.away="$wire.showModal = false"
                >
                    <h3 class="text-lg font-semibold mb-4">Tambah Industri</h3>

                    <form wire:submit.prevent="save">
                        <div class="mb-4">

                            <label class="block text-sm mb-1">Nama Industri</label>
                            <input wire:model.defer="nama" type="text"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded" />
                            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Bidang Usaha</label>
                            <input wire:model.defer="bidang_usaha"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded"></input>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Alamat</label>
                            <textarea wire:model.defer="alamat"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Kontak</label>
                            <input wire:model.defer="kontak"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded"></input>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Email</label>
                            <input wire:model.defer="email"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded"></input>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Website</label>
                            <input wire:model.defer="website"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded"></input>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button"
                                x-on:click="$wire.showModal = false"
                                class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded text-sm">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded text-sm text-white">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    
    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-y-2">
            <thead>
                <tr class="text-sm text-gray-300 uppercase tracking-wider">
                    <th class="text-left p-3 bg-gray-800 rounded-l-lg">Nama</th>
                    <th class="text-left p-3 bg-gray-800">Alamat</th>
                    <th class="text-left p-3 bg-gray-800 ">Kontak</th>
                    <th class="text-left p-3 bg-gray-800 rounded-r-lg">Website</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($industris as $item)
                    <tr class="bg-gray-800 hover:bg-gray-700 transition duration-100">
                        <td class="p-3 rounded-l-lg">{{ $item->nama }}</td>
                        <td class="p-3">{{ $item->alamat }}</td>
                        <td class="p-3">{{ $item->kontak }}</td>
                        <td class="p-3">{{ $item->website }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-400 p-4">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
