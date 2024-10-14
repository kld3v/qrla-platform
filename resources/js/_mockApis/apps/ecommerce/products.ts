import mock from '../../mockAdapter';

// third-party
import { add, sub } from 'date-fns';
import { Chance } from 'chance';
import product1 from '@/assets/images/products/s11.jpg';
import product2 from '@/assets/images/products/s5.jpg';
import product3 from '@/assets/images/products/s6.jpg';
import product4 from '@/assets/images/products/s4.jpg';
import product5 from '@/assets/images/products/s10.jpg';
import product6 from '@/assets/images/products/s9.jpg';
import product7 from '@/assets/images/products/s7.jpg';
import product8 from '@/assets/images/products/s8.jpg';
import product9 from '@/assets/images/products/s3.jpg';
import product10 from '@/assets/images/products/s1.jpg';
import product11 from '@/assets/images/products/s12.jpg';
import product12 from '@/assets/images/products/s2.jpg';
//Types
import type { Products } from '@/types/apps/EcommerceType';

const chance = new Chance();
// products list
const products: Products[] = [
    {
        id: 1,
        image: product1,
        name: 'Super Games',
        description: chance.paragraph({ sentences: 1 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 25,
        salePrice: 180,
        offerPrice: 200,
        gender: 'kids',
        categories: ['fashion', 'toys','electronics'],
        colors: ['error', 'warning', 'primary', 'secondary'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 8, hours: 6, minutes: 20 }),
        isStock: true,
        qty: 1,
        rank:87,
        price:'200'
    },
    {
        id: 2,
        image: product2,
        name: 'Derma-E',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 10,
        salePrice: 81,
        offerPrice: 89,
        gender: 'kids',
        categories: ['fashion', 'female'],
        colors: ['lightprimary', 'success', 'lighterror', 'warning'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 10, hours: 8, minutes: 69 }),
        isStock: false,
        qty: 1,
        rank:87,
        price:'100'
    },
    {
        id: 3,
        image: product3,
        name: 'SockSoho',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 40,
        salePrice: 49,
        offerPrice: 59,
        gender: 'male',
        categories: ['fashion','kids'],
        colors: ['lightprimary', 'primary'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 4, hours: 9, minutes: 50 }),
        isStock: true,
        qty: 1,
        rank:50,
        price:'100'
    },
    {
        id: 4,
        image: product4,
        name: 'Glossy Solution',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 17,
        salePrice: 29,
        offerPrice: 36,
        gender: 'kids',
        categories: ['fashion','female'],
        colors: ['error', 'warning', 'warning'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 7, hours: 6, minutes: 45 }),
        isStock: false,
        qty: 1,
        rank:90,
        price:'50'
    },
    {
        id: 5,
        image: product5,
        name: 'Supercolor 645CL',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 12,
        offerPrice: 15,
        gender: 'male',
        categories: ['toys'],
        colors: ['warning', 'lightprimary'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 2, hours: 9, minutes: 45 }),
        isStock: true,
        qty: 1,
        rank:88,
        price:'50'
    },
    {
        id: 6,
        image: product6,
        name: 'Orange Glass',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 13,
        salePrice: 86,
        offerPrice: 99,
        gender: 'female',
        categories: ['fashion', 'kitchen'],
        colors: ['primary', 'warning'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: add(new Date(), { days: 6, hours: 10, minutes: 0 }),
        isStock: true,
        qty: 1,
        rank:95,
        price:'100'
    },
    {
        id: 7,
        image: product7,
        name: 'Polraid One Step',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 15,
        salePrice: 16,
        offerPrice: 14.59,
        gender: 'female',
        categories: ['fashion'],
        colors: ['error', 'secondary', 'primary', 'warning'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: add(new Date(), { days: 14, hours: 1, minutes: 55 }),
        isStock: false,
        qty: 1,
        rank:60,
        price:'50'
    },
    {
        id: 8,
        image: product8,
        name: 'Colorful Camera',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 130,
        offerPrice: 105,
        gender: 'female',
        categories: ['toys'],
        colors: ['lightsuccess', 'primary', 'success'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 0, hours: 11, minutes: 10 }),
        isStock: true,
        qty: 1,
        rank:80,
        price:'151'
    },
    {
        id: 9,
        image: product9,
        name: 'Smart Watch',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 130,
        offerPrice: 160,
        gender: 'female',
        categories: ['toys','electronics'],
        colors: ['lightsuccess', 'primary', 'success'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 0, hours: 11, minutes: 10 }),
        isStock: true,
        qty: 1,
        rank:80,
        price:'252'
    },
    {
        id: 10,
        image: product10,
        name: 'Curology Face wash',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 275,
        offerPrice: 350,
        gender: 'female',
        categories: ['toys'],
        colors: ['lightsuccess', 'primary', 'success'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 0, hours: 11, minutes: 10 }),
        isStock: true,
        qty: 1,
        rank:80,
        price:'275'
    },
    {
        id: 11,
        image: product11,
        name: 'Smart Game',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 10,
        offerPrice: 15,
        gender: 'female',
        categories: ['toys','electronics'],
        colors: ['lightsuccess', 'primary', 'success'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 0, hours: 11, minutes: 10 }),
        isStock: true,
        qty: 1,
        rank:80,
        price:'275'
    },
    {
        id: 12,
        image: product12,
        name: 'Body Lotion',
        description: chance.paragraph({ sentences: 2 }),
        rating: chance.floating({ min: 0.1, max: 5.0 }),
        discount: 20,
        salePrice: 89,
        offerPrice: 99,
        gender: 'female',
        categories: ['toys'],
        colors: ['lightsuccess', 'primary', 'success'],
        popularity: chance.natural(),
        date: chance.natural(),
        created: sub(new Date(), { days: 0, hours: 11, minutes: 10 }),
        isStock: true,
        qty: 1,
        rank:80,
        price:'275'
    }
];

// ==============================|| MOCK SERVICES ||============================== //

// mock.onGet('/api/products/list').reply(200, { products });
mock.onGet('/api/products/list').reply(() => {
    return [200, products];
});

export default products;