import { ref } from 'vue';

import type {
    ProductsSliderTypes,
    UserReviewTypes,
    ListFeatureTypes,
    DemosMegaMenuTypes,
    AppsMegaMenuTypes
} from '@/types/landingpage/LandingpageTypes';

import img1 from '@/assets/images/landingpage/demos/demo-main.jpg';
import img2 from '@/assets/images/landingpage/demos/demo-dark.jpg';
import img3 from '@/assets/images/landingpage/demos/demo-horizontal.jpg';
import img4 from '@/assets/images/landingpage/demos/demo-mini.jpg';
import img5 from '@/assets/images/landingpage/demos/demo-rtl.jpg';
import img6 from '@/assets/images/landingpage/apps/app-calendar.jpg';
import img7 from '@/assets/images/landingpage/apps/app-chat.jpg';
import img8 from '@/assets/images/landingpage/apps/app-contact.jpg';
import img9 from '@/assets/images/landingpage/apps/app-user-profile.jpg';
import img10 from '@/assets/images/landingpage/apps/app-note.jpg';
import img11 from '@/assets/images/landingpage/apps/app-blog.jpg';
import img12 from '@/assets/images/landingpage/apps/app-shop.jpg';
import img13 from '@/assets/images/landingpage/apps/app-productlist.jpg';
import img14 from '@/assets/images/landingpage/apps/app-checkout.jpg';
import img15 from '@/assets/images/landingpage/apps/app-blog-detail.jpg';
import img16 from '@/assets/images/landingpage/apps/app-product-detail.jpg';
import img17 from '@/assets/images/landingpage/apps/app-kanban.jpg';
import img18 from '@/assets/images/landingpage/demos/demo-default.jpg';

const productsSlider: ProductsSliderTypes[] = [
     {
        type:true,
        img: img1,
        name: 'Main',
        link: 'https://matdash-vuetify-main.netlify.app/dashboards/dashboard1'
    },
    {
        type:true,
        img: img2,
        name: 'Dark',
        link: 'https://matdash-vuetify-dark.netlify.app/dashboards/dashboard2'
    },
    {
        type:true,
        img: img3,
        name: 'Horizontal',
        link: 'https://matdash-vuetify-horizontal.netlify.app/dashboards/dashboard1'
    },
    {
        type:true,
        img: img4,
        name: 'Minisidebar',
        link: 'https://matdash-vuetify-minisidebar.netlify.app/dashboards/dashboard1'
    },
    {
        type:true,
        img: img5,
        name: 'RTL',
        link: 'https://matdash-vuetify-rtl.netlify.app/dashboards/dashboard2'
    },
    {
        type:true,
        img: img18,
        name: 'Default Sidebar',
        link: 'https://matdash-vuetify-default.netlify.app/dashboards/dashboard1'
    },
    {
        type:false,
        img: img6,
        name: 'Calandar ',
        link: '/apps/calendar'
    },
    {
        type:false,
        img: img7,
        name: 'Chat ',
        link: '/apps/chats'
    },
    {
        type:false,
        img: img8,
        name: 'Contact ',
        link: '/apps/contacts'
    },
    {
        type:false,
        img: img9,
        name: 'User Profile ',
        link: '/apps/user/profile'
    },
    {
        type:false,
        img: img10,
        name: 'Notes ',
        link: '/apps/notes'
    },
    {
        type:false,
        img: img11,
        name: 'Blog ',
        link: '/apps/blog/posts'
    },
    {
        type:false,
        img: img15,
        name: 'Blog Detail ',
        link: '/apps/blog/early-black-friday-amazon-deals-cheap-tvs-headphones'
    },
    {
        type:false,
        img: img12,
        name: 'eCommerce Shop ',
        link: '/ecommerce/products'
    },
    {
        type:false,
        img: img16,
        name: 'eCommerce Product Detail ',
        link: '/ecommerce/product/detail/1'
    },
    {
        type:false,
        img: img13,
        name: 'eCommerce Product List ',
        link: '/ecommerce/productlist'
    },
    {
        type:false,
        img: img14,
        name: 'eCommerce Checkout ',
        link: '/ecommerce/checkout'
    },
    {
        type:false,
        img: img17,
        name: 'Kanban ',
        link: '/apps/kanban'
    },

];

/*User Review Section*/
import review1 from '@/assets/images/profile/user-1.jpg';
import review2 from '@/assets/images/profile/user-2.jpg';
import review3 from '@/assets/images/profile/user-3.jpg';

