<template>
    <v-card-title class="text-center justify-center py-6">
        <h1 class="font-weight-bold text-h2">
            Users
        </h1>
    </v-card-title>
    <v-card>
        <v-toolbar density="compact">
            <template v-slot:append>
                <v-text-field
                    density="compact"
                    placeholder="Search"
                    prepend-inner-icon="mdi-magnify"
                    variant="solo"
                    width="300"
                    flat
                    hide-details
                    single-line
                ></v-text-field>
                <v-btn icon="mdi-reload" @click="reload"></v-btn>
                <v-menu>
                    <template v-slot:activator="{ props }">
                        <v-btn icon="mdi-eye" v-bind="props"></v-btn>
                    </template>
                    <v-list>
                        <v-list-item
                            v-for="(value, index) in perPage"
                            :key="index"
                            :value="index"
                            :class="[users.meta.perPage == value ? 'bg-primary' : '', 'text-center']"
                            @click="changePerPage(value)"
                            >
                            <v-list-item-title>{{ value }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>
        </v-toolbar>
    </v-card>
    <v-table>
        <thead>
            <tr>
                <th v-for="title in titles" :key="title" class="text-left">
                    {{ title }}
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in users.items" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.firstName }}</td>
                <td>{{ item.lastName }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.status }}</td>
                <td></td>
            </tr>
        </tbody>
    </v-table>
    <div class="text-center">
        <v-container>
        <v-row justify="center">
            <v-col cols="8">
            <v-container class="max-width">
                <v-pagination
                v-model="currentPage"
                :length="lastPage"
                class="my-4"
                ></v-pagination>
            </v-container>
            </v-col>
        </v-row>
        </v-container>
    </div>
</template>

<script setup>
    import { onMounted, computed, watch, ref } from "vue";
    import { useUserStore } from '../stores/userStore';

    const titles = ['ID', 'First name', 'Last name', 'Email', 'Status'];
    const perPage = [10, 20, 30, 100];
    const currentPage = ref(1);
    const lastPage = ref(1);
    const store = useUserStore();

    const users = computed(() => {
        if (store.usersPaginated.meta) {
            currentPage.value = store.usersPaginated.meta.currentPage;
            lastPage.value = store.usersPaginated.meta.lastPage;
        }
        
        return store.usersPaginated;
    });

    onMounted(() => {
        reload();
    });

    watch(currentPage, (newPage, oldPage) => {
        if(newPage != oldPage) {
            changePage(newPage);
        }
    });

    function reload() {
        store.fetchUsers(null, users.value.meta ? users.value.meta.perPage : null);
    };

    function changePerPage(perPage) {
        store.fetchUsers(null, perPage);
    };

    function changePage(page) {
        store.fetchUsers(page, users.value.meta.perPage);
    };
</script>