<template>
    <q-card bordered class="my-card q-my-sm" flat>
        <q-card-section>
            <span v-if="title">
                <div class="text-h6 q-mx-md" v-text="title" />
                <q-separator inset />
            </span>
            <span v-if="help">
                <small class="q-mx-md text-muted" v-text="help"></small>
            </span>

            <slot />
        </q-card-section>
    </q-card>
</template>
<script lang="ts" setup>
interface Props {
    title?: string;
    help?: string;
}

defineProps<Props>();
</script>
