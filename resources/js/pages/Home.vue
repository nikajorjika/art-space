<template>
    <Layout>
        <SearchSection/>

        <!-- Category Highlight -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Explore our collections</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="(category, index) in categories"
                        :key="index"
                        class="relative rounded-lg overflow-hidden group"
                    >
                        <img :src="category.image" :alt="category.title" class="w-full h-64 object-cover"/>
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-6 transition-opacity group-hover:bg-opacity-50">
                            <div>
                                <h3 class="text-white text-xl font-semibold mb-2">{{ category.title }}</h3>
                                <Button variant="secondary" size="sm" class="group">
                                    Shop Now
                                    <ChevronRight
                                        class="h-4 w-4 ml-2 transition-transform group-hover:translate-x-1"/>
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Personalized Recommendations -->
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Recommended for you</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div
                        v-for="product in products"
                        :key="product"
                        class="bg-white rounded-lg shadow-md overflow-hidden"
                    >
                        <img :src="`https://placehold.co/200x200`" :alt="`Product ${product}`"
                             class="w-full h-48 object-cover"/>
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">Product Name</h3>
                            <p class="text-gray-600 text-sm mb-2">Brief description</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold">$99.99</span>
                                <Button size="sm">Add to Cart</Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Products or Promotions -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Special offers</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-primary text-white rounded-lg p-8 flex flex-col justify-between"
                         style="min-height: 300px;">
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Summer Sale</h3>
                            <p class="mb-4">Get up to 50% off on selected items</p>
                        </div>
                        <Button variant="secondary">Shop the Sale</Button>
                    </div>
                    <div class="bg-secondary text-secondary-foreground rounded-lg p-8 flex flex-col justify-between"
                         style="min-height: 300px;">
                        <div>
                            <h3 class="text-2xl font-bold mb-4">New Arrivals</h3>
                            <p class="mb-4">Check out our latest collection</p>
                        </div>
                        <Button variant="outline">Explore New Arrivals</Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Engagement Section -->
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8">Discover more</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="(item, index) in engagementItems"
                        :key="index"
                        class="bg-white rounded-lg shadow-md overflow-hidden"
                    >
                        <img :src="`https://placehold.co/200x400`" :alt="item" class="w-full h-48 object-cover"/>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ item }}</h3>
                            <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.</p>
                            <Button variant="link" class="p-0">
                                Learn more
                                <ChevronRight class="h-4 w-4 ml-2"/>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer/>

    </Layout>
</template>

<script setup>
import {ChevronRight} from 'lucide-vue-next'
import Layout from '@/layouts/Default.vue'
import Button from '@/components/ui/button/Button.vue'
import SearchSection from "@/components/Search/SearchSection.vue";
import Footer from "@/core/Footer.vue";

const categories = [
    {title: 'Shop Latest Fashion Trends', image: 'https://placehold.co/300x400'},
    {title: 'Exclusive Collaborations', image: 'https://placehold.co/300x400'},
    {title: 'Toy Collections for Kids', image: 'https://placehold.co/300x400'},
]
const products = [1, 2, 3, 4]
const engagementItems = ['How To Style', 'Customer Stories', 'Product Demos']
</script>
