<template>
    <li :class="{ active }" class="nav-item">
        <AppLink :href="href" class="nav-link" prefetch>
            <slot />
        </AppLink>
    </li>
</template>
<script lang="ts" setup>
interface Props {
    href: string;
    active?: boolean;
}

defineProps<Props>();
</script>
