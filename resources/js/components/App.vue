<template>
    <Logo />
    <Nav />

    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template>

<script setup>
    import Logo from '@/components/Logo.vue';
    import Nav from '@/components/Nav.vue';
</script>