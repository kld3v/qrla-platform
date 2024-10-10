import type { Iconcard } from '@/types/components/dashboard/dashboard3';

/*--Revenue Projects --*/
const IconcardData: Iconcard[] = [
    {
        bg: 'primary-gradient',
        icon: 'solar:dollar-minimalistic-linear',
        color:'primary',
        title:'Total Orders',
        price:'16,689',
        link:'#',
    },
    {
        bg: 'warning-gradient',
        icon: 'solar:recive-twice-square-linear',
        color:'warning',
        title:'Return Item',
        price:'148',
        link:'#',

    },
    {
        bg: 'secondary-gradient',
        icon: 'ic:outline-backpack',
        color:'secondary',
        title:'Annual Budget',
        price:'$156K',
        link:'#',

    },
    {
        bg: 'error-gradient',
        icon: 'ic:baseline-sync-problem',
        color:'error',
        title:'Cancel Orders',
        price:'64',
        link:'#',

    },
    {
        bg: 'success-gradient',
        icon: 'ic:outline-forest',
        color:'success',
        title:'Total Income ',
        price:'$36,715',
        link:'#',

    },
   
];

export {IconcardData}