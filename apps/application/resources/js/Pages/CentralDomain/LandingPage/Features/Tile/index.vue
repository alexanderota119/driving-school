<template>
    <div class="col-lg-4 mb-5 mb-lg-0">
        <div
            class="feature bg-primary bg-gradient text-white rounded-3 q-mb-md"
        >
            <i class="bi bi-collection"></i>
        </div>
        <h2 class="h4 fw-bolder" v-text="title" />
        <p v-text="message" />
        <app-link v-if="action" :href="action" class="text-decoration-none">
            Call to action
            <i class="bi bi-arrow-right"></i>
        </app-link>
    </div>
</template>
<script lang="ts" setup>
defineProps<{
    title: string;
    message: string;
    action: string;
}>();
//
</script>
