export interface menu {
    header?: string;
    title?: string;
    icon?: any;
    id?: number;
    to?: string;
    chip?: string;
    BgColor?: string;
    chipBgColor?: string;
    chipColor?: string;
    chipVariant?: string;
    chipIcon?: string;
    children?: menu[];
    disabled?: boolean;
    type?: string;
    subCaption?: string;
}
const sidebarItem: menu[] = [
    {
        header: 'dashboards',
        id: 1,
        children: [
            {
                title: 'Dashboard1',
                icon: 'widget-add-line-duotone',
                to: '/dashboards/dashboard1'
            },
            {
                title: 'Dashboard2',
                icon: 'chart-line-duotone',
                to: '/dashboards/dashboard2'
            },
            {
                title: 'Dashboard3',
                icon: 'screencast-2-line-duotone',
                to: '/dashboards/dashboard3'
            }
        ]
    },

    {
        header: 'apps',
        id: 1,
        children: [
            {
                title: 'ECommerce',
                icon: 'cart-3-line-duotone',
                to: '/ecommerce/',
                children: [
                    {
                        title: 'Shop',
                        to: '/ecommerce/products'
                    },
                    {
                        title: 'Detail',
                        to: '/ecommerce/product/detail/1'
                    },
                    {
                        title: 'List',
                        to: '/ecommerce/productlist'
                    },
                    {
                        title: 'Checkout',
                        to: '/ecommerce/checkout'
                    },
                    {
                        title: 'Add Product',
                        to: '/ecommerce/add-product'
                    },
                    {
                        title: 'Edit Product',
                        to: '/ecommerce/edit-product'
                    }
                ]
            },
            {
                title: 'Blog',
                icon: 'widget-4-line-duotone',
                to: '/',
                children: [
                    {
                        title: 'Blog Posts',
                        to: '/apps/blog/posts'
                    },
                    {
                        title: 'Blog Details',
                        to: '/apps/blog/early-black-friday-amazon-deals-cheap-tvs-headphones'
                    }
                ]
            },
            {
                title: 'User Profile',
                icon: 'shield-user-line-duotone',
                to: '/',
                children: [
                    {
                        title: 'Profile',
                        to: '/apps/user/profile'
                    },
                    {
                        title: 'Followers',
                        to: '/apps/user/profile/followers'
                    },
                    {
                        title: 'Friends',
                        to: '/apps/user/profile/friends'
                    },
                    {
                        title: 'Gallery',
                        to: '/apps/user/profile/gallery'
                    }
                ]
            },
            {
                title: 'Calendar',
                icon: 'calendar-mark-line-duotone',
                to: '/apps/calendar'
            },
            {
                title: 'Kanban',
                icon: 'airbuds-case-minimalistic-line-duotone',
                to: '/apps/kanban'
            },
            {
                title: 'Chats',
                icon: 'chat-round-line-line-duotone',
                to: '/apps/chats'
            },
            {
                title: 'Notes',
                icon: 'document-text-line-duotone',
                to: '/apps/notes'
            },
            {
                title: 'Contact',
                icon: 'iphone-line-duotone',
                to: '/apps/contacts'
            }
        ]
    },

    {
        header: 'pages',
        id: 2,
        children: [

            {
                title: 'Account Setting',
                icon: 'settings-minimalistic-line-duotone',
                to: '/pages/account-settings'
            },
            {
                title: 'Banners Widgets',
                icon: 'align-vertical-spacing-line-duotone',
                to: '/widgets/banners'
            },
            {
                title: 'Cards Widgets',
                icon: 'cardholder-line-duotone',
                to: '/widgets/cards'
            },
            {
                title: 'Charts Widgets',
                icon: 'chart-square-line-duotone',
                to: '/widgets/charts'
            },
            {
                title: 'FAQ',
                icon: 'question-circle-line-duotone',
                to: '/pages/faq'
            },
            {
                title: 'Gallery Lightbox',
                icon: 'gallery-bold-duotone',
                to: '/pages/gallery-lightbox',
            },
            {
                title: 'Landing Page',
                icon: 'passport-line-duotone',
                to: '/'
            },
            {
                title: 'Pricing',
                icon: 'dollar-line-duotone',
                to: '/pages/pricing'
            },
            {
                title: 'Search Results',
                icon: 'card-search-line-duotone',
                to: '/pages/search-results'
            },
            {
                title: 'Social Contacts',
                icon: 'chat-round-like-linear',
                to: '/pages/social-media-contacts'
            },
            {
                title: 'Treeview',
                icon: 'transmission-line-duotone',
                to: '/pages/treeview'
            },
            
            
           
        ]
    },
    {
        header: 'icons',
        id: 2,
        children: [
            {
                title: 'Tabler Icons',
                icon: 'sticker-smile-circle-2-line-duotone',
                to: '/icons/tabler'
            },
            {
                title: 'Solar Icons',
                icon: 'sticker-smile-circle-2-line-duotone',
                to: '/icons/solar'
            }
        ]
    },

    {
        header: 'Forms',
        id: 3,
        children: [
            {
                title: 'Form Elements',
                icon: 'text-selection-line-duotone',
                to: '/components/',
                children: [
                    {
                        title: 'Autocomplete',
                        to: '/forms/form-elements/autocomplete'
                    },
                    {
                        title: 'Combobox',
                        to: '/forms/form-elements/combobox'
                    },
                    {
                        title: 'Button',
                        to: '/forms/form-elements/button'
                    },
                    {
                        title: 'Checkbox',
                        to: '/forms/form-elements/checkbox'
                    },
                    {
                        title: 'Custom Inputs',
                        to: '/forms/form-elements/custominputs'
                    },
                    {
                        title: 'File Inputs',
                        to: '/forms/form-elements/fileinputs'
                    },
                    {
                        title: 'Radio',
                        to: '/forms/form-elements/radio'
                    },
                    {
                        title: 'Date Time',
                        to: '/forms/form-elements/date-time'
                    },
                    {
                        title: 'Select',
                        to: '/forms/form-elements/select'
                    },
                    {
                        title: 'Slider',
                        to: '/forms/form-elements/slider'
                    },
                    {
                        title: 'Switch',
                        to: '/forms/form-elements/switch'
                    },
                    {
                        title: 'Time Picker',
                        to: '/forms/form-elements/time-picker'
                    },
                    
                    {
                        title: 'Stepper',
                        to: '/forms/form-elements/stepper'
                    }
                ]
            },
            {
                title: 'Form Layout',
                icon: 'layers-minimalistic-outline',
                to: '/forms/form-layouts'
            },
            {
                title: 'Form Horizontal',
                icon: 'password-minimalistic-input-line-duotone',
                to: '/forms/form-horizontal'
            },
            {
                title: 'Form Vertical',
                icon: 'slider-vertical-line-duotone',
                to: '/forms/form-vertical'
            },
            {
                title: 'Form Custom',
                icon: 'clapperboard-play-outline',
                to: '/forms/form-custom'
            },
            {
                title: 'Form Validation',
                icon: 'soundwave-square-line-duotone',
                to: '/forms/form-validation'
            },
            {
                title: 'Editor',
                icon: 'clapperboard-edit-line-duotone',
                to: '/forms/editor'
            }
        ]
    },

    {
        header: 'tables',
        id: 4,
        children: [
            {
                title: 'Basic Table',
                icon: 'tablet-line-duotone',
                to: '/tables/basic'
            },
            {
                title: 'Dark Table',
                icon: 'bedside-table-4-outline',
                to: '/tables/dark'
            },
            {
                title: 'Density Table',
                icon: 'bedside-table-3-linear',
                to: '/tables/density'
            },
            {
                title: 'Fixed Header Table',
                icon: 'archive-up-minimlistic-broken',
                to: '/tables/fixed-header'
            },
            {
                title: 'Height Table',
                icon: 'archive-down-minimlistic-broken',
                to: '/tables/height'
            },
            {
                title: 'Editable Table',
                icon: 'document-add-linear',
                to: '/tables/editable'
            }
        ]
    },

    {
        header: 'datatables',
        id: 4,
        children: [
            {
                title: 'Basic Table',
                icon: 'database-outline',
                to: '/tables/datatables/basic'
            },
            {
                title: 'Header Table',
                icon: 'folder-open-broken',
                to: '/tables/datatables/header'
            },
            {
                title: 'Selection Table',
                icon: 'chart-square-broken',
                to: '/tables/datatables/selection'
            },
            {
                title: 'Sorting Table',
                icon: 'card-send-line-duotone',
                to: '/tables/datatables/sorting'
            },
            {
                title: 'Pagination Table',
                icon: 'tag-horizontal-broken',
                to: '/tables/datatables/pagination'
            },
            {
                title: 'Filtering Table',
                icon: 'tuning-square-2-line-duotone',
                to: '/tables/datatables/filtering'
            },
            {
                title: 'Grouping Table',
                icon: 'tuning-square-2-line-duotone',
                to: '/tables/datatables/grouping'
            },
            {
                title: 'Table Slots',
                icon: 'closet-line-duotone',
                to: '/tables/datatables/slots'
            },
            {
                title: 'CRUD Table',
                icon: 'text-underline-cross-broken',
                to: '/tables/datatables/crudtable'
            }
        ]
    },

    {
        header: 'Charts',
        id: 5,
        children: [
            {
                title: 'Line',
                icon: 'chat-square-2-outline',
                to: '/charts/line-chart'
            },
            {
                title: 'Gredient',
                icon: 'round-graph-linear',
                to: '/charts/gredient-chart'
            },
            {
                title: 'Area',
                icon: 'graph-up-linear',
                to: '/charts/area-chart'
            },
            {
                title: 'Candlestick',
                icon: 'chandelier-broken',
                to: '/charts/candlestick-chart'
            },
            {
                title: 'Column',
                icon: 'colour-tuneing-broken',
                to: '/charts/column-chart'
            },
            {
                title: 'Doughnut & Pie',
                icon: 'pie-chart-2-linear',
                to: '/charts/doughnut-pie-chart'
            },
            {
                title: 'Radialbar & Radar',
                icon: 'radar-2-outline',
                to: '/charts/radialbar-chart'
            }
        ]
    },

    {
        header: 'UI',
        id: 6,
        children: [
            {
                title: 'Alert',
                icon: 'info-circle-linear',
                to: '/ui-components/alert'
            },
            {
                title: 'Accordion',
                icon: 'waterdrops-line-duotone',
                to: '/ui-components/accordion'
            },
            {
                title: 'Avatar',
                icon: 'expressionless-circle-outline',
                to: '/ui-components/avatar'
            },
            {
                title: 'Chip',
                icon: 'tag-horizontal-line-duotone',
                to: '/ui-components/chip'
            },
            {
                title: 'Dialog',
                icon: 'bolt-line-duotone',
                to: '/ui-components/dialogs'
            },
            {
                title: 'List',
                icon: 'checklist-bold-duotone',
                to: '/ui-components/list'
            },
            {
                title: 'Menus',
                icon: 'menu-dots-circle-outline',
                to: '/ui-components/menus'
            },
            {
                title: 'Rating',
                icon: 'shield-star-outline',
                to: '/ui-components/rating'
            },
            {
                title: 'Tabs',
                icon: 'box-minimalistic-line-duotone',
                to: '/ui-components/tabs'
            },
            {
                title: 'Tooltip',
                icon: 'transmission-square-outline',
                to: '/ui-components/tooltip'
            },
            {
                title: 'Typography',
                icon: 'text-circle-linear',
                to: '/ui-components/typography'
            }
        ]
    },

    {
        header: 'Auth',
        id: 7,
        children: [
            {
                title: 'Error',
                icon: 'bug-minimalistic-line-duotone',
                to: '/auth/404'
            },
            {
                title: 'Side Login',
                icon: 'login-3-line-duotone',
                to: '/auth/login'
            },
            {
                title: 'Boxed Login',
                icon: 'login-3-line-duotone',
                to: '/auth/login2'
            },
            {
                title: 'Side Register',
                icon: 'user-plus-rounded-line-duotone',
                to: '/auth/register'
            },
            {
                title: 'Boxed Register',
                icon: 'user-plus-rounded-line-duotone',
                to: '/auth/register2'
            },
            {
                title: 'Side Forgot Pwd',
                icon: 'password-outline',
                to: '/auth/forgot-password'
            },
            {
                title: 'Boxed Forgot Pwd',
                icon: 'password-outline',
                to: '/auth/forgot-password2'
            },
            {
                title: 'Side Two Steps',
                icon: 'siderbar-line-duotone',
                to: '/auth/two-step'
            },
            {
                title: 'Boxed Two Steps',
                icon: 'siderbar-line-duotone',
                to: '/auth/two-step2'
            },
            {
                title: 'Maintenance',
                icon: 'settings-line-duotone',
                to: '/auth/maintenance'
            }
        ]
    },
    {
        header: 'Multi Level',
        id: 8,
        children: [
            {
                title: 'Menu Level',
                icon: 'align-left-line-duotone',
                to: '#',
                id: 8,
                children: [
                    {
                        title: 'Level 1',
                        to: '/level1'
                    },
                    {
                        title: 'Level 1 ',
                        to: '/2level',
                        children: [
                            {
                                title: 'Level 2',
                                to: '/barry'
                            },
                            {
                                title: 'Level 2',
                                to: '/2.2level',
                                children: [
                                    {
                                        title: 'Level 3',
                                        to: '/barry'
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    },
    {
        header: 'More Options',
        id: 8,
        children: [
            {
                title: 'Applications',
                icon: 'check-circle-bold',
                BgColor: 'primary'
            },
            {
                title: 'Form Options',
                icon: 'check-circle-bold',
                BgColor: 'secondary'
            },
            {
                title: 'Table Variations',
                icon: 'check-circle-bold',
                BgColor: 'error'
            },
            {
                title: 'Charts Selection',
                icon: 'check-circle-bold',
                BgColor: 'warning'
            },
            {
                title: 'Widgets',
                icon: 'check-circle-bold',
                BgColor: 'success'
            }
        ]
    }
];

export default sidebarItem;
