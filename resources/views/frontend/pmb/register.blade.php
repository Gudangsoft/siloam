@extends('layouts.frontend')
@section('title', 'Pendaftaran Mahasiswa Baru | STT Siloam Medan')
@section('content')

{{-- Page Header --}}
<div class="bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Formulir Pendaftaran Mahasiswa Baru</h1>
        <nav class="text-sm mt-2">
            <a href="{{ route('home') }}" class="text-blue-300 hover:text-white">Beranda</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <a href="{{ route('pmb.index') }}" class="text-blue-300 hover:text-white">PMB</a>
            <span class="mx-2 text-blue-400">&#x203A;</span>
            <span class="text-white">Formulir Pendaftaran</span>
        </nav>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('pmb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Data Pribadi --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</span>
                    Data Pribadi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                               placeholder="Masukkan nama lengkap sesuai KTP">
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                               placeholder="contoh@email.com">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                               placeholder="08xxxxxxxxxx">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="gender" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gender') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Kota tempat lahir">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" required rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror"
                                  placeholder="Jalan, Nomor, RT/RW, Kelurahan, Kecamatan">{{ old('address') }}</textarea>
                        @error('address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Kota</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Kota domisili">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Provinsi domisili">
                    </div>
                </div>
            </div>

            {{-- Pendidikan Terakhir --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">2</span>
                    Pendidikan Terakhir
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-semibold mb-2">Nama Sekolah/Asal Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="school_name" value="{{ old('school_name') }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('school_name') border-red-500 @enderror"
                               placeholder="Nama sekolah asal">
                        @error('school_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Tahun Lulus <span class="text-red-500">*</span></label>
                        <input type="number" name="graduation_year" value="{{ old('graduation_year') }}" required
                               min="1990" max="{{ date('Y') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('graduation_year') border-red-500 @enderror"
                               placeholder="{{ date('Y') }}">
                        @error('graduation_year')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Pilihan Program Studi <span class="text-red-500">*</span></label>
                        <select name="program_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('program_id') border-red-500 @enderror">
                            <option value="">-- Pilih Program Studi --</option>
                            @if(isset($programs))
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }} {{ $program->degree ? '(' . $program->degree . ')' : '' }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                        @error('program_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">3</span>
                    Data Orang Tua / Wali
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                        <input type="text" name="father_name" value="{{ old('father_name') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nama ayah kandung">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Pekerjaan Ayah</label>
                        <input type="text" name="father_occupation" value="{{ old('father_occupation') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Pekerjaan ayah">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Ibu</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nama ibu kandung">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Pekerjaan Ibu</label>
                        <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Pekerjaan ibu">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Telepon Orang Tua / Wali</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="08xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Penghasilan Orang Tua per Bulan</label>
                        <select name="parent_income" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih --</option>
                            <option value="< 1jt" {{ old('parent_income') === '< 1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                            <option value="1-3jt" {{ old('parent_income') === '1-3jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                            <option value="3-5jt" {{ old('parent_income') === '3-5jt' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                            <option value="> 5jt" {{ old('parent_income') === '> 5jt' ? 'selected' : '' }}>Lebih dari Rp 5.000.000</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Upload Dokumen --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-6 flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">4</span>
                    Upload Dokumen
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Foto Terbaru <span class="text-red-500">*</span></label>
                        <input type="file" name="photo" accept="image/*" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('photo') border-red-500 @enderror">
                        <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG. Maks: 2MB</p>
                        @error('photo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Scan Ijazah / Surat Keterangan Lulus</label>
                        <input type="file" name="ijazah" accept=".pdf,image/*"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-gray-400 text-xs mt-1">Format: PDF, JPG, PNG. Maks: 5MB</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <p class="text-gray-600 mb-4 text-sm">Dengan mendaftar, Anda menyatakan bahwa data yang diisi adalah benar dan bertanggung jawab atas kebenaran data tersebut.</p>
                <button type="submit"
                        class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 px-12 rounded-full text-lg transition duration-300 shadow-lg">
                    Kirim Formulir Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
