<template>
    <Layout>
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold">Women's Clothing</h1>
                <div class="flex items-center text-sm text-gray-500 mt-2">
                    <a href="/" class="hover:underline">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/categories" class="hover:underline">Categories</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">Women's Clothing</span>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar with filters -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold">Filters</h2>
                            <Button variant="ghost" size="sm">Clear all</Button>
                        </div>
                        <Accordion type="single" collapsible class="w-full">
                            <AccordionItem value="category">
                                <AccordionTrigger>Category</AccordionTrigger>
                                <AccordionContent>
                                    <div class="space-y-2">
                                        <div v-for="category in categories" :key="category.id"
                                             class="flex items-center space-x-2">
                                            <Checkbox :id="category.id"/>
                                            <label :for="category.id"
                                                   class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{
                                                    category.label
                                                }}</label>
                                        </div>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                            <AccordionItem value="price">
                                <AccordionTrigger>Price Range</AccordionTrigger>
                                <AccordionContent>
                                    <Slider v-model="priceRange" :max="100" :step="1"/>
                                    <div class="flex justify-between mt-2">
                                        <span class="text-sm">$0</span>
                                        <span class="text-sm">$100+</span>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                            <AccordionItem value="size">
                                <AccordionTrigger>Size</AccordionTrigger>
                                <AccordionContent>
                                    <div class="flex flex-wrap gap-2">
                                        <Button v-for="size in sizes" :key="size" variant="outline" size="sm">{{
                                                size
                                            }}
                                        </Button>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                            <AccordionItem value="color">
                                <AccordionTrigger>Color</AccordionTrigger>
                                <AccordionContent>
                                    <div class="flex flex-wrap gap-2">
                                        <div v-for="color in colors" :key="color"
                                             :class="`w-6 h-6 rounded-full bg-${color}-500 cursor-pointer border border-gray-300`"></div>
                                    </div>
                                </AccordionContent>
                            </AccordionItem>
                        </Accordion>
                    </div>
                </div>

                <!-- Main content area -->
                <div class="w-full lg:w-3/4">
                    <!-- Search and sort -->
                    <div class="bg-white rounded-lg shadow p-4 mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="w-full sm:w-auto flex-1">
                                <div class="relative">
                                    <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"/>
                                    <Input type="text" placeholder="Search products..." class="pl-10"/>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto flex items-center gap-4">
                                <span class="text-sm text-gray-500">Sort by:</span>
                                <Select v-model="sortOrder">
                                    <SelectTrigger class="w-[180px]">
                                        <SelectValue placeholder="Featured"/>
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="featured">Featured</SelectItem>
                                        <SelectItem value="price-low-high">Price: Low to High</SelectItem>
                                        <SelectItem value="price-high-low">Price: High to Low</SelectItem>
                                        <SelectItem value="newest">Newest Arrivals</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>
                    </div>

                    <!-- Product grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="product in products" :key="product.id"
                             class="bg-white rounded-lg shadow overflow-hidden group">
                            <div class="relative">
                                <img :src="product.image" :alt="product.name" class="w-full h-64 object-cover"/>
                                <Button size="icon" variant="secondary"
                                        class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <Heart class="h-4 w-4"/>
                                </Button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ product.name }}</h3>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-xl">${{ product.price.toFixed(2) }}</span>
                                    <div class="flex items-center">
                                        <Star class="h-4 w-4 text-yellow-400 fill-current"/>
                                        <span class="ml-1 text-sm text-gray-600">{{ product.rating }}</span>
                                    </div>
                                </div>
                                <Button class="w-full mt-4">Add to Cart</Button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        <nav class="inline-flex rounded-md shadow">
                            <Button variant="outline">Previous</Button>
                            <Button v-for="page in pages" :key="page" variant="outline">{{ page }}</Button>
                            <Button variant="outline">Next</Button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import {ref} from 'vue'
import {Search, Filter, ChevronDown, Star, Heart} from 'lucide-vue-next'
import {Button} from '@/components/ui/button'
import {Input} from '@/components/ui/input'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from '@/components/ui/accordion'
import {Checkbox} from '@/components/ui/checkbox'
import {Slider} from '@/components/ui/slider'
import Layout from '@/layouts/Default.vue'

const products = ref([
    {id: 1, name: 'Classic White T-Shirt', price: 29.99, rating: 4.5, image: '/placeholder.svg?height=300&width=300'},
    {id: 2, name: 'Slim Fit Jeans', price: 59.99, rating: 4.2, image: '/placeholder.svg?height=300&width=300'},
    {id: 3, name: 'Leather Jacket', price: 199.99, rating: 4.8, image: '/placeholder.svg?height=300&width=300'},
    {id: 4, name: 'Running Shoes', price: 89.99, rating: 4.6, image: '/placeholder.svg?height=300&width=300'},
    {id: 5, name: 'Floral Summer Dress', price: 49.99, rating: 4.3, image: '/placeholder.svg?height=300&width=300'},
    {id: 6, name: 'Wool Sweater', price: 79.99, rating: 4.4, image: '/placeholder.svg?height=300&width=300'},
    {id: 7, name: 'Denim Shorts', price: 39.99, rating: 4.1, image: '/placeholder.svg?height=300&width=300'},
    {id: 8, name: 'Formal Blazer', price: 129.99, rating: 4.7, image: '/placeholder.svg?height=300&width=300'},
    {id: 9, name: 'Casual Sneakers', price: 69.99, rating: 4.5, image: '/placeholder.svg?height=300&width=300'},
    {id: 10, name: 'Printed Scarf', price: 24.99, rating: 4.2, image: '/placeholder.svg?height=300&width=300'},
    {id: 11, name: 'Leather Belt', price: 34.99, rating: 4.6, image: '/placeholder.svg?height=300&width=300'},
    {id: 12, name: 'Sunglasses', price: 79.99, rating: 4.4, image: '/placeholder.svg?height=300&width=300'},
])

const categories = [
    {id: 'tops', label: 'Tops'},
    {id: 'dresses', label: 'Dresses'},
    {id: 'pants', label: 'Pants'},
    {id: 'shoes', label: 'Shoes'},
]

const sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL']
const colors = ['red', 'blue', 'green', 'yellow', 'purple', 'pink', 'black', 'white']
const pages = [1, 2, 3]
const priceRange = ref([0, 100])
const sortOrder = ref('featured')
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
