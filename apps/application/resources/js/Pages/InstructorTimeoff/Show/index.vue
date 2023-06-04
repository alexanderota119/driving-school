<template>
    <pre>
            {{ JSON.stringify(timeoff_requests, null, 2) }}
        </pre
    >
</template>
<script lang="ts" setup>
defineProps<{
    timeoff_requests: App.Models.TimeOff[];
}>();
</script>
