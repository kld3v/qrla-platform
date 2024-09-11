import type { RevenueProjects,Performance } from '@/types/components/dashboard/dashboard1';

import product1 from "@/assets/images/products/dash-prd-1.jpg";
import product2 from "@/assets/images/products/dash-prd-2.jpg";
import product3 from "@/assets/images/products/dash-prd-3.jpg";
import product4 from "@/assets/images/products/dash-prd-4.jpg";


/*--Revenue Projects --*/
const RevenueProjectsData: RevenueProjects[] = [
    {
        img: product1,
        leadname: "Minecraf App",
        designation: "Jason Roy",
        projectname: "73.2%",
        statuscolor: "warning",
        statustext: "Medium",
        money: "$3.5K",
    },
    {
        img: product2,
        leadname: "Web App Project",
        designation: "Mathew Flintoff",
        projectname: "73.2%",
        statuscolor: "secondary",
        statustext: "Very High",
        money: "$24.5K",
    },
    {
        img: product3,
        leadname: "Modernize Dashboard",
        designation: "Anil Kumar",
        projectname: "73.2%",
        statuscolor: "success",
        statustext: "Low",
        money: "$12.8K",
    },
    {
        img: product4,
        leadname: "Dashboard Co",
        designation: "George Cruize",
        projectname: "73.2%",
        statuscolor: "error",
        statustext: "High",
        money: "$2.4K",
    },
];

/*--Performance--*/
const PerformanceData: Performance[] = [
    {
        icon: 'shop-2-linear',
        title: '64 new orders',
        subtitle: 'Processing',
        color:'primary',
    },
    {
        icon: 'filters-outline',
        title: '4 orders',
        subtitle: 'On hold',
        color:'error',
    },
    {
        icon: 'pills-3-linear',
        title: '6 orders',
        subtitle: 'Delivered',
        color:'secondary',
    },
    
];


export {RevenueProjectsData,PerformanceData}