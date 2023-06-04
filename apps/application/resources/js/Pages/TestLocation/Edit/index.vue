<!--suppress ALL -->
<template>
    <CtxForm
        :action="`/test_locations/${test_location.id}`"
        :form="test_location"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    test_location: App.Models.TestLocation;
}>();
</script>
