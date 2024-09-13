<template>
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center mb-8">Find your perfect product</h1>
            <div class="max-w-3xl mx-auto">
                <div class="flex items-center bg-white rounded-full shadow-lg p-2">
                    <Input
                        type="text"
                        placeholder="Search products, brands, or categories"
                        class="flex-grow border-none focus:ring-0 focus-visible:ring-0"
                    />
                    <Button size="icon" class="rounded-full">
                        <Search class="h-5 w-5"/>
                    </Button>
                </div>
            </div>
            <div class="flex justify-center mt-6 space-x-4">
                <Button v-for="filter in filters" :key="filter" variant="outline" class="rounded-full">
                    {{ filter }}
                </Button>
            </div>
        </div>
    </section>
</template>

<script setup>
import {Search} from 'lucide-vue-next'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'

const filters = ['New Arrivals', 'Best Sellers', 'Categories', 'Brands', 'Sales', 'Gift Ideas']
</script>
