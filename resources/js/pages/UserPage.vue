<template>
    <div class="text-center py-6">
        <template v-if="null == user || route.params.id != user.id">
            <v-progress-circular
            :size="125"
            :width="10"
            color="primary"
            indeterminate
            ></v-progress-circular>
        </template>
        <template v-else>
            <v-avatar color="primary" size="125" class="overflow-visible">
                <span class="text-h2">{{ user.firstName[0].toUpperCase() }}{{ user.lastName[0].toUpperCase() }}</span>
                <v-icon color="success" icon="mdi-check-circle" size="large" class="status-icon position-absolute border-lg rounded-circle"></v-icon>
            </v-avatar>
            <v-card-title class="text-h6 text-md-h5 text-lg-h4 mt-5">
                {{ user.firstName }} {{ user.lastName }}
            </v-card-title>
            <v-card-text>
                <v-icon icon="mdi-email" size="x-small" class="mr-3"></v-icon>
                <a href="mailto:{{ user.email }}" class="text-decoration-none">{{ user.email }}</a>
            </v-card-text>
        </template>
    </div>
</template>

<script setup>
    import { computed, onMounted } from "vue";
    import { useRoute } from "vue-router";
    import { useUserStore } from '../stores/userStore';

    const route = useRoute();
    const store = useUserStore();
    const user = computed(() => {
        return store.user;
    });

    onMounted(() => {
        store.fetchUser(route.params.id);
    });
</script>

<style scoped>
    .status-icon {
        bottom: -10px;
        border-color: white!important;
    }
</style>