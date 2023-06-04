<template>
    <div class="row">
        <div class="col-grow">
            <ctx-input v-if="!hideName" label="Student Type Name" name="name" />
            <ctx-input label="Student Type Label" name="label" />
        </div>
    </div>
</template>
<script lang="ts" setup>
defineProps<{
    hideName: boolean;
}>();
</script>
