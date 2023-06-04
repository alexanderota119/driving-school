<template>
    <base-layout>
        <div class="px-0">
            <slot />
        </div>
    </base-layout>
</template>
<script lang="ts" setup>
import BaseLayout from '@/Layouts/BaseLayout';

interface Props {}

defineProps<Props>();
//
</script>
