-- Tambah kolom baru ke tabel pmb_registrations
-- Jalankan di phpMyAdmin production (siloamdb)

ALTER TABLE `pmb_registrations`
    ADD COLUMN `citizenship`         VARCHAR(100) NULL DEFAULT 'WNI' AFTER `birth_place`,
    ADD COLUMN `major`               VARCHAR(100) NULL AFTER `high_school_name`,
    ADD COLUMN `reason`              TEXT NULL AFTER `study_program`,
    ADD COLUMN `service_experience`  TEXT NULL AFTER `reason`;

-- Catat migration
INSERT IGNORE INTO `migrations` (`migration`, `batch`)
VALUES ('2026_05_12_060000_add_extra_fields_to_pmb_registrations_table', 99);
