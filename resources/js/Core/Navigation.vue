<template>
    <NavigationMenu>
        <NavigationMenuList>
            <NavigationMenuItem v-for="navigationItem in navigationMenuList">
                <NavigationMenuTrigger>Item One</NavigationMenuTrigger>
                <NavigationMenuContent>
                    <NavigationMenuLink>Link</NavigationMenuLink>
                </NavigationMenuContent>
            </NavigationMenuItem>
        </NavigationMenuList>
    </NavigationMenu>
</template>

<script setup>
import {ref} from "vue";
import NavigationMenu from "@/components/ui/navigation-menu/NavigationMenu.vue";
import {
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger
} from "radix-vue";


const navigationMenuList = ref([
    {
        title: "Item One",
        links: [
            {
                title: "Link",
                url: "#"
            }
        ]
    },
    {
        title: "Item Two",
        links: [
            {
                title: "Link",
                url: "#"
            }
        ]
    }
]);


</script>

<style lang="scss" scoped>

</style>
