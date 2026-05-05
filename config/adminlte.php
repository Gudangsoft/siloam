<?php

return [
    'title' => 'Admin Panel',
    'title_prefix' => '',
    'title_postfix' => ' | STT Siloam Medan',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => ['allowed' => true],

    'logo' => '<b>STT</b> Siloam',
    'logo_img' => 'images/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'STT Siloam Medan',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'images/logo.png',
            'alt' => 'STT Siloam Medan',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Loading...',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    'classes_body' => '',
    'classes_brand' => 'bg-primary',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => true,
    'dashboard_url' => 'admin.dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false,
    'password_reset_url' => false,
    'password_email_url' => false,
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    'laravel_asset_bundling' => false,

    'menu' => [
        [
            'type'         => 'navbar-search',
            'text'         => 'Cari...',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Cari Menu',
        ],

        // Dashboard
        [
            'text'   => 'Dashboard',
            'url'    => 'admin/dashboard',
            'route'  => 'admin.dashboard',
            'icon'   => 'fas fa-fw fa-tachometer-alt',
        ],

        // Konten Website
        ['header' => 'KONTEN WEBSITE'],

        [
            'text'    => 'Hero Banner',
            'url'     => 'admin/hero-banners',
            'route'   => 'admin.hero-banners.index',
            'icon'    => 'fas fa-fw fa-images',
        ],
        [
            'text'    => 'Berita & Artikel',
            'icon'    => 'fas fa-fw fa-newspaper',
            'submenu' => [
                [
                    'text'  => 'Semua Berita',
                    'url'   => 'admin/news',
                    'route' => 'admin.news.index',
                    'icon'  => 'fas fa-fw fa-circle',
                ],
                [
                    'text'  => 'Tambah Berita',
                    'url'   => 'admin/news/create',
                    'route' => 'admin.news.create',
                    'icon'  => 'fas fa-fw fa-plus',
                ],
            ],
        ],
        [
            'text'    => 'Event & Agenda',
            'url'     => 'admin/events',
            'route'   => 'admin.events.index',
            'icon'    => 'fas fa-fw fa-calendar-alt',
        ],
        [
            'text'    => 'Galeri Foto',
            'url'     => 'admin/gallery',
            'route'   => 'admin.gallery.index',
            'icon'    => 'fas fa-fw fa-photo-video',
        ],
        [
            'text'    => 'Video',
            'url'     => 'admin/videos',
            'route'   => 'admin.videos.index',
            'icon'    => 'fab fa-fw fa-youtube',
        ],

        // Profil Kampus
        ['header' => 'PROFIL KAMPUS'],

        [
            'text'    => 'Dosen & Staff',
            'url'     => 'admin/staff',
            'route'   => 'admin.staff.index',
            'icon'    => 'fas fa-fw fa-user-tie',
        ],
        [
            'text'    => 'Fasilitas',
            'url'     => 'admin/facilities',
            'route'   => 'admin.facilities.index',
            'icon'    => 'fas fa-fw fa-building',
        ],
        [
            'text'    => 'Halaman Statis',
            'url'     => 'admin/pages',
            'route'   => 'admin.pages.index',
            'icon'    => 'fas fa-fw fa-file-alt',
        ],

        // Akademik
        ['header' => 'AKADEMIK'],

        [
            'text'    => 'Program Studi',
            'url'     => 'admin/study-programs',
            'route'   => 'admin.study-programs.index',
            'icon'    => 'fas fa-fw fa-graduation-cap',
        ],
        [
            'text'    => 'Kalender Akademik',
            'url'     => 'admin/academic-calendars',
            'route'   => 'admin.academic-calendars.index',
            'icon'    => 'fas fa-fw fa-calendar',
        ],

        // PMB
        ['header' => 'PMB'],

        [
            'text'    => 'Pendaftaran Masuk',
            'url'     => 'admin/pmb',
            'route'   => 'admin.pmb.index',
            'icon'    => 'fas fa-fw fa-user-plus',
        ],
        [
            'text'    => 'Beasiswa',
            'url'     => 'admin/scholarships',
            'route'   => 'admin.scholarships.index',
            'icon'    => 'fas fa-fw fa-award',
        ],

        // Penelitian
        ['header' => 'PENELITIAN & PENGABDIAN'],

        [
            'text'    => 'Penelitian',
            'url'     => 'admin/research',
            'route'   => 'admin.research.index',
            'icon'    => 'fas fa-fw fa-flask',
        ],

        // Kemahasiswaan
        ['header' => 'KEMAHASISWAAN'],

        [
            'text'    => 'Organisasi Mahasiswa',
            'url'     => 'admin/student-organizations',
            'route'   => 'admin.student-organizations.index',
            'icon'    => 'fas fa-fw fa-users',
        ],
        [
            'text'    => 'Prestasi Mahasiswa',
            'url'     => 'admin/student-achievements',
            'route'   => 'admin.student-achievements.index',
            'icon'    => 'fas fa-fw fa-trophy',
        ],
        [
            'text'    => 'Alumni',
            'url'     => 'admin/alumni',
            'route'   => 'admin.alumni.index',
            'icon'    => 'fas fa-fw fa-user-graduate',
        ],

        // Kerjasama & Lainnya
        ['header' => 'LAINNYA'],

        [
            'text'    => 'Kerjasama',
            'url'     => 'admin/partnerships',
            'route'   => 'admin.partnerships.index',
            'icon'    => 'fas fa-fw fa-handshake',
        ],
        [
            'text'    => 'Pesan Masuk',
            'url'     => 'admin/contacts',
            'route'   => 'admin.contacts.index',
            'icon'    => 'fas fa-fw fa-envelope',
        ],
        [
            'text'    => 'Pengaturan',
            'url'     => 'admin/settings',
            'route'   => 'admin.settings.index',
            'icon'    => 'fas fa-fw fa-cog',
        ],

        // Lihat Website
        ['header' => 'WEBSITE'],
        [
            'text'        => 'Lihat Website',
            'url'         => '/',
            'icon'        => 'fas fa-fw fa-external-link-alt',
            'target'      => '_blank',
        ],
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js',
                ],
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type'     => 'css',
                    'asset'    => false,
                    'location' => 'https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                ],
                [
                    'type'     => 'css',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
                ],
                [
                    'type'     => 'css',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js',
                ],
                [
                    'type'     => 'css',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/chart.js',
                ],
            ],
        ],
        'Summernote' => [
            'active' => true,
            'files' => [
                [
                    'type'     => 'js',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js',
                ],
                [
                    'type'     => 'css',
                    'asset'    => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css',
                ],
            ],
        ],
    ],
];
