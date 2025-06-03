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
                            <label class="block text-sm mb-1">Industri</label>
                            <select wire:model="industri_id">
                                <option value="">Pilih Industri</option>
                                @foreach ($industris as $industri )
                                <option value="{{$industri->id}}">{{ $industri->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Guru</label>
                            <select wire:model="guru_id">
                                <option value="">Pilih Guru Pembimbing</option>
                                @foreach ($gurus as $guru )
                                <option value="{{$guru->id}}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="mb-4">
                            <label class="block text-sm mb-1">Tanggal Mulai</label>
                            <input wire:model.defer="tanggal_mulai" type="date"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded" />
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm mb-1">Tanggal Selesai</label>
                            <input wire:model.defer="tanggal_selesai" type="date"
                                class="w-full px-3 py-2 bg-gray-800 text-white border border-gray-700 rounded" />
                                @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        </div>

                       

                        <div cflex justify-end space-x-2">
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
                    <th class="text-left p-3 bg-gray-800">Guru</th>
                    <th class="text-left p-3 bg-gray-800">Industri</th>
                    <th class="text-left p-3 bg-gray-800">Mulai</th>
                    <th class="text-left p-3 bg-gray-800 rounded-r-lg">Selesai</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($pkls as $pkl)

                    <tr class="bg-gray-800 hover:bg-gray-700 transition duration-100">
                        <td class="p-3 rounded-l-lg">{{ $pkl->siswa->nama }}</td>
                        <td class="p-3">{{ $pkl->guru->nama}}</td>
                        <td class="p-3">{{ $pkl->industri->nama }}</td>
                        <td class="p-3">{{ $pkl->tanggal_mulai }}</td>
                        <td class="p-3">{{ $pkl->tanggal_selesai }}</td>
                        
                    </tr>
            @empty
                        <p class="text-center text-gray-400 p-4">Belum ada data.</p>
            @endforelse
            </tbody>
            
        </table>
        
    </div>
</div>
