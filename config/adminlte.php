<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'POS',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>POS </b>BETA',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => true,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'dashboard/edit-profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
//        [
//            'type'         => 'navbar-search',
//            'text'         => 'search',
//            'topnav_right' => true,
//        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
//        [
//            'type' => 'sidebar-menu-search',
//            'text' => 'search',
//        ],
//        [
//            'text' => 'blog',
//            'url'  => 'admin/blog',
//            'can'  => 'manage-blog',
//        ],
//        [
//            'text'        => 'pages',
//            'url'         => 'admin/pages',
//            'icon'        => 'far fa-fw fa-file',
//            'label'       => 4,
//            'label_color' => 'success',
//        ],
        ['header' => 'اعدادات'],
//        [
//            'text' => 'مستخدمين النظام',
//            'url'  => 'dashboard/users',
//            'icon' => 'fas fa-fw fa-users',
//        ],

        [
            'text'    => 'مستخدمين النظام',
            'icon'    => 'fas fa-fw fa-users',
            'can'     =>'is_admin',
            'submenu' => [
                [
                    'text' => 'عرض الكل',
                    'url'  => 'dashboard/users',
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index users'
                ],

                [
                    'text' => 'مستخدم جديد',
                    'url'  => 'dashboard/users/create',
                    'icon'    => 'fas fa-fw fa-plus',
                    'can' =>'add users'
                ],
            ],
        ],
        [
            'text'    => 'المندوبين',
            'can'     =>['is_admin','index sales_men'],
            'icon'    => 'fas fa-fw fa-users',
            'submenu' => [
                [
                    'text' => 'عرض الكل',
                    'url'  => 'dashboard/sales-men',
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index sales_men'
                ],

                [
                    'text' => 'مندوب جديد',
                    'url'  => 'dashboard/sales-men/create',
                    'icon'    => 'fas fa-fw fa-plus',
                    'can' =>'add sales_men'
                ],
            ],
        ],
        [
            'text'    => 'ادوار المستخدمين',
            'icon'    => 'fas fa-fw fa-users',
            'can'     =>'edit users',
            'submenu' => [
                [
                    'text' => 'عرض الكل',
                    'url'  => 'dashboard/roles',
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'edit users'
                ],

                [
                    'text' => 'دور جديد',
                    'url'  => 'dashboard/roles/create',
                    'icon'    => 'fas fa-fw fa-plus',
                    'can' =>'edit users'
                ],


            ],
        ],
        [
            'text'    => 'المخازن',
            'icon'    => 'fas fa-fw fa-store',
            'can'     =>'is_admin',
            'submenu' => [
                [
                    'text' => 'اضافة مخزن جديد',
                    'url'  => 'dashboard/stores/create',
                    'icon'    => 'fas fa-fw fa-plus',
                    'can' =>'add stores'
                ],
                [
                    'text' => 'عرض المخازن',
                    'url'  => 'dashboard/stores',
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index stores'
                ],
                [
                    'text' => 'النقل بين المخازن أو المندوبين',
                    'can'     =>['is_admin', 'index transfer'],
                    'route'  => ['bills.index', ['type' => 'store']],
                    'icon'    => 'fas fa-fw fa-store',
                ],
                [
                    'text'    => 'التصنيفات',
//                    'icon'    => 'fas fa-fw fa-folder',
                    'can' =>'index categories',
                    'submenu' => [
                        [
                            'text' => 'عرض الكل',
                            'url'  => 'dashboard/categories',
                            'icon'    => 'fas fa-fw fa-eye',
                            'can' =>'index categories',
                        ],

                        [
                            'text' => 'تصنيف جديد',
                            'url'  => 'dashboard/categories/create',
                            'icon'    => 'fas fa-fw fa-plus',
                            'can' =>'add categories',
                        ],
                    ],
                ],
                [
                    'text'    => 'العلامات التجارية',
//                    'icon'    => 'fas fa-fw fa-folder',
                    'can' =>'index brands',
                    'submenu' => [
                        [
                            'text' => 'عرض الكل',
                            'url'  => 'dashboard/brands',
                            'icon'    => 'fas fa-fw fa-eye',
                            'can' =>'index brands',
                        ],

                        [
                            'text' => 'علامة جديدة',
                            'url'  => 'dashboard/brands/create',
                            'icon'    => 'fas fa-fw fa-plus',
                            'can' =>'add brands',
                        ],
                    ],
                ],
//                [
//                    'text'    => 'اختيارات الاصناف',
////                    'icon'    => 'fas fa-fw fa-folder',
//                    'can' =>'index options',
//                    'submenu' => [
//                        [
//                            'text' => 'عرض الكل',
//                            'url'  => 'dashboard/options',
//                            'icon'    => 'fas fa-fw fa-eye',
//                            'can' =>'index options',
//                        ],
//
//                        [
//                            'text' => 'اختيار جديد',
//                            'url'  => 'dashboard/options/create',
//                            'icon'    => 'fas fa-fw fa-plus',
//                            'can' =>'add options',
//                        ],
//                    ],
//                ],
                [
                    'text'    => ' الاصناف',
//                    'icon'    => 'fas fa-fw fa-folder',
                    'can' =>'index items',
                    'submenu' => [
                        [
                            'text' => 'عرض الكل',
                            'url'  => 'dashboard/items',
                            'icon'    => 'fas fa-fw fa-eye',
                            'can' =>'index items',
                        ],

                        [
                            'text' => 'صنف جديد',
                            'url'  => 'dashboard/items/create',
                            'icon'    => 'fas fa-fw fa-plus',
                            'can' =>'add items',
                        ],
                    ],
                ],
            ],
        ],
