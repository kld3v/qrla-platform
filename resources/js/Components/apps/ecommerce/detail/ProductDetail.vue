<script setup>
import { ref, onMounted, computed } from 'vue';
import { useEcomStore } from '@/stores/apps/eCommerce';
import { useRoute } from 'vue-router';
import ProductCarousel from './ProductCarousel.vue';
import ProductTab from './ProductTab.vue';
import RelatedProducts from './RelatedProducts.vue';

const store = useEcomStore();
const route = useRoute();
const size = ref(['10', '09', '08', '07']);
const selectedSize = ref(['10']);
const setColor = ref(1);
onMounted(() => {
    store.fetchProducts();
});

const getProduct = computed(() => {
    return store.products[route.params.id - 1];
});
function selectColor(e) {
    setColor.value = e;
}
</script>
<template>
    <div v-if="getProduct">
        <v-row>
            <v-col lg="6" sm="12">
                <ProductCarousel />
            </v-col>
            <v-col lg="6" sm="12" class="pl-lg-5 product-details">
                <div>
                    <div class="d-flex align-center gap-2">
                        <v-chip color="success" variant="elevated" size="small" elevation="0" rounded="sm" v-if="getProduct.isStock"> In Stock </v-chip>
                        <v-chip color="error" v-else> Out of Stock </v-chip>
                        <span class="text-subtitle-2">{{ getProduct.gender }}</span>
                    </div>

                    <h3 class="text-h3 mt-3 heading">
                        {{ getProduct.name }}
                    </h3>
                </div>
                <p class="v-col-lg-11 px-0 textSecondary text-body-1">{{ getProduct.description }}</p>

                <div class="d-flex align-center gap-2">
                    <p class="text-decoration-line-through text-h5 mb-0 text-grey200">${{ getProduct.offerPrice }}</p>
                    <h4 class="text-h3 heading">${{ getProduct.salePrice }}</h4>
                </div>

                <div class="text-medium-emphasis align-center d-flex mt-3 gap-2">
                    <v-rating color="warning" half-increments v-model="getProduct.rating" size="small" density="compact"> </v-rating>
                    <span class="font-weight-medium">(236 reviews)</span>
                </div>

                <v-divider class="my-5"></v-divider>

                <v-row>
                    <v-col cols="6" sm="2" class="d-flex align-center">
                        <h6 class="text-h6 heading">Colors<span class="text-error">*</span></h6>
                    </v-col>
                    <v-col cols="6" sm="10">
                        <template v-for="(color, i) in getProduct.colors" :key="i">
                            <v-avatar @click="selectColor(i)" variant="flat" :color="color" size="x-small" class="mr-1 cursor-pointer">
                                <template v-if="setColor == i">
                                    <CheckIcon size="13" />
                                </template>
                            </v-avatar>
                        </template>
                    </v-col>
                    <v-col cols="6" sm="2" class="d-flex align-center">
                        <h6 class="text-h6 heading">Quantity</h6>
                    </v-col>
                    <v-col cols="6" sm="10">
                        <v-btn-toggle divided variant="outlined">
                            <v-btn size="x-small" color="secondary" @click="store.decrementQty(getProduct.id)">
                                <MinusIcon size="18"  />
                            </v-btn>

                            <v-btn size="small" color="secondary" class="text-subtitle-1 font-weight-semibold">
                                {{ getProduct.qty }}
                            </v-btn>

                            <v-btn size="x-small" color="secondary" @click="store.incrementQty(getProduct.id)">
                                <PlusIcon size="18"  />
                            </v-btn>
                        </v-btn-toggle>
                    </v-col>
                </v-row>
                <v-divider class="my-5"></v-divider>
                <v-row class="mt-6">
                    <v-col cols="12" sm="4">
                        <v-btn block size="large" variant="flat" color="primary" to="/ecommerce/checkout" @click="store.AddToCart(getProduct)"
                            >Buy Now</v-btn
                        >
                    </v-col>
                    <v-col cols="12" sm="4">
                        <v-btn block size="large" variant="flat" color="error" @click="store.AddToCart(getProduct)">Add To Cart</v-btn>
                    </v-col>
                </v-row>
                <div class="mt-8">
                    <p class="text-subtitle-1 mb-1 textSecondary">Dispatched in 2-3 weeks</p>
                    <RouterLink to="/" class="text-subtitle-1 text-decoration-none text-textPrimary">Why the longer time for delivery?</RouterLink>
                </div>
            </v-col>
        </v-row>
    </div>
</template>
<style lang="scss">
.productCustomize tr td {
    padding: 15px 20px;
    vertical-align: center;
}
</style>
