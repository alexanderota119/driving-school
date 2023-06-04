<template>
    <th
        v-for="(header, index) in headers"
        :key="`table-header-${index}`"
        scope="column"
        v-html="header.label"
    />
    <th
        :key="`table-header-saved`"
        class="date"
        scope="column"
        v-text="'Updated At'"
    />
</template>
<script lang="ts">
export default {
    name: 'TableHeader',
    inheritAttrs: false,
    customOptions: {},
};
</script>
<script lang="ts" setup>
interface Props {
    headers: string[];
}

defineProps<Props>();
</script>
