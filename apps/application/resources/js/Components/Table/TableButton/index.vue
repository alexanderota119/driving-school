<template>
    <q-btn :href="href" :title="title" :to="href" class="cursor-pointer" flat>
        <icon :icon-class="iconClass" :name="icon" :size="iconSize" />
        <span class="ms-1" v-text="text" />
    </q-btn>
</template>
<script lang="ts" setup>
import { Icon } from '@/Components/index';
import { IconSizes } from '@/utils/types/icons';
import { ThemeColors } from '@/utils/types/theme';

interface ButtonProps {
    title: string;
    variant?: ThemeColors;
    text?: string;
    actionType?: 'create';
    href?: string;
    icon?: 'user' | 'users' | 'trash' | 'dollar';
    iconSize?: IconSizes;
    iconClass?: string;
}

withDefaults(defineProps<ButtonProps>(), {
    iconSize: '20px',
});
</script>
<style lang="scss" scoped>
//
</style>
