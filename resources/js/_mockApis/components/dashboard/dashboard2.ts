import type { RevenueForecast, AnnualProfit, SalesFromLocation,DailyActivities,userCard } from '@/types/components/dashboard/dashboard2';

import user1 from "@/assets/images/profile/user-2.jpg";
import user2 from "@/assets/images/profile/user-3.jpg";
import user3 from "@/assets/images/profile/user-4.jpg";
import user4 from "@/assets/images/profile/user-6.jpg";

const RevenueForecastData: RevenueForecast[] = [
    {
        icon: 'pie-chart-2-linear',
        subtext: 'Total',
        profit: '$96,640',
        bgcolor:'bg-grey100',
        color:'text-textPrimary',
    },
    {
        icon: 'dollar-minimalistic-linear',
        subtext: 'Profit',
        profit: '$48,820',
        bgcolor:'bg-lightprimary',
        color:'text-primary',
    },
    {
        icon: 'database-linear',
        subtext: 'Earnings',
        profit: '$58,820',
        bgcolor:'bg-lighterror',
        color:'text-error',
    }
];

const AnnualProfitData: AnnualProfit[] = [
    {
        title: 'Added to Cart',
        subtitle: '5 clicks',
        price: '$21,120.70',
        percent:'+13.2%',
        color:'success',
    },
    {
        title: 'Reached to Checkout',
        subtitle: '12 clicks',
        price: '$16,100.00',
        percent:'-7.4%',
        color:'error',
    },
    {
        title: 'Added to Cart',
        subtitle: '24 views',
        price: '$6,400.50',
        percent:'+9.3%',
        color:'success',
    }

];

const SalesFromLocationData: SalesFromLocation[] = [
    {
        name: 'LA',
        percentage:'28%',
        color:'primary',
    },
    {
        name: 'NY',
        percentage:'21%',
        color:'secondary',
    },
    {
        name: 'KA',
        percentage:'18%',
        color:'warning',
    },
    {
        name: 'AZ',
        percentage:'12%',
        color:'error',
    },

];

/*--Recent Transaction--*/
const DailyActivitiesData  : DailyActivities[] = [
    {
        title:'09:30 am',
        subtitle:'Payment received from John Doe of $385.90',
        textcolor:'primary',
        boldtext:false,
        line:true,
        link:'',
        url:''
      },
      {
        title:'10:00 am',
        subtitle:'New sale recorded',
        textcolor:'warning',
        boldtext:true,
        line:true,
        link:'#ML-3467',
        url:''
      },
      {
        title:'12:00 am',
        subtitle:'Payment was made of $64.95 to Michael',
        textcolor:'warning',
        boldtext:false,
        line:true,
        link:'',
        url:''
      },
      {
        title:'09:30 am',
        subtitle:'New sale recorded',
        textcolor:'secondary',
        boldtext:true,
        line:true,
        link:'#ML-3467',
        url:''
      },
      {
        title:'09:30 am',
        subtitle:'New arrival recorded',
        textcolor:'error',
        boldtext:true,
        line:true,
        link:'#ML-3467',
        url:''
      },
      {
        title:'12:00 am',
        subtitle:'Payment Done',
        textcolor:'primary',
        boldtext:false,
        line:false,
        link:'',
        url:''
      },
]

/*--Blog Cards--*/
const userCardData: userCard[] = [
    { img: user4 },
    { img: user3 },
    { img: user2 },
    { img: user1 },
];

export { RevenueForecastData,AnnualProfitData,SalesFromLocationData ,DailyActivitiesData,userCardData};
