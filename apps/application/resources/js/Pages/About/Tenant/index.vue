<template>
    <div
        :style="`background: ${tenant.bgcolor || 'yellow'} !important;`"
        class="w-100 vh-100"
    >
        <div class="text-center">
            Welcome to the site <strong v-text="tenant_name" />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { computed } from 'vue';

const props = defineProps<{
    auth: {
        user: App.Models.User;
    };
    tenant: App.Models.Tenant;
    tenant_name: string;
}>();

const user = computed(() => props.auth.user);
</script>
