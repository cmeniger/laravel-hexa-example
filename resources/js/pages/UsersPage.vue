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
                    v-model="searchText"
                ></v-text-field>
                <v-btn icon="mdi-reload" @click="reload"></v-btn>
            </template>
        </v-toolbar>
    </v-card>
    <v-data-table-server
        :items-per-page="null == users.meta ? 0 : users.meta.perPage"
        :headers="tableHeaders"
        :items="users.items"
        :items-length="null == users.meta ? 0 : users.meta.total"
        :loading="null == users.items"
        :search="searchText"
        item-value="id"
        hover
        @update:options="loadUsers"
        @click:row="handleClick"
    ></v-data-table-server>
</template>

<script setup>
    import { computed, watch, ref } from "vue";
    import { useUserStore } from '../stores/userStore';
    import { useRouter } from "vue-router";

    const tableHeaders = ref([
        { title: 'ID', key: 'id', align: 'start' },
        { title: 'First name', key: 'firstName', align: 'start' },
        { title: 'Last name', key: 'lastName', align: 'start' },
        { title: 'Email', key: 'email', align: 'start' },
        { title: 'Status', key: 'status', align: 'start' },
    ]);
    const searchText = ref(null);
    const store = useUserStore();
    const users = computed(() => {
        return store.usersPaginated;
    });
    const router = useRouter();

    watch(searchText, () => {
        searchText.value = ('' == searchText.value ? null : searchText.value);
        loadUsers({itemsPerPage: users.value.meta.perPage});
    });

    function loadUsers({ page, itemsPerPage, sortBy }) {
        store.fetchUsers(page, itemsPerPage, searchText.value);
    };

    function reload() {
        loadUsers({itemsPerPage: users.value.meta.perPage});
    };

    function handleClick(event, row) {
        router.push({ name: 'user', params: { id: row.item.id } });
    }
</script>