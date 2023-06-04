<template>
    <q-btn
        v-if="!href"
        v-ripple
        :color="variant"
        :loading="loading"
        type="button"
    >
        <icon
            v-if="buttonProps.icon"
            :name="buttonProps.icon"
            class="fa-bolder me-1"
        />
        <span class="ms-1" v-text="buttonProps.text" />
        <slot />
    </q-btn>
    <q-btn
        v-else
        v-ripple
        :color="variant"
        :href="href"
        :loading="loading"
        :to="href"
        class="q-pt-s`"
        type="button"
    >
        <icon
            v-if="buttonProps.icon"
            :name="buttonProps.icon"
            class="fa-bolder me-1"
        />
        <span class="ms-1" v-text="buttonProps.text" />
        <slot />
    </q-btn>
</template>
<script lang="ts" setup>
import { Icon } from '@/Components';
import { ThemeColors } from '@/utils/types/theme';
import { computed } from 'vue';

interface ButtonProps {
    variant: ThemeColors;
    text?: string;
    actionType?: 'create';
    href?: string;
    icon?: 'user' | 'users' | 'trash';
    loading?: boolean;
}

const props = withDefaults(defineProps<ButtonProps>(), {
    variant: 'primary',
});

const buttonProps = computed(() => {
    if (props.actionType === 'create') {
        return {
            text: 'Create',
            icon: 'plus',
        };
    }

    return {
        text: props.text,
        icon: props.icon,
    };
});
</script>
<style lang="scss" scoped>
.btn {
    .fa-bolder {
        -webkit-text-stroke: 2px white;
    }
}
</style>
