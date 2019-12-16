<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section
    | like so: @section('title', 'Dashboard | My Great Admin Panel')
    |
    */

    'title' => 'Ｄemo Admin',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Demo</b>SHOP',

    'logo_mini' => '<b>Q</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | The dashboard_url is used for the link behind the logo in the upper
    | left corner. The logout_url is used for the logout button in the
    | upper right corner. They are passed through the url() helper.
    |
    */

    'dashboard_url' => 'admin',

    'logout_url' => 'admin/logout',

    'logout_method' => 'post',

    'login_url' => 'admin/login',

    'register_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we have the option to enable a right sidebar.
    | When active, you can use @section('right-sidebar')
    | The icon you configured will be displayed at the end of the top menu,
    | and will show/hide de sidebar.
    | The slide option will slide the sidebar over the content, while false
    | will push the content, and have no animation.
    | You can also choose the sidebar theme (dark or light).
    | The right Sidebar can only be used if layout is not top-nav.
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,


    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header.
    |
    */

    'menu' => [
        // [
        //     'text' => 'search',
        //     'search' => true,
        // ],
        ['header' => 'main_navigation'],
        [
            'text'        => 'news',
            'url'         => 'admin/news',
            'icon'        => 'fas fa-newspaper',
            'can'         => 'news-access',
        ],
        [
            'text'        => 'users',
            'url'         => 'admin/users',
            'icon'        => 'fas fa-users',
            'can'         => 'member-access',
        ],
        [
            'text'        => 'orders',
            'url'         => 'admin/orders',
            'icon'        => 'fab fa-cc-amazon-pay',
            'can'         => 'order-access',
        ],
        [
            'text'        => 'events',
            'url'         => 'admin/events',
            'icon'        => 'fas fa-exclamation-circle',
            'can'         => 'event-access'
        ],
        // [
        //     'text'        => 'service',
        //     'url'         => 'admin/service',
        //     'icon'        => 'fas fa-comment',
        //     'can'         => 'service-access',
        // ],


        ['header' => 'asset_management'],
        [
            'text'        => 'products',
            'url'         => 'admin/products',
            'icon'        => 'fas fa-dumbbell',
            'can'         => 'product-access',
        ],
        // [
        //     'text'        => 'articles',
        //     'url'         => 'admin/articles',
        //     'icon'        => 'fas fa-book-open',
        //     'can'         => 'article-access',
        // ],
        [
            'text'        => 'attachs',
            'url'         => 'admin/attachs/images',
            'icon'        => 'fas fa-paperclip',
            'can'         => 'attach-access',
        ],
        // [
        //     'text'        => 'stores',
        //     'url'         => 'admin/stores',
        //     'icon'        => 'fas fa-store',
        //     'can'         => 'store-access',
        // ],

        
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/account_setting/profile',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/account_setting/password',
            'icon' => 'fas fa-fw fa-lock',
        ],


        [
            'header' => 'admin_settings',
            'can' => 'admin-access',
        ],
        [
            'text' => 'admin_list',
            'url'  => 'admin/account_setting/accounts',
            'icon' => 'fas fa-user-tie',
            'can' => 'admin-access',
        ],
        [
            'text' => 'role_list',
            'url'  => 'admin/account_setting/roles',
            'icon' => 'fas fa-user-tie',
            'can' => 'admin-access',
        ],
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        // JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        App\Filters\AdminMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => true,
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

];