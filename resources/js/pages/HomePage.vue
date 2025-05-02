<template>
    <BreadCrumbs />
    <v-card-title class="text-center justify-center py-6">
        <h1 class="font-weight-bold text-h2">
            Home
        </h1>
    </v-card-title>
    <v-container class="bg-surface-variant">
        <v-row no-gutters>
            <v-col sm="12" md="6">
                <v-sheet class="ma-2 pa-2">
                    Cras id dui. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Quisque id mi. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus.
                </v-sheet>
            </v-col>
            <v-col sm="12" md="6">
                <v-sheet class="ma-2 pa-2">
                    Vestibulum volutpat pretium libero. Morbi nec metus. Curabitur turpis.
                    <br/>
                    <br/>
                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam adipiscing. Donec venenatis vulputate lorem.
                </v-sheet>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
    import BreadCrumbs from '../components/BreadCrumbs.vue';
</script>