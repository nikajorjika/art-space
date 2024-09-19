<template>
    <header class="border-b">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <a href="/" class="text-2xl font-bold text-primary">ShopEase</a>
                <nav class="hidden md:flex space-x-4">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-primary">Shop</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-primary">Categories</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-primary">Deals</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-primary">About Us</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-primary">Contact</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <Button variant="ghost" size="icon">
                    <User class="h-5 w-5" />
                </Button>
                <Button variant="ghost" size="icon">
                    <Heart class="h-5 w-5" />
                </Button>
                <Button variant="ghost" size="icon">
                    <ShoppingCart class="h-5 w-5" />
                </Button>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ShoppingCart, Heart, User } from 'lucide-vue-next'
import Button from '@/components/ui/button/Button.vue'


</script>
