@extends('layouts.frontend')
@section('title', 'Formulir Pendaftaran Mahasiswa Baru | STT Siloam Medan')
@section('content')

{{-- Header --}}
<div class="text-white py-14 relative overflow-hidden"
     style="background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 60%,#1d4ed8 100%)">
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-15 flex items-center justify-center">
                <i class="fas fa-user-plus text-yellow-400 text-lg"></i>
            </div>
            <nav class="text-sm text-blue-300">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">›</span>
                <a href="{{ route('pmb.index') }}" class="hover:text-white">PMB</a>
                <span class="mx-2">›</span>
                <span class="text-white">Formulir Pendaftaran</span>
            </nav>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Formulir Pendaftaran</h1>
        <p class="text-blue-200 text-sm">Penerimaan Mahasiswa Baru STT Siloam Medan — isi semua data dengan benar.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">

        @if(session('success'))
        <div class="bg-green-50 border border-green-300 text-green-700 px-5 py-4 rounded-xl mb-6 flex items-start gap-3">
            <i class="fas fa-check-circle text-xl mt-0.5 flex-shrink-0"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-5 py-4 rounded-xl mb-6">
            <p class="font-semibold mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Harap periksa kembali:</p>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('pmb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- ① Data Pribadi --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 flex items-center gap-3" style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <span class="w-8 h-8 rounded-full bg-white bg-opacity-20 text-white text-sm font-bold flex items-center justify-center flex-shrink-0">1</span>
                    <h2 class="text-white font-bold text-lg">Data Pribadi</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                   class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('full_name') border-red-400 bg-red-50 @enderror border-gray-300"
                                   placeholder="Nama lengkap sesuai identitas">
                            @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" required
                                    class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('gender') border-red-400 bg-red-50 @enderror border-gray-300">
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('gender') === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('gender') === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                   class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('phone') border-red-400 bg-red-50 @enderror border-gray-300"
                                   placeholder="08xxxxxxxxxx">
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Tanggal Lahir</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Tempat Lahir</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Kota tempat lahir">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Kewarganegaraan</label>
                            <input type="text" name="citizenship" value="{{ old('citizenship', 'WNI') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="WNI / WNA">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="contoh@email.com">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Alamat Lengkap</label>
                            <textarea name="address" rows="2"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                      placeholder="Jl., RT/RW, Kelurahan, Kecamatan">{{ old('address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Kota</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Kota domisili">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Provinsi</label>
                            <input type="text" name="province" value="{{ old('province') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Provinsi domisili">
                        </div>

                    </div>
                </div>
            </div>

            {{-- ② Pendidikan & Pilihan Studi --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 flex items-center gap-3" style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <span class="w-8 h-8 rounded-full bg-white bg-opacity-20 text-white text-sm font-bold flex items-center justify-center flex-shrink-0">2</span>
                    <h2 class="text-white font-bold text-lg">Pendidikan & Pilihan Studi</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Asal Sekolah <span class="text-red-500">*</span></label>
                            <input type="text" name="high_school_name" value="{{ old('high_school_name') }}" required
                                   class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('high_school_name') border-red-400 bg-red-50 @enderror border-gray-300"
                                   placeholder="Nama SMA/SMK/MA/sederajat">
                            @error('high_school_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Jurusan</label>
                            <input type="text" name="major" value="{{ old('major') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="IPA / IPS / Teknik / dll">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Tahun Lulus <span class="text-red-500">*</span></label>
                            <input type="number" name="graduation_year" value="{{ old('graduation_year') }}" required
                                   min="1990" max="{{ date('Y') }}"
                                   class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('graduation_year') border-red-400 bg-red-50 @enderror border-gray-300"
                                   placeholder="{{ date('Y') }}">
                            @error('graduation_year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Pilihan Program Studi <span class="text-red-500">*</span></label>
                            <select name="study_program" required
                                    class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('study_program') border-red-400 bg-red-50 @enderror border-gray-300">
                                <option value="">-- Pilih Program Studi --</option>
                                @if(isset($programs) && $programs->count())
                                    @foreach($programs as $program)
                                    <option value="{{ $program->name }}" {{ old('study_program') == $program->name ? 'selected' : '' }}>
                                        {{ $program->name }}{{ $program->degree ? ' (' . $program->degree . ')' : '' }}
                                    </option>
                                    @endforeach
                                @else
                                    <option value="Pendidikan Agama Kristen (S1)" {{ old('study_program') == 'Pendidikan Agama Kristen (S1)' ? 'selected' : '' }}>Pendidikan Agama Kristen (S1)</option>
                                    <option value="Teologi (S1)" {{ old('study_program') == 'Teologi (S1)' ? 'selected' : '' }}>Teologi (S1)</option>
                                @endif
                            </select>
                            @error('study_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- ③ Motivasi & Pengalaman Pelayanan --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 flex items-center gap-3" style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <span class="w-8 h-8 rounded-full bg-white bg-opacity-20 text-white text-sm font-bold flex items-center justify-center flex-shrink-0">3</span>
                    <h2 class="text-white font-bold text-lg">Motivasi & Pengalaman</h2>
                </div>
                <div class="p-6 space-y-5">

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1.5 text-sm">
                            Alasan Memilih Kuliah di STT Siloam Medan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="reason" rows="4" required
                                  class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('reason') border-red-400 bg-red-50 @enderror border-gray-300"
                                  placeholder="Ceritakan alasan Anda memilih STT Siloam Medan sebagai tempat belajar teologi...">{{ old('reason') }}</textarea>
                        @error('reason')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-1.5 text-sm">
                            Pengalaman Pelayanan Anda <span class="text-red-500">*</span>
                        </label>
                        <textarea name="service_experience" rows="4" required
                                  class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('service_experience') border-red-400 bg-red-50 @enderror border-gray-300"
                                  placeholder="Ceritakan pengalaman pelayanan Anda di gereja, komunitas, atau organisasi kristiani...">{{ old('service_experience') }}</textarea>
                        @error('service_experience')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                </div>
            </div>

            {{-- ④ Data Orang Tua / Wali --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 flex items-center gap-3" style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <span class="w-8 h-8 rounded-full bg-white bg-opacity-20 text-white text-sm font-bold flex items-center justify-center flex-shrink-0">4</span>
                    <h2 class="text-white font-bold text-lg">Data Orang Tua / Wali</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Nama Ayah</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Nama ayah kandung">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Pekerjaan Ayah</label>
                            <input type="text" name="father_occupation" value="{{ old('father_occupation') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Pekerjaan ayah">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Nama Ibu</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Nama ibu kandung">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Pekerjaan Ibu</label>
                            <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="Pekerjaan ibu">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Telepon Orang Tua / Wali</label>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Penghasilan Orang Tua per Bulan</label>
                            <select name="parent_income"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih --</option>
                                <option value="< 1jt" {{ old('parent_income') === '< 1jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                <option value="1-3jt" {{ old('parent_income') === '1-3jt' ? 'selected' : '' }}>Rp 1.000.000 – Rp 3.000.000</option>
                                <option value="3-5jt" {{ old('parent_income') === '3-5jt' ? 'selected' : '' }}>Rp 3.000.000 – Rp 5.000.000</option>
                                <option value="> 5jt" {{ old('parent_income') === '> 5jt' ? 'selected' : '' }}>Lebih dari Rp 5.000.000</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ⑤ Upload Dokumen --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 flex items-center gap-3" style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <span class="w-8 h-8 rounded-full bg-white bg-opacity-20 text-white text-sm font-bold flex items-center justify-center flex-shrink-0">5</span>
                    <h2 class="text-white font-bold text-lg">Upload Dokumen</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Foto Terbaru</label>
                            <input type="file" name="photo" accept="image/*"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none @error('photo') border-red-400 @enderror">
                            <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG. Maks: 2MB</p>
                            @error('photo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm">Scan Ijazah / SKL</label>
                            <input type="file" name="ijazah_document" accept=".pdf,image/*"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <p class="text-gray-400 text-xs mt-1">Format: PDF, JPG, PNG. Maks: 5MB</p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                <p class="text-gray-500 text-sm mb-5">
                    Dengan mengirimkan formulir ini, Anda menyatakan bahwa seluruh data yang diisi adalah
                    benar dan dapat dipertanggungjawabkan.
                </p>
                <button type="submit"
                        class="inline-flex items-center gap-3 text-white font-bold py-4 px-12 rounded-full text-base transition duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5"
                        style="background:linear-gradient(135deg,#1e3a8a,#2563eb)">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Formulir Pendaftaran
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
