// project imports
import mock from './mockAdapter';

import type { notificationType, profileType, languageType, appsLinkType,searchType } from '@/types/HeaderTypes'
// 
// Notification
// 
const notifications:notificationType[] = [
    {
        avatar: 'widget-3-line-duotone',
        color:'error',
        title: 'Launch Admin',
        subtitle: 'Just see the my new admin!',
        time:'9:30 AM'
    },
    {
        avatar: 'calendar-line-duotone',
        color:'primary',
        title: 'Event Today',
        subtitle: 'Just a reminder that you have event',
        time:'9:15 AM'
    },
    {
        avatar: 'settings-line-duotone',
        color:'secondary',
        title: 'Settings',
        subtitle: 'You can customize this template as you want',
        time:'4:36 PM'
    },
    {
        avatar: 'widget-4-line-duotone',
        color:'warning',
        title: 'Launch Admin',
        subtitle: 'Just see the my new admin!',
        time:'9:30 AM'
    },
    {
        avatar: 'calendar-line-duotone',
        color:'primary',
        title: 'Event Today',
        subtitle: 'Just a reminder that you have event',
        time:'9:15 AM'
    },
    {
        avatar: 'settings-line-duotone',
        color:'secondary',
        title: 'Settings',
        subtitle: 'You can customize this template as you want',
        time:'4:36 PM'
    },
];

// 
// Profile 
// 
const profileDD: profileType[] = [
    {
        title: 'My Profile',
        href: '/apps/user/profile',
        badge:false
    },
    {
        title: 'My Subscription',
        href: '/pages/pricing',
        badge:false
    },
    {
        title: 'My Notes',
        href: '/apps/notes',
        badge:true
    },
    {
        title: 'Account Settings',
        href: '/pages/account-settings',
        badge:false
    },
    {
        title: 'Sign Out',
        href: '/auth/login2',
        badge:false
    },
   
];

// 
// Language
// 
import flag1 from '@/assets/images/flag/icon-flag-en.svg';
import flag2 from '@/assets/images/flag/icon-flag-fr.svg';
import flag3 from '@/assets/images/flag/icon-flag-ro.svg';
import flag4 from '@/assets/images/flag/icon-flag-zh.svg';
const languageDD: languageType[] = [
    { title: 'English', subtext: 'UK', value: 'en', avatar: flag1 },
    { title: 'français', subtext: 'French', value: 'fr', avatar: flag2 },
    { title: 'عربي', subtext: 'Arbic', value: 'ro', avatar: flag3 },
    { title: '中国人', subtext: 'Chinese', value: 'zh', avatar: flag4 }
];

// 
// AppsLink
// 
const appsLink: appsLinkType[] = [
    {
        avatar: 'chat-line-bold-duotone',
        color:'primary',
        title: 'Chat Application',
        subtext: 'New messages arrived',
        href: '/apps/chats'
    },
    {
        avatar: 'user-bold-duotone',
        color:'success',
        title: 'User Profile App',
        subtext: 'Get profile details',
        href: '/apps/user/profile'
    },
    {
        avatar: 'bill-list-bold-duotone',
        color:'secondary',
        title: 'eCommerce App',
        subtext: 'learn more information',
        href: '/ecommerce/products'
    },
   
    {
        avatar: 'calendar-minimalistic-bold-duotone',
        color:'primary',
        title: 'Calendar App',
        subtext: 'Get dates',
        href: '/apps/calendar'
    },
    {
        avatar: 'phone-calling-rounded-bold-duotone',
        color:'warning',
        title: 'Contact Application',
        subtext: '2 Unsaved Contacts',
        href: '/apps/contacts'
    },
    {
        avatar: 'settings-bold-duotone',
        color:'info',
        title: 'Account Setting App',
        subtext: 'Account settings',
        href: '/pages/account-settings'
    },
    {
        avatar: 'checklist-minimalistic-bold',
        color:'error',
        title: 'Kanban App',
        subtext: 'Get new Task',
        href: '/apps/kanban'
    },
    {
        avatar: 'notes-bold-duotone',
        color:'warning',
        title: 'Notes Application',
        subtext: 'To-do and Daily tasks',
        href: '/apps/notes'
    }
];


// 
// Search Data
// 
const searchSugg: searchType[] = [
    {
        title: 'Modern',
        href: '/dashboards/modern'
    },
    {
        title: 'eCommerce',
        href: '/dashboards/ecommerce'
    },
    {
        title: 'Contacts',
        href: '/apps/contacts'
    },
    {
        title: 'Shop',
        href: '/ecommerce/shop'
    },
    {
        title: 'Checkout',
        href: '/ecommerce/checkout'
    },
    {
        title: 'Chats',
        href: '/apps/chats'
    },
    {
        title: 'Notes',
        href: '/apps/notes'
    },
    {
        title: 'Pricing',
        href: '/pages/pricing'
    },
    {
        title: 'Account Setting',
        href: '/pages/account-settings'
    },
];

export { notifications, profileDD, languageDD, appsLink, searchSugg };

