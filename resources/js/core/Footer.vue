<template>
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Contact Us</a></li>
                        <li><a href="#" class="hover:underline">FAQs</a></li>
                        <li><a href="#" class="hover:underline">Shipping & Returns</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">About Us</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Our Story</a></li>
                        <li><a href="#" class="hover:underline">Careers</a></li>
                        <li><a href="#" class="hover:underline">Press</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-primary">Facebook</a>
                        <a href="#" class="hover:text-primary">Instagram</a>
                        <a href="#" class="hover:text-primary">Twitter</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="mb-4">Stay updated with our latest offers</p>
                    <div class="flex">
                        <Input type="email" placeholder="Your email" class="rounded-r-none focus:ring-0"/>
                        <Button class="rounded-l-none bg-gray-700 hover:bg-gray-800">Subscribe</Button>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center">
                <p>&copy; 2023 ShopEase. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ShoppingCart, Heart, User } from 'lucide-vue-next'
import {Button} from '@/components/ui/button'
import {Input} from '@/components/ui/input'

</script>

<style lang="scss" scoped>

</style>
