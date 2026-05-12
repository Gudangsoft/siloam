-- Update dan tambah data staff STT Siloam Medan
-- Jalankan di phpMyAdmin production (siloamdb)
-- Pastikan add_staff_extended_fields.sql sudah dijalankan terlebih dahulu

-- ═══════════════════════════════════════════════════════════
-- BAGIAN 1: Update posisi Wakil Ketua yang sudah ada
-- ═══════════════════════════════════════════════════════════

UPDATE `staff` SET
    `position` = 'Wakil Ketua I Bidang Akademik',
    `birth_place` = 'N. Lama',
    `birth_date` = '1981-04-30',
    `church` = 'GSKI Voice of Truth Medan',
    `nuptk` = '3762759660130182',
    `courses` = 'PP PL 1, PP PL 2, Teologi PL 1, Teologi PL 2, Bahasa Ibrani, Tafsir PL, Teologi Agama-Agama, Dogmatika',
    `order` = 2,
    `updated_at` = NOW()
WHERE `name` LIKE '%RINTO FRANCIUS SIRAIT%';

UPDATE `staff` SET
    `position` = 'Wakil Ketua II Bidang Keuangan',
    `birth_place` = 'Tanjung Harapan',
    `birth_date` = '1985-11-10',
    `church` = 'GGP Filadelfia',
    `nuptk` = '6442763664230353',
    `order` = 3,
    `updated_at` = NOW()
WHERE `name` LIKE '%SANTIANA PASARIBU%';

UPDATE `staff` SET
    `position` = 'Wakil Ketua III Bidang Kemahasiswaan',
    `birth_place` = 'Medan',
    `birth_date` = '1960-04-15',
    `church` = 'GKI Sumut',
    `nuptk` = '9901005538',
    `courses` = 'Pengantar dan Pembimbing PB, Formasi Spiritual, Bahasa Yunani, Tafsir Perjanjian Baru, Teologi Perjanjian Baru, Homiletika',
    `order` = 4,
    `updated_at` = NOW()
WHERE `name` LIKE '%ASAL PARLINDUNGAN TAMBUNAN%';

UPDATE `staff` SET
    `position` = 'Kaprodi PAK',
    `category` = 'dosen',
    `order` = 5,
    `updated_at` = NOW()
WHERE `name` LIKE '%TRI MARTHA SINAGA%';

-- ═══════════════════════════════════════════════════════════
-- BAGIAN 2: Insert staff baru (yang belum ada)
-- ═══════════════════════════════════════════════════════════

INSERT INTO `staff` (`name`, `position`, `category`, `is_active`, `order`, `created_at`, `updated_at`)
VALUES
(
    'VENA ROY MARVA NAPITUPULU, M.Th.',
    'Dosen Tetap', 'dosen', 1, 8, NOW(), NOW()
),
(
    'SABAR MANIK, MA., M.Th.',
    'Dosen Tetap', 'dosen', 1, 9, NOW(), NOW()
),
(
    'MONA PUTRI SEMBIRING, M.Th.',
    'Dosen Tetap', 'dosen', 1, 11, NOW(), NOW()
),
(
    'REINHARD ANDREW PANGARIBUAN, M.Pd.',
    'Dosen Tetap', 'dosen', 1, 12, NOW(), NOW()
),
(
    'IVENNY PASARIBU, BA',
    'Administrasi Keuangan', 'tendik', 1, 13, NOW(), NOW()
),
(
    'PENI WIDYOWATI, S.Th.',
    'Kepala Perpustakaan', 'tendik', 1, 14, NOW(), NOW()
);

-- ═══════════════════════════════════════════════════════════
-- BAGIAN 3: Update Mariani Pasaribu jika sudah ada dari seed sebelumnya
-- ═══════════════════════════════════════════════════════════

UPDATE `staff` SET
    `order` = 10,
    `updated_at` = NOW()
WHERE `name` LIKE '%MARIANI PASARIBU%';