const userReview: UserReviewTypes[] = [
    {
        img: review3,
        title: 'Eminson Mendoza',
        subtitle: 'Features avaibility',
        review: 'This template is great, UI-rich and up-to-date. Although it is pretty much complete, I suggest to improve a bit of documentation. Thanks & Highly recomended!'
    },
    {
        img: review1,
        title: 'Jenny Wilson',
        subtitle: 'Features avaibility',
        review: 'The dashboard template from adminmart has helped me provide a clean and sleek look to my dashboard and made it look exactly the way I wanted it to, mainly without having.'
    },
    {
        img: review2,
        title: 'Minshan Cui',
        subtitle: 'Features avaibility',
        review: 'The quality of design is excellent, customizability and flexibility much better than the other products available in the market.I strongly recommend the AdminMart to other.'
    },
    {
        img: review3,
        title: 'Eminson Mendoza',
        subtitle: 'Features avaibility',
        review: 'This template is great, UI-rich and up-to-date. Although it is pretty much complete, I suggest to improve a bit of documentation. Thanks & Highly recomended!'
    },
    {
        img: review1,
        title: 'Jenny Wilson',
        subtitle: 'Features avaibility',
        review: 'The dashboard template from adminmart has helped me provide a clean and sleek look to my dashboard and made it look exactly the way I wanted it to, mainly without having.'
    },
    {
        img: review2,
        title: 'Minshan Cui',
        subtitle: 'Features avaibility',
        review: 'The quality of design is excellent, customizability and flexibility much better than the other products available in the market.I strongly recommend the AdminMart to other.'
    },
    {
        img: review3,
        title: 'Eminson Mendoza',
        subtitle: 'Features avaibility',
        review: 'This template is great, UI-rich and up-to-date. Although it is pretty much complete, I suggest to improve a bit of documentation. Thanks & Highly recomended!'
    },
    {
        img: review1,
        title: 'Jenny Wilson',
        subtitle: 'Features avaibility',
        review: 'The dashboard template from adminmart has helped me provide a clean and sleek look to my dashboard and made it look exactly the way I wanted it to, mainly without having.'
    }
];


const listFeature: ListFeatureTypes[] = [
    {
        icon:'filters-bold-duotone' ,
        title: '6 Skin Colors',
        subtitle: 'We have included 6 pre-defined Skin Colors with MatDash Admin..'
    },
    {
        icon: 'lock-keyhole-bold',
        title: 'Authguard',
        subtitle: 'We have AUTH guard functionality which is based on JWT.'
    },
    {
        icon: 'widget-4-bold-duotone',
        title: '65+ Page Templates',
        subtitle: 'Yes, we have 5 demos & 65+ Pages per demo to make it easier.'
    },
    {
        icon: 'widget-6-bold-duotone',
        title: '45+ UI Components',
        subtitle: 'Almost 45+ UI Components being given with Matdash Admin Pack.'
    },
    {
        icon: 'tag-bold-duotone',
        title: 'Vuetify',
        subtitle: 'It is made with Vuetify which is a powerful UI Component Framework.'
    },
    {
        icon: 'text-field-bold-duotone',
        title: '3400+ Font Icons',
        subtitle: 'Lots of Icon Fonts are included here in the package of Matdash Admin.'
    },
    {
        icon: 'database-bold',
        title: 'Axios',
        subtitle: 'Axios is a promise-based HTTP Client for node.js and the browser.'
    },
    {
        icon: 'home-smile-angle-bold-duotone',
        title: 'i18n Vue',
        subtitle: 'Vue i18n is a powerful internationalization framework for Vue.'
    },
    {
        icon: 'slider-horizontal-bold',
        title: 'Vue3 Carousel',
        subtitle: 'Flexible, responsive, and highly customizable Vue carousel component'
    },
    {
        icon: 'shuffle-bold-duotone',
        title: 'Easy to Customize',
        subtitle: 'Customization will be easy as we understand your pain.'
    },
    {
        icon: 'pie-chart-3-bold-duotone',
        title: 'Lots of Chart Options',
        subtitle: 'You name it and we have it, Yes lots of variations for Charts.'
    },
    {
        icon: 'bedside-table-bold-duotone',
        title: 'Lots of Table Examples',
        subtitle: 'Data Tables are initial requirement and we added them.'
    },
    {
        icon: 'refresh-square-bold-duotone',
        title: 'Regular Updates',
        subtitle: 'We are constantly updating our pack with new features.'
    },
    {
        icon: 'document-add-bold-duotone',
        title: 'Detailed Documentation',
        subtitle: 'We have made detailed documentation, so it will easy to use.'
    },
    {
        icon: 'calendar-mark-bold-duotone',
        title: 'Calendar Design',
        subtitle: 'Calendar is available with our package & in nice design.'
    },
    {
        icon: 'chat-round-bold-duotone',
        title: 'Dedicated Support',
        subtitle: 'We believe in supreme support is key and we offer that.'
    }
];

/*Demos Megamenu*/
const demosMegamenu: DemosMegaMenuTypes[] = [
    {
        img: img1,
        name: 'Main',
        link: 'https://matdash-vuetify-main.netlify.app/dashboards/dashboard1'
    },
    {
        img: img2,
        name: 'Dark',
        link: 'https://matdash-vuetify-dark.netlify.app/dashboards/dashboard2'
    },
    {
        img: img3,
        name: 'Horizontal',
        link: 'https://matdash-vuetify-horizontal.netlify.app/dashboards/dashboard1'
    },
    {
        img: img4,
        name: 'Minisidebar',
        link: 'https://matdash-vuetify-minisidebar.netlify.app/dashboards/dashboard1'
    },
    {
        img: img5,
        name: 'RTL',
        link: 'https://matdash-vuetify-rtl.netlify.app/dashboards/dashboard2'
    }
];
const appsMegamenu: AppsMegaMenuTypes[] = [
    {
        img: img6,
        name: 'Calandar App',
        link: '/apps/calendar'
    },
    {
        img: img7,
        name: 'Chat App',
        link: '/apps/chats'
    },
    {
        img: img8,
        name: 'Contact App',
        link: '/apps/contacts'
    },
    {
        img: img9,
        name: 'User Profile App',
        link: '/apps/user/profile'
    },
    {
        img: img10,
        name: 'Notes App',
        link: '/apps/notes'
    }
];

export { productsSlider, userReview, listFeature, demosMegamenu, appsMegamenu };
