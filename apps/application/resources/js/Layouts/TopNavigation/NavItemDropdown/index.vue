<template>
    <AppLink
        :class="{ active }"
        :href="href"
        class="dropdown-item text-light bg-dark"
        prefetch
    >
        <slot />
    </AppLink>
</template>
<script lang="ts" setup>
interface Props {
    href: string;
    active?: boolean;
}

defineProps<Props>();
</script>
