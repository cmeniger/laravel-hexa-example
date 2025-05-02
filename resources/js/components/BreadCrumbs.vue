<template>
    <v-breadcrumbs :items="items">
        <template v-slot:divider>
            <v-icon icon="mdi-chevron-right"></v-icon>
        </template>
    </v-breadcrumbs>
</template>

<script setup>
    import { ref, onMounted } from "vue";
    import { useRoute, useRouter } from "vue-router";

    const props = defineProps(['param']);
    const items = ref([]);
    const route = useRoute();
    const router = useRouter();

    onMounted(() => {
        route.meta.breadCrumb(props.param).forEach((item) => {
            items.value.push({
                title: item.text,
                disabled: item.to ? false : true,
                href: router.resolve({name: item.to}).href,
            });
        });
    });
</script>
