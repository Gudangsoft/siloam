-- Tambah kolom baru ke tabel staff
-- Jalankan di phpMyAdmin production (siloamdb)

ALTER TABLE `staff`
    ADD COLUMN `nuptk`       VARCHAR(30)  NULL AFTER `nidn`,
    ADD COLUMN `birth_place` VARCHAR(100) NULL AFTER `nuptk`,
    ADD COLUMN `birth_date`  DATE         NULL AFTER `birth_place`,
    ADD COLUMN `church`      VARCHAR(255) NULL AFTER `birth_date`,
    ADD COLUMN `courses`     TEXT         NULL AFTER `expertise`;

-- Catat migration agar Laravel tidak menjalankan ulang
INSERT IGNORE INTO `migrations` (`migration`, `batch`)
VALUES ('2026_05_12_034637_add_extended_fields_to_staff_table', 99);
