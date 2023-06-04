<template>
    <q-list dense>
        <q-item v-for="(err, errIndex) in error" :key="errIndex + '-error'">
            {{ err }}
        </q-item>
    </q-list>
</template>
<script lang="ts" setup>
interface Props {
    error: string[];
}

const props = defineProps<Props>();
</script>
