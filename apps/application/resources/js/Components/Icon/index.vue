<template>
    <q-icon :name="iconName" :size="props.size" class="q-pa-sm" />
</template>
<script lang="ts" setup>
import { IconSizes } from '@/utils/types/icons';
import { computed } from 'vue';

interface Props {
    name: string;
    iconClass?: string | 'solid' | 'regular';
    size?: IconSizes;
}

const props = withDefaults(defineProps<Props>(), {
    size: '12px',
    iconClass: 'regular',
});

const iconName = computed(() => {
    return `fa fa-${props.name} fa-${props.iconClass}`;
});
</script>
