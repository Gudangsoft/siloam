-- Tambah kolom soft delete ke tabel pages
ALTER TABLE `pages` ADD COLUMN `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;