//        [
//            'text'    => 'العملاء',
//            'icon'    => 'fas fa-fw fa-user',
//            'submenu' => [
//                [
//                    'text' => 'عرض الكل',
//                    'url'  => 'dashboard/clients',
//                    'icon'    => 'fas fa-fw fa-eye',
//                ],
//
//                [
//                    'text' => 'عميل جديد',
//                    'url'  => 'dashboard/clients/create',
//                    'icon'    => 'fas fa-fw fa-plus',
//                ],
//            ],
//        ],

        [
            'text'    => 'التوريد',
            'icon'    => 'fas fa-fw fa-folder',
            'can'     =>['is_admin'],
            'submenu' => [
                [
                    'text' => 'عرض فواتير التوريد',
                    'route'  => ['bills.index', ['type' => 'purchase_in']],
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index purchases',

                ],

                [
                    'text' => 'عرض فواتير المرتجعات',
                    'route'  => ['bills.index', ['type' => 'purchase_out']],
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index purchases-return',
                ],
                [
                    'text'    => 'الموردون',
                    'icon'    => 'fas fa-fw fa-user',
                    'submenu' => [
                        [
                            'text' => 'عرض الكل',
                            'url'  => 'dashboard/suppliers',
                            'icon'    => 'fas fa-fw fa-eye',
                            'can' =>'index suppliers',
                        ],

                        [
                            'text' => 'مورد جديد',
                            'url'  => 'dashboard/suppliers/create',
                            'icon'    => 'fas fa-fw fa-plus',
                            'can' =>'add suppliers',
                        ],
                    ],
                ],

            ],
        ],


        [
            'text'    => 'المبيعات',
            'icon'    => 'fas fa-fw fa-folder',
            'submenu' => [
                [
                    'text' => 'عرض فواتير المبيعات',
                    'route'  => ['bills.index', ['type' => 'sale_out']],
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index sales',
                ],

                [
                    'text' => 'عرض فواتير المرتجعات',
                    'route'  => ['bills.index', ['type' => 'sale_in']],
                    'icon'    => 'fas fa-fw fa-eye',
                    'can' =>'index sales-return',
                ],
                [
                    'text'    => 'العملاء',
                    'icon'    => 'fas fa-fw fa-user',
                    'submenu' => [
                        [
                            'text' => 'عرض الكل',
                            'url'  => 'dashboard/clients',
                            'icon'    => 'fas fa-fw fa-eye',
                            'can' =>'index client',
                        ],

                        [
                            'text' => 'عميل جديد',
                            'url'  => 'dashboard/clients/create',
                            'icon'    => 'fas fa-fw fa-plus',
                            'can' =>'add client',
                        ],
                    ],
                ],

            ],
        ],
        [
            'text'       => 'عمليات السداد',
            'icon'    => 'fas fa-fw fa-money-bill',
            'url'        => 'dashboard/payments',
            'can' =>'index payments',
        ],
        [
            'text'       => 'الاعدادات',
            'icon'    => 'fas fa-fw fa-cogs',
            'url'        => 'dashboard/system-options',
            'can' =>'delete settings',
        ],
//        [
//            'text'    => 'تقارير المندوب',
//            'icon'    => 'fas fa-fw fa-file',
//            'can'     =>'is_sales',
//            'submenu' => [
//                [
//                    'text' => 'تقرير الجرد',
//                    'route'  => ['sales-men.show', \Illuminate\Support\Facades\Auth::id()],
//                    'icon'    => 'fas fa-fw fa-eye',
//                ],
//
//                [
//                    'text' => 'تفرير العهدة المالية',
//                    'route'  => ['sales-men.report', \Illuminate\Support\Facades\Auth::id()],
//                    'icon'    => 'fas fa-fw fa-money',
//                ],
//            ],
//        ],
//        ['header' => 'الاكثر استخداما'],
//        [
//            'text'       => 'رابط تجريبى',
//            'icon_color' => 'red',
//            'url'        => '#',
//        ],
//        [
//            'text'       => 'رابط تجريبى',
//            'icon_color' => 'yellow',
//            'url'        => '#',
//        ],
//        [
//            'text'       => 'رابط تجريبى',
//            'icon_color' => 'cyan',
//            'url'        => '#',
//        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
//                [
//                    'type' => 'js',
//                    'asset' => true,
//                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
//                ],
//                [
//                    'type' => 'js',
//                    'asset' => true,
//                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
//                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,

    /*
    |--------------------------------------------------------------------------
    | DateRangePicker
    |--------------------------------------------------------------------------
    |
    | Here we can enable the dateRangePicker support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'DateRangePicker' => [
        'active' => true,
        'files' => [
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/moment/moment.min.js',
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => 'vendor/daterangepicker/daterangepicker.js',
            ],
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'vendor/daterangepicker/daterangepicker.css',
            ],
        ],
    ],
];
