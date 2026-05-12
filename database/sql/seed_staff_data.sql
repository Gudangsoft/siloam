-- Data Fungsionaris dan Dosen STT Siloam Medan
-- Jalankan di phpMyAdmin production (siloamdb)
-- Pastikan kolom baru sudah ada (jalankan add_staff_extended_fields.sql terlebih dahulu)

INSERT INTO `staff`
    (`name`, `position`, `category`, `nuptk`, `birth_place`, `birth_date`, `church`, `courses`, `is_active`, `order`, `created_at`, `updated_at`)
VALUES
(
    'MERLIN SANTINUS, M.Pd.K',
    'Ketua',
    'pimpinan',
    '7863759660130152',
    'Muara Siberut',
    '1982-05-31',
    'GSKI Metanoia Medan',
    'SGI, Sejarah Perkembangan, Filsafat PAK, Metode Penelaahan Alkitab di Sekolah dan Jemaat',
    1, 1, NOW(), NOW()
),
(
    'RINTO FRANCIUS SIRAIT, S.Pd., M.Th.',
    'Wakil Ketua Bidang Akademik',
    'pimpinan',
    '3762759660130182',
    'N. Lama',
    '1981-04-30',
    'GSKI Voice of Truth Medan',
    'PP PL 1, PP PL 2, Teologi PL 1, Teologi PL 2, Bahasa Ibrani, Tafsir PL, Teologi Agama-Agama, Dogmatika',
    1, 2, NOW(), NOW()
),
(
    'SANTIANA PASARIBU, M.Pd',
    'Wakil Ketua Bidang Keuangan',
    'pimpinan',
    '6442763664230353',
    'Tanjung Harapan',
    '1985-11-10',
    'GGP Filadelfia',
    NULL,
    1, 3, NOW(), NOW()
),
(
    'ASAL PARLINDUNGAN TAMBUNAN, M.Th.',
    'Wakil Ketua Bidang Kemahasiswaan',
    'pimpinan',
    '9901005538',
    'Medan',
    '1960-04-15',
    'GKI Sumut',
    'Pengantar dan Pembimbing PB, Formasi Spiritual, Bahasa Yunani, Tafsir Perjanjian Baru, Teologi Perjanjian Baru, Homiletika',
    1, 4, NOW(), NOW()
),
(
    'TRI MARTHA SINAGA, M.Pd.K',
    'Kaprodi PAK',
    'dosen',
    '0638761662230292',
    'Medan',
    '1983-03-06',
    'GBI Bukit Zaitun',
    'Perencanaan Pembelajaran PAK, Teori Belajar PAK, PAK Dewasa, Praktik Kependidikan Pelayanan Anak',
    1, 5, NOW(), NOW()
),
(
    'JUWITA HERAWATI SAMOSIR, S.Th., M.Pd.K',
    'Dosen Tetap',
    'dosen',
    '6059746648300033',
    'Medan',
    '1968-07-27',
    'GBI Kampung Pon',
    'PAK Anak, PAK Remaja, Kode Etik dan Profesionalitas Guru, PAK Dalam Masyarakat Majemuk',
    1, 6, NOW(), NOW()
),
(
    'AMRI EDWIN SIMANJUNTAK, S.Th., M.Pd.K',
    'Dosen Tetap',
    'dosen',
    '4049765666130283',
    'P. Lalang',
    '1987-07-17',
    'GPDI Maranatha',
    'MBS, Pembimbing PAK, Sejarah PAK',
    1, 7, NOW(), NOW()
),
(
    'MARIANI PASARIBU, M.Pd.',
    'Dosen',
    'dosen',
    '6063767668230243',
    'Tanjung Harapan',
    '1989-07-31',
    'HKBP',
    'Bahasa Indonesia, Statistika, Sosiologi',
    1, 8, NOW(), NOW()
);
